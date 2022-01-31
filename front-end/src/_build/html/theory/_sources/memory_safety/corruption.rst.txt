Memory Safety
*************

Memory handling and impact of memory corruption
-----------------------------------------------

Memory corruption is as old as operating systems and networks and
exploitation/facilities really depends on the programming language in
use. [1]_.

As small reminder, one byte is the concatenation of 8 bits and allow to
encode 255 values in the decimal system. For the hexadecimal system,
digits are between 0 and 15(F) and are the concatenation of 4 bits so
two digits make one byte.

Processor and memory
~~~~~~~~~~~~~~~~~~~~

| A computer is composed of a processor which read and write instruction
  stored in memory. Processor can also use specific memory locations
  called registers.

| Execution can modify registers and memory, it repeat :

#. Processor **fetches** instruction whose address is stored in EIP
   (:math:`=` register containing the next instruction to be executed)

#. Processor **decodes** the instruction

#. | Processor **executes** the instruction

**Instructions** are the building blocks of assembly programs. In x86
assembly (32 bits systems), it is made of a

-  mnemonic/instruction :math:`+` zero or more operands

-  Operands are typically registers, memory addresses, or data
   (immediate)

-  Example : ``MOV ECX, 0x42``

   -  ``MOV ECX`` corresponds to ``0XB9`` (instruction)

   -  ``0x42`` corresponds to ``0x42000000`` (operands)

   -  | The machine views ``B9 42 00 00 00``

Two types of processors:

+-------------------------------------------------+-----------------------------------------------------------------+
| CISC (Complex Instruction Set) (e.g intel 8086) | RISC (Reduced Instruction) (e.g sparc)                          |
+=================================================+=================================================================+
| Lots of instructions and different clock cycles | Small number of instructions, and more predictable clock cycles |
+-------------------------------------------------+-----------------------------------------------------------------+
| Lots of transfers with memory                   | Few transfers with memory, lots of registers                    |
+-------------------------------------------------+-----------------------------------------------------------------+

Memory principles
~~~~~~~~~~~~~~~~~

Memory is viewed as a large table where addresses are coded on bytes, a
**word** is a sequence of bytes (between 32 and 64 bits) and also define the
size of addresses and registers (for 32 bits, it’s 4 bytes, i.e 8
hexadecimal digits).

-  Number of addresses **excluding** the "start" and "end" address:
   :math:`end_{10/decimal} - start_{10} -1`

-  Number of addresses **including** the "start and "end" address:
   :math:`end_{10} - start_{10} +1`

Note that memory gestion unit **virtualizes** the memory space which
means that each software program thus has the impression to access the
entire memory space even if not.

.. image:: /memory_safety/image/5.PNG
   :scale: 50%
   :align: center

Registers organisation
~~~~~~~~~~~~~~~~~~~~~~

General registers (32 bits) for data :

#. ``EAX``: usually reserved to store the output of function call

#. ``EBX``

#. ``ECX``

#. ``EDX``

| Six segments registers (16 bits) for part of memory address: ``CS`` ,
  ``SS``, ``DS``, ``ES``, ``FS``, ``GS``.

| Offset registers (offset wrt to segment register)

#. ``EIP`` contains address of the next instruction to be executed

#. ``EBP`` is the base stack register, used to know where we are in the
   stack

#. ``ESP`` is the top stack pointer (hence lowest address in the stack)

#. ``ESI`` and ``EDI`` are used to offset position of some data for
   specific operations

And finally, special registers for the processor.


.. [1]
   https://ieeexplore.ieee.org/document/6547101/?arnumber=6547101

.. include:: heapstackvuln.rst
.. include:: safety.rst
.. include:: prevention_detection.rst