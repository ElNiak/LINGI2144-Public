Debugger - disassembler - decompiler
------------------------------------

-  A **debugger** allow the user to view and change the running state of
   a program, many debuggers offer disassembling options. Situation is
   simplified if source code is available (type of variables). GDB is a
   good illustration.

-  A **disassembler** is a software tool which transforms machine code
   into a human readable mnemonic representation called assembly
   language. *Disassembling is undecidable*: Given an address add , is
   there an input of the program that leads to add ?

-  A **decompiler** is a software used to revert the process of
   compilation. It takes a binary program file as input and output the
   same program expressed in a structured higher level language.

Algorithms to disassamble
~~~~~~~~~~~~~~~~~~~~~~~~~

#. **Linear sweep**

   -  Read instruction one by one

   -  Does not take jump/test into account

   -  Purely linear, list based

   -  Very sensitive to dead code

   -  GDB works like that

   Dead code problem (code overlapping allows to many instruction to be
   coded on common addresses) and linear mode [1]_ :

   .. literalinclude:: deadcode.c
       :language: c

   .. literalinclude:: deadcode2.c
       :language: c

#. **Recursive sweep**

   -  Read instructions one by one

   -  Follows results from jumps

   -  IDA works recursively

   | Recursive mode may be problematic:

   #. **One may think that recursive disassembling removes dead code
      problem but this is actually wrong.** Indeed, a comparison (and so a
      jump) may depend on some software input, the value is not known in
      advance but disassembling is a very *static* procedure.
      Consequently, one has to check for all the values, and there is no
      guarantee that a part of the comparison does not contain dead
      code.

      .. literalinclude:: recursive.c
         :language: c

   2. **Auto modified code**: Technique allowing to programs to hide their
      payload and to not reveal them until the execution.

      This program starts by allowing write access to the ``.text`` code
      section: the access rights of this section become ``RWX`` (read,
      write and execute are allowed). Then it sets a memory address,
      ``0x8048076`` in ``eax``, then instruction 2 written to
      ``eax + 1``, causing instruction 4 to be modified to
      ``mov edi, 2``, coded on ``bf 02 00 00``. Then instruction 3
      causes a second auto-modification by transforming instruction 5
      into ``mov ebx, 2``, coded on ``bb 02 00 00``. If the
      self-modifying instructions are not taken into account the
      displayed final value of ``edi`` and ``ebx`` is 1. However,
      instructions 2 and 3 modify the code so that the final value of
      these two registers is 2 at the time of their display. Here you
      can see that the program changes during its execution and
      therefore it is not can’t be satisfied with the original
      representation of the program to analyze it.

.. image:: /assembly/image/10.PNG
   :scale: 50%
   :align: center

Other challenges in disassembling
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

#. | **Opaque predicates**: replace simple conditions with complex
     polynomials and extra variables. Hard to decode, hard to
     disassemble (dead code, etc)
   | **Static opaque predicate** :math:`=` Is is a predicate whose value
     is fixed during runtime

   #. | **Invariant opaque predicate** : The value is always evaluates
        to true or false for all possible inputs
      | E.g : :math:`\forall x \in Z : (4x^2-4) \% 19 \neq 0`

   #. | **Contextual opaque predicate**: Evaluates to always true or
        false under a given precondition
      | E.g :
        :math:`\forall x \in Z : (4x-4) \% 3 = 0 \Rightarrow (28x^2-13x-5) \% 9 =0`

   | **Dynamic opaque predicate**: Split executions with several predicates that are either all true or all false. Here must pass to 1.2.3.

.. image:: /assembly/image/11.PNG
   :scale: 50%
   :align: center

2. **Virtualization**: Hide the instructions as data of a new program
   (disorganisation of the structure).

Debuggers principles
~~~~~~~~~~~~~~~~~~~~

| Debuggers are used to get information on memory/register a runtime and
  is based on hooks. It is not the same and should not be confused with
  source code debuggers (like IDE). Well known tools are ``gdb``, ``radar``,
  ``ida`` , ``olydbg`` , ``objdump``, ``ptrace`` ... Their usage depend on the
  type of files (elf,pe,...) and on functionality. [2]_

