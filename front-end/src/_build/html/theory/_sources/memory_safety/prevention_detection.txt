Prevention/detection
--------------------

Protections
~~~~~~~~~~~

#. **(static) Detection** consists in deploying a series of techniques
   to check whether software suffers from a memory access error

   -  Techniques for detection includes (but are not limited to):
      fuzzing, static code analysis, formal verification, model based
      testing, control flow integrity...

#. **Runtime solution** consists in deploying techniques to prevent
   memory access errors during execution (in which case the software is
   stopped)

   -  Runtime solutions include fat pointers and global objects.

| Should be deployed when being **taken off-the-shell**, detection is
  definitively useful but is likely to cost or to be imprecise. We have
  a false positive vs a false negative trade off.

| There are also problems related to knowledge since we may not have all
  information regarding dynamic libraries or about the environment in
  where the software is used. Unfortunately detection tools are very
  static and need full knowledge consequently, a runtime protection may
  be useful. In fact, it will mainly depends on the time you have, on
  code compatibility, or on code complexity.

Static Detection
~~~~~~~~~~~~~~~~

Detection solutions typically done at **conception** time:

-  | **Testing** (which test specification)
   | Compares input/output wrt a model/some requirements and requires
     manual writing of all the test code/cases. Good for testing what
     the test writer knows/spec but **rarely catches anything unexpected
     (problematic for security)**. Good coverage requires extensive test
     writing (E.g. to test all of a :math:`64` bit input requires
     :math:`2^{64}` tests). Not effective for (non trivial) memory
     problems, difficult for concurrent systems (quantitative systems
     are even worse)

-  | **Fuzzing inputs** (modify structure, outside specifications)
   | Good for adding “noise” to functions/values (push it where things
     are not specified). Good fuzzers can find interesting errors
     (exhausts unspecified inputs :math:`\rightarrow` **great for
     security**). As before, good coverage requires extensive running of
     the fuzzer. Difficult to fuzz input without clear strategy
     (symbolic execution or deep learning) but purely random in many
     cases.

   -  Well known tool: ``American fuzzer loop``, ``radamsa`` , ``zzuff``, ``webfuzz``
      (for the web).

-  | **Verification**
   | Tries to verify system represented by a **math model**. Usually a
     combination of manual and automated efforts (fully not yet
     feasible). It allow to prove that bugs do not exist, since lack of
     proof implies bug is possible. Longly considered as impractical
     since too big and unclear semantics/specification but recent
     progress can make it useful for ecology/energy saving.

-  **Model checking** (not really used)

.. image:: /memory_safety/image/7.PNG
   :scale: 50%
   :align: center

-  | **Symbolic execution** (may use CP to be solved but may not always
     be applied and may lead to state explosion)
   | Tries to combine execution (testing, fuzzing) with formal methods
     (verification), T-towards “clever coverage fuzzing”. Good for
     reasoning over complex code, better coverage than classical
     fuzzing. Can find memory problems with precise examples, can
     produce constraints/conditions of memory problem.

   -  Well known tools: ``Dart``, ``Cute``, ``Klee`` (used by Microsoft)

.. image:: /memory_safety/image/8.PNG
   :scale: 50%
   :align: center

-  | **Concolic execution**

   - | In symbolic testing constraints may be hard to solve

   - | Moreover sometimes one needs a precise representation of data (API, ...)

   - | So the solution is to execute the system both symbolically and concretely on specific inputs.

-  | **Hybrid Concolic testing** (K. Sen and R. Majumdar)

   - Mix of random fuzzing:

     - After few thousand trials we reach state 9

     - However, probability to generate reset is weak!

   - and concolic execution: 17 choices and at least 9 iterations to reach ERROR (This means 17^9)

   .. literalinclude:: conc.c
      :language: c

-  ...

Goal is to help development avoid mistakes, but all have limitations.

Runtime Solutions
~~~~~~~~~~~~~~~~~

Detection solutions designed to operate at runtime:

#. **Tripwire**: Add markers in memory (at the bounds of allocations, of
   the stack and in freed memory) that “trip” when accessed to show
   problems, used by Valgrind, ...

   -  Memory, stack and lookup overhead

   -  Works with existing code

   -  Not perfect

   .. literalinclude:: tripwire.c
      :language: c

.. image:: /memory_safety/image/9.PNG
   :scale: 50%
   :align: center

2. **Object Based**: Store information on memory allocations and check
   pointers are valid on dereference. All “objects” are stored with
   their metadata in a global store which has lookup from pointer value,
   used by SafeCode

   -  Global store requires memory, Store lookup overhead is high

   -  Works with existing code

   -  Not perfect (object table can be corrupted)

   .. literalinclude:: objectbased.c
      :language: c

3. **Pointer based**: Change how pointers are defined modifications
   (e.g. “fat pointers”) and then check their additional information
   (current address, pointer base address and pointer allocation size)
   on dereference. Pointer access is now an inlined function to check
   the access is safe (value inside base + size), used by Cyclone,
   CCured

   -  Small memory overhead, Local and easy checking

   -  Does not work with existing code (change of data structure for
      pointers)

   -  Not perfect

   .. literalinclude:: pointerbased.c
      :language: c

4. **Softbound**: Add additional pointer information as extra variables
   in the code (Pointers are now accompanied by local variables that
   also store metadata, pointer base address and pointer allocation size
   :math:`\rightarrow` Main difference with fat pointers. Makes it
   compatible with existing code!) and check their values at
   dereference. Pointer access is now an inlined function check the
   access is safe (value inside base + size), used by SoftBound

   -  Very small memory overhead but some stack overhead

   -  Local and easy checking

   -  Works with existing code

   -  Not perfect

   .. literalinclude:: softbound.c
      :language: c

   **Breaking SoftBound**: Softbound pointer information fails for sub objects. (see slide 108)
   Consider code example of “my_object” and the following two “normal” examples:

   .. literalinclude:: myobj.c
      :language: c

   .. literalinclude:: ex1.c
      :language: c

   .. literalinclude:: ex2.c
      :language: c

   If SoftBound prevents "Example A" by checking the size of “str”, then this will also stop "Example B" since “ptr” is bigger than the
   size of “name” (8 bytes). This would break copy constructors and lots of normal code that has the structure of "Example B".

   If SoftBound allows "Example A", then this allows an overflow of the “name” field into the “id” field (but allows "Example B").
   So if SoftBound allows normal copy constructors, then this allows overflow of sub-objects such as “name” here into “id”!

What about untyped languages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Languages such as Python or HTML are weakly typed, however such language
are often written with language such as C. Consequently, they can suffer
from memory vulnerability, we just need to know internal detail of the
language we are using.

What about java
^^^^^^^^^^^^^^^

Some languages do handle memory vulnerability as “exceptions" In case
cmd is not defined cmd string will be NULL and Java will throw a
``NULL POINTER EXCEPTION``.

.. literalinclude:: jv.java
   :language: java

There is also vulnerability when using **reflexion**.
