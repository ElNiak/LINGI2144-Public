Complement on BO
*****************


So far, the main objectives were to rewrite local parameters or
``saved EIP``. Rewritting ``saved EIP`` helps, e.g., to redirect
execution to injected code (shellcode) but is not always possible:

-  Canary, ...

Is there something else that one could try to rewrite?

-  Local arguments

-  ``saved EBP``

Situation: a function FOO that call function BAR
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Assume a function FOO that is calling a function BAR, before the call to
BAR, the Stack can be schematized (very theoretical) as follows:

..  image:: image/58.PNG
    :scale: 50%
    :align: center

The call to BAR
^^^^^^^^^^^^^^^

-  Save FOO next instruction after calling BAR

-  Save FOO ``EBP`` address

-  Define BAR ``EBP`` address as current ``ESP``

-  And then start to write local variables

-  Hit: Accessing local variable positions is done with respect to
   ``EBP`` offset.

After the call to BAR , Stack can be schematized (very theoretical) as
follows and assume a vulnerable function BAR called from FOO.

+-----------------------------------------------------+
|                                                     |
+==========================+==========================+
| ..  image:: image/60.PNG | ..  image:: image/62.PNG |
|     :scale: 45%          |     :scale: 45%          |
+--------------------------+--------------------------+
| ..  image:: image/61.PNG                            |
|     :scale: 45%                                     |
|     :align: center                                  |
+-----------------------------------------------------+

**What happens if one erases the saved FOO EBP address in BAR stack
frame?**

-  When leaving BAR, LEAVE will move back ``ESP`` to BAR’s ``EBP``
   address, which contains saved FOO ``EBP`` address

-  Then the content of BAR ``EBP`` (hence FOO ``EBP`` address) is POP in
   ``EBP`` to restore FOO’s ``EBP``

-  And then POP return address for BAR to execute next instruction in
   FOO

-  If saved FOO ``EBP`` has been modified , then FOO ``EBP`` **will be
   modified when going back to FOO**

-  This is problematic as all addresses of those local variables in FOO
   are computed with respect to offsets with ``EBP``

-  So those variables may be corrupted

Exploit’s idea
^^^^^^^^^^^^^^

-  Make sure that new saved FOO ``EBP`` address points inside the
   vulnerable buffer

-  Create a fake FOO stack frame with invulnerable buffer

-  This will allow you to modify local variable from FOO and hence
   influence next FOO’s instructions

-  In addition, you’ll control the return address when leaving FOO

When leaving BAR
^^^^^^^^^^^^^^^^

..  image:: image/63.PNG
    :scale: 50%
    :align: center

Corrupting EIP
^^^^^^^^^^^^^^

..  image:: image/64.PNG
    :scale: 50%
    :align: center

The "off by one vulnerability"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The following code looks correct:

.. literalinclude:: bar.c
   :language: c

It is actually not:

-  We allow the stack to write up to position 256

-  However , the max should be 255

-  If buffer is contiguous to ``saved EBP``, we can rewrite part of it

-  If we put ``\n`` , we make it points to a smaller address

-  Which may eventually be in buff !

-  **Errors due to end char in buffer are quite fluent (hence off by one
   if famous).**

A note on architecture
~~~~~~~~~~~~~~~~~~~~~~

| Beware of the call ``0x10b0 <__x86.get_pc_thunk.bx>`` instruction, it
  basically uses global offset to call dynamic libraries and this is
  done by putting a special value in ``EBX``. Which requires to push
  ``EBX`` before ``EBP``, so that ``EBX`` can be restored when leaving
  the function.

| By erasing saved ``EBX``\ (to reach ``EBP``), you may perturbate the
  next instruction of the calling function (here FOO–the one you’re
  trying to annoy).

-  **Solution:** compile with ``fno-pie``

.. literalinclude:: cat.c
   :language: c

.. literalinclude:: disasscat.sh
   :language: bash

**Solution**:

.. centered:: ``gcc -m32 -g -fno-stack-protector -fno-pie essai1.c -o essai1``

.. literalinclude:: disasscatsol.sh
   :language: bash

Now everything is done with respect to EBP (not the saved value at EBP
address and not EBX).

Common student questions
~~~~~~~~~~~~~~~~~~~~~~~~

-  | *Why did you use C to teach the class ?*
   | Because it is a high level language which offers clear primitives
     to manipulate memory

-  | *Can we have overflow in other languages?* Yes
   | *If yes, why ?*
   | Most of those languages use native functions , which are often
     written in C

-  *Do languages such Java or Python offer other type of attack surface*

   -  Yes, the java byte code is available and can be easily corrupted

   -  Yes, Python’s interpreter is problematic

   -  Serialization can load any type of code

   -  ...
