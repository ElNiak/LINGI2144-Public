Address Space Layout Randomization (ASLR)
-----------------------------------------

| One of the main challenges of shell code injection with BO is to point
  to the beginning of the shell. This is generally done by guessing the
  address of the buffer to smash + addition of NOP but this approach
  only works because those addresses are fixed between executions. ASLR
  breaks this property by moving process entry points to random
  locations. Initiated in the context of the PaX project (2000,
  implements least protection for memory).

| **Important**: stack related, no heap randomization

Decision is taken at kernel level:

.. literalinclude:: aslr.sh
   :language: bash

Potential exploits
~~~~~~~~~~~~~~~~~~

ASLR is vulnerable to a wide range of attacks. This includes: [4]_ [5]_

#. | **Brute force attacks**
   | On 32 bits, only 24 are randomize so the idea is to try all address
     until it succeed. The more NOP you can place into your buffer and
     the best it is. There are more randomized bits on a 64 bits
     architecture which make it impracticable. The solution against that
     is thus to upgrade to such architecture.

   .. literalinclude:: brute.sh
      :language: bash

   .. literalinclude:: brute.py
      :language: python

2. | **Pointer redirection attacks**
   | If you can switch ``conf`` and ``licence``, then system will try to
     execute this. This is not a C executable file but can become one
     via dynamic link! Requires access to computer.

   .. literalinclude:: pointer.c
      :language: c

3. **Return to non randomized memory**

   a. ``ret2text`` In most cases heap, BSS, data and text segment
      are not randomized. Return exploits consist in trying to ping
      point to one of those areas. Consider the following program
      ``ret2text.c`` Function ``Secret`` code cannot be executed with
      current main, except if you’re root. However, its address can be
      obtained using ``print secret`` in GDB. Changing the return
      address to secret by exploiting the BO vulnerability of ``strcpy``
      gives access to secret code to non-root user.

      .. literalinclude:: ret2text.c
          :language: c

   b. | ``ret2bss`` Programs allow us to perform BO via
        ``localBuff`` and store a string in a global variable
        ``globalBuff``.
      | Even with ASRL, address of ``globalBuff`` does not change. The
        exploit consist in:

      #. extract the address of ``globalBuff``

      #. push a shellcode in ``globalBuff``

      #. and use ``localBuff`` to point to the shellcode

      .. literalinclude:: ret2bss.c
        :language: c

3. **Stack jungling** Based on creative ideas from Izik Kotler to bypass
   ASLR. Based on exploitation of "a certain stack layout, a certain
   program flow, or certain register changes". In this class, two very
   simple examples:

   a. | ``RET2EAX``: Exploitation of EAX (which contains the return
        value when a function ends) The program does not seem
        vulnerable. **But** ``strcpy`` **returns a pointer to** ``buf`` **which
        is stored in EAX**. Guess the address of EAX, you’ll get the
        shell code one for free!

      .. literalinclude:: ret2eax.c
            :language: c

   b. | ``RET2ESP``: Exploitation of the ``jmp *esp`` command. Objective
        is to exploit a hardcoded data, here ``jump *esp``. If the
        address of this instruction is known, you’ve your exploit by
        **using it as return address**. Unfortunately, this sequence
        does not exist in binary file. Indeed, GCC cannot produce it!
        So, what do we do? The problem can be leveraged by observing
        that ``jump *esp`` is equivalent to ``ffe4`` in hexadecimal. The
        objective is thus to find this sequence in the binary. This can
        be achieve as follows (example):
      | ``Hexdump file | grep ffe4``
      | As usual, the likelyhood to find ``ffe4`` increases with the
        size of the file.

   c. | ``RET2RET``: Exploit the ``RETCHAIN`` idee. Imagine that the
        address to the pointer exists in the stack at a higher address.
        The difficulty would be to walk to it, this can be done via
        instruction ``ret``. ``ret`` at the end of a function pops
        ``saved EIP`` and execute it. If ``saved EIP`` is itselvf a
        ``ret`` then the process repeats and elements are removed from
        the stacks. And the idea is to walk with multiple ``ret`` until
        reaching the pointer address.
      | *Challenge*: where to find pointers to newer stack frames (older
        pointers have higher address!!)?
      | *Solution*: use ``\0`` termination of the buffer to eventually
        rewrite an older one into a smaller address.

4. | **Stack stethoscope**
   | In linux, ``PID`` of a process can be obtained via
     ``pidof process``. Command more ``/proc/x/stat`` gives statistics
     about process whose ``PID`` is ``x``. The 28th element of file
     ``/proc/x/stat`` is the address of the bottom of the stack.
   | *Exploit*: compute the offset between the vulnerable buffer and the
     bottom of the stack. This offset does not change, even with ASLR.


.. warning:: **Very important paper for** `ASLR <https://pdfs.semanticscholar.org/440e/61ecb744e55d0425cdb648fe24e4ff999686.pdf>`_

.. [4]
   https://pdfs.semanticscholar.org/440e/61ecb744e55d0425cdb648fe24e4ff999686.pdf

.. [5]
   https://www.exploit-db.com/papers/13232