GDB debugger
^^^^^^^^^^^^

#. Compilation with **debugging symbols** (``-g``):
   ``gcc -m32 -g fichier.c -o result``

#. Launch gdb and avoid verbose messages: ``gdb -q result``

**Main function: observe software at runtime**

-  Key tool: **break points** and **break line** which are used to
   suspend the execution

   -  ``break *address``

   -  ``break line``

   -  ``break line condition``

-  ``disass func`` : shows the assembly code

-  ``i r register`` shows the content of register

-  ``print $register``

   shows the content of the address stored in register

-  ``x/value1xvalue2 address`` : hexadecimal representation of
   ``value1`` units of size ``value2`` starting from ``address``

-  ``x/2xw &register`` : shows the two first words (sequence of byte
   depend on architecture) from address pointed by register

-  GDB can be used to modify register/environment variables/address’s
   content at runtime

   -  ``set $ebp+=4``

   -  ``set (i = 20)``

-  ``watch i``: Alarm can be issued

-  ``attach 335``: Running process can be examined

-  ``list func``: Source code of function func can be obtained

GDB does not provide heap examination but you can install GDB heap. [3]_ This
will give you addresses of chunks lists but this is much less flexible
than stack/register explorations.

Stack organization
~~~~~~~~~~~~~~~~~~

The stack (LIFO politics):

-  Stores local variables and arguments of a function

-  Pushes/pops information from high to low level addresses

-  Is used to store the context a function on a stack frame

-  On the right, an abstraction of the stack at execution

Relation between function and stack
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

| They use the stack to access their parameters to transmit parameters
  to other functions and have their own vision of the stack, the stack
  frame.

| Access to local variables is done via the ``EBP`` register and the top
  of stack is accessed via ``ESP`` register. Stack manipulates words, that is 4 bytes values
  and all pop and push operation are done on the top of the stack.

.. image:: /assembly/image/12.PNG
   :scale: 50%
   :align: center

Calling function convention
~~~~~~~~~~~~~~~~~~~~~~~~~~~

A function is thus composed of a prolog and an epilog :

-  **Prolog** consists in adapting the stack to access function’s
   parameters and local variables

-  **Epilog** consists in cleaning this frame

Calling function convention

#. Before the function is called: push the argument

   #. ``sub esp,size``: make space for argument

   #. ``add ebx,value``

   #. ``push address``

#. When the function is called: ``call func``

   #. ``push eip``: save EIP of calling frame

   #. ``jmp functionAddress``

#. At the beginning of function:

   #. ``push ebp``: save EBP of calling frame

   #. ``mov ebp,esp``: new EBP is current ESP

   #. | push local arguments:
      | Arguments are pushed on the stack (usually from right to left)

#. When the function terminate:

   -  ``leave``: move the value of ESP to EBP and POP EBP , which
      restores old EBP

   -  ``ret`` :math:`\equiv` ``pop eip``: and call which establishes the
      next instruction to be

   At termination, the stack frame is erased

Example
^^^^^^^

Consider a call to a function Geek:

#. With :math:`n` arguments: :math:`Param(1)... Param(n)`

#. A local integer variable :math:`i` (4 bytes)

#. A buffer of :math:`n` char buf (:math:`n` bytes)

+------------------------------------------------------------------------------------------------------------+
|                                                                                                            |
+====================================+===================================+===================================+
| .. image:: /assembly/image/13.PNG  | .. image:: /assembly/image/14.PNG | .. image:: /assembly/image/15.PNG |
|    :scale: 45%                     |    :scale: 33%                    |    :scale: 33%                    |
| (a) Before calling Geek            | (b) When Geek is called           | (c) Push local variables          |
+------------------------------------+-----------------------------------+-----------------------------------+

.. literalinclude:: assem2.c
       :language: c

.. [1]
   http://docnum.univ-lorraine.fr/public/DDOC_T_2015_0011_THIERRY.pdf

.. [2]
   https://beta.hackndo.com/introduction-a-gdb/

.. [3]
   https://github.com/rogerhu/gdb-heap