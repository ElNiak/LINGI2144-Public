Vulnerabilities stack and heap
------------------------------

| Languages such as C offer a wide range of memory access errors. Those
  are known to be exploitable vulnerabilities for a wide range of
  exploits. [2]_ [3]_ [4]_

| Two important structures, (1) **the stack** which store local variables and
  parameters function and (2) **the heap** that stores dynamic variables. Those
  two structures interact with each other through pointers:

.. literalinclude:: mem.c
   :language: c

**Main stack exploit/vulnerability :**

-  **Buffer overflow (Stack)**: Buffer overflow is when you’re allowed
   to **smash** the stack, that is to write in the stack where you
   should not. (Can also happen on heap, but with different
   consequences). Often requires the **ability to execute the stack**.

   -  Potential exploits are: shellcode, backdoor, variable value
      modification, or denial of service

   .. literalinclude:: seg.c
      :language: c


-  **Format string (Stack)**: Format string is simply abusing functions
   like ``printf`` to read/write memory

   .. literalinclude:: hole.c
      :language: c

Heap memory management
~~~~~~~~~~~~~~~~~~~~~~

Heap works by allocating chunks of bytes allocated as free memory
(``malloc``). The heap is thus a double linked list of chunks with:

-  A pointer to the first element (head of heap), i.e., to the first
   free memory space

-  A pointer to previous chunk, one to next chunk

-  Data from the user.

.. image:: /memory_safety/image/6.PNG
   :scale: 50%
   :align: center

When one frees some memory (free), chunks are stored in list to be
“quickly". Those list are ``fastbin`` (very few bytes), small bin, unsorted
bin and they depend on the size of the chunk and playing with them may
lead to vulnerabilities. When allocating memory, always replace the
first most similar chunk in size.

**Main heap exploit/vulnerability :**

-  **Used after free vulnerability**: Potential exploit consist to
   program allocates and then later frees memory block A. Attacker
   allocates a memory block B, reusing the memory previously allocated
   to block A. Attacker writes data into block B. Program uses freed
   block A, accessing the data the attacker left there :math:`=` **Code
   reuse exploit**

   -  **This is a memory safety issue:** the semantics of the language does
      not match the one on the system where it is executed.

   .. literalinclude:: useafterfree.C
      :language: c

   Complementary: Use tools such as ``VALGRIND``.

-  **Double free vulnerability**: the **exploit** is here to read write part
   of the memory you should not touch. Here the justification with the
   state of the ``freelist/fastbin`` according to free and malloc:

   #. :math:`head \rightarrow a \rightarrow tail`

   #. :math:`head \rightarrow b \rightarrow a \rightarrow tail`

   #. :math:`head \rightarrow a \rightarrow b \rightarrow a \rightarrow tail`

   #. :math:`head \rightarrow b \rightarrow a \rightarrow tail` [’a’ is
      returned]

   #. :math:`head \rightarrow a \rightarrow tail` [’b’ is returned]

   #. :math:`head \rightarrow tail` [’a’ is returned]

   .. literalinclude:: doublefree.c
      :language: c


-  **Null pointer abuse**: This example takes an IP address from a user,
   verifies that it is well formed and then looks up the hostname and
   copies it into a buffer. [5]_

   If an attacker provides an address that appears to be well formed,
   but the address does not resolve to a hostname, then the call to
   ``gethostbyaddr()`` will return NULL. Since the code does not check
   the return value from ``gethostbyaddr()`` , a NULL pointer
   dereference would then occur in the call to ``strcpy()``.

   .. literalinclude:: hostlookup.c
      :language: c

-  | **Control flow Hijacking**: Redirect the flow to an already
     existing executable code in memory.
   | Example: buffer overflow and executable shell code in the stack

-  **Return Oriented Programming**: 64 bit X86 processors the first
   argument to a function to be passed in a register. ROPlooks for
   functions that pop values from the stack into registers.

-  | **Non control data attacks**: Corrupt the data. [6]_
   | Example: corrupt the parameters of a sensitive function (disable
     security check)

.. [2]
   "*Control Flow Bending: On the effectiveness of control flow
   integrity*"

.. [3]
   "*Softbound : Highly Compatible and Complete Spacial Memory Safety
   for C*"

.. [4]
   https://nebelwet.net/teaching/16-527-SoftSec/slides/02-memory_safety.pdf

.. [5]
   https://cwe.mitre.org/data/definitions/476.html

.. [6]
   https://github.com/JonathanSalwan/ROPgadget

