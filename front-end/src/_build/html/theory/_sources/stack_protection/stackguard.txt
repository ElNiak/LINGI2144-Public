StackGuard
----------

Buffer overflow aims at smashing the stack until ``saved EIP``, what is
written before the new ``saved EIP`` is generally also smashed (nop,
shellcode). Idea of StackGuard is to place a special value called
**canary** before ``saved EIP``. The canary is generated randomly at
execution time (hence it should not be guessed) and if canary is
corrupted, then this means that stack is smashed and the program stops.
The protection is **added at compiler level**.

.. literalinclude:: guard.sh
   :language: bash

..  image:: image/22.PNG
    :scale: 80%
    :align: center

Exploit - Pointer rewritting attack
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Sometimes, it is possible to write the address where the return address is saved in an
argument of the program. If this argument can latter be used to store something, then you win!

Main difficulty is that canary changes from execution to execution,
consequently cannot be guessed but is vulnerable to a wide range of
potentially complex attacks. In this class we limit to the well-known
**pointer rewritting attack**.

.. literalinclude:: pointerrewriting.c
   :language: c


**Idea**: rewrite ``p`` in L1 with the address of ``saved EIP``. This
can be done as ``p`` points to ``a[0]``, and ``p`` follows ``a`` on the
stack, i.e., an overflow of ``a`` will write on ``p`` which now points
to the address where EIP is saved. Use L2 to write the new address
there. Only works because the value of ``p`` is not modified between the
two ``strcpy()``. Note that only ``strcpy()`` in L1 needs to be
vulnerable to BO. (not sure of the graph)

..  image:: image/23.PNG
    :scale: 80%
    :align: center

Exploit - Server
~~~~~~~~~~~~~~~~

If the canary is running on a server, for each connection, two things
can happened: [2]_

#. ``fork()`` alone: in this case the same canary/stack is duplicated,
   this is the same process.

   -  On 32 bits system, canary has size of 4 bytes and hence have 256
      possible value

   -  **Try to guess** 1 bytes:256 possibility, then 2, ...

   -  | :math:`4 * 256` possibilities
      | May need several IPs for that.

#. | ``fork()`` and ``execve()`` on another program: change all the
     sections, rearrange the stack.
   | Much more annoying !

XOR canary
~~~~~~~~~~

Previous program is vulnerable not only because of his structure but
also because StackGuard only checks if the value of canary has been
corrupted, not if ``saved EIP`` has been corrupted. The idea is to xor
the canary with the saved return address and if the address has changed,
then the canary must also change so the xor value remains the same. This
protection can be bypassed too. [3]_

.. [2]
   https://beta.hackndo.com/technique-du-canari-bypass/

.. [3]
   http://phrack.org/issues/56/5.html