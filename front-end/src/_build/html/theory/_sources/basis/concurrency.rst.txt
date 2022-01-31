Exploit Concurrency
-------------------

A race condition involves two (or more) processes, it exploits the
``context()`` switch between the processes and tries to create an
inadequate interleaving.  [1]_ The goal for an attacker is to interleave
its actions with process with legitimate process actions.

.. warning:: **This can be used to get more privileges for example, to read and write non owned
             files.**

Read a file
~~~~~~~~~~~

.. admonition:: Question
   :class: admonition note alert alert-info

   **Is there a way to read the new value put in** ``password.txt`` **if not root ?**

| **Answer:** Yes, during a short period of time

#. *P1.L1* creates a file, then *P1.L2* restricts access to itself only

#. *P2* tries to read the file

#. If *P2* occurs between *P1.L1* and *P1.L2*, then it can read the
   file,

#. If it occurs after *P1.L2*, then it can’t.

If L1 in ``exploit.c`` happens before L3 in ``race.c`` , then the file can be
read.

.. literalinclude:: race.c
   :language: c

.. literalinclude:: exploit.c
   :language: c


.. literalinclude:: exploit.sh
   :language: bash

Write a file
~~~~~~~~~~~~

We assume that the code has SET-UID flags set to 1 and the code is **not
run** by root. Can I write on ``/etc/passwd`` ? [2]_

-  Yes, idea : ``/tmp/X`` can point out ``/etc/passwd`` in between L1
   and L2.

-  In between: delete ``/tmp/X`` and create a symbolic link ``/tmp/X`` to
   ``/etc/passwd``

-  Hard to reach, we should slow down the computer by creating many
   other attack processes as we can.

.. literalinclude:: write.c
   :language: c

Well known race condition vulnerabilities
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+-----------------------------------------------------------------------------------------+------------------------------------------------------------------------------------+
| Vulnerability :                                                                         | Exploit :                                                                          |
+=========================================================================================+====================================================================================+
| In Copy On Write, memory operations such as read are made on a copy of a section        | Obtaining root permissions in Android devices                                      |
| of memory until a change is made                                                        |                                                                                    |
+-----------------------------------------------------------------------------------------+------------------------------------------------------------------------------------+
| A race condition happens when two different processes are accessing the same page       | Modify shell and performs an additional, unexpected functions, such as a keylogger |
+-----------------------------------------------------------------------------------------+------------------------------------------------------------------------------------+
| The process which is allowed to write flag the destination page to writable             | Link to malware                                                                    |
+-----------------------------------------------------------------------------------------+------------------------------------------------------------------------------------+
| However, a ``context()`` switch can happen between the time it flags, write, and unflag |                                                                                    |
+-----------------------------------------------------------------------------------------+------------------------------------------------------------------------------------+

-  **Prevention** : make sure that it will not happen

   -  | **Static**: type based, *race free type systems*
      | Associate a lock to each variable directly in the type

      .. literalinclude:: prev.java
          :language: java

      | **Limits:** Erase any potential race condition, but burden in
        annotations, it is limited to what we can write and does not
        exploit knowledge in thread ordering.

   -  | **Dynamic and Hybrid Race Detectors**: : lockset, happens before.
      | The principle is to detect race condition at runtime and remove
        all the constraints from type system. It is limited by the false
        positive (false detection) and false negative (not detected).

      | *Locksets*:

      -  Assume each thread t hold a set of locks ``locks_held(t)``

      -  For each shared variable ``v``, maintains a set of candidate
         locks ``C(v)``

      -  ``C(v)`` contains the locks that should protect ``v`` during
         the whole computation

      -  Each time ``v`` is accessed, take ``C(v)`` inter
         ``locks_held(t)``

      -  If intersection is empty, declare potential race condition

      -  (one lock for the whole duration, else it may be a race
         condition)

      | There is no lock to protect v during the entire computation but there is no race condition

      =========== ============= ========
      **Program** **lock_held** **C(v)**
      lock(m1)    { }           {m1,m2}
      v=v+1       {m1}
      unlock(m1)                {m1}
      lock(m2)    { }
      v=v+1       {m2}
      unlock(m2)                { }
      =========== ============= ========

      | **Too conservative**: access without lock :math:`\Rightarrow` alarm. This
        may imply false positive. **At initialization**, shared variables are
        frequently initialized without locks. A **read-shared data** are
        variables written at initialization and read-only thereafter and does
        not need a lock. **Read-write locks** allow one single write and
        multiple readers but are more complex.

      | Moreover it may miss race conditions (false negative): due to
        unrecognized thread API, initialization in different threads and some
        specific case.

-  | **Detection**: write a program, and then use a tool to detect
     (Model checking, static analysis, ...)
   | **Ultimate solution**: Explore all orders, :math:`t` threads of
     :math:`n` instructions each gives :math:`t^{nt}` order.
   | Solution:
     detect feasible races among feasible orders. (e.g ``Infer`` by
     facebook or ``Ladybug``)

   -  Depends on position in development process


Race condition and compiler options
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. literalinclude:: compiler.c
   :language: c

Will it always terminate ?

-  Depends of ``gcc`` options

-  With ``-o3`` (all optimisations): no

-  Why?

   -  The variable c is likely to stay local in a register, hence it
      won’t be shared.

   -  "volatile" variable



.. [1]
   https://www.hacktion.be/race-condition/

.. [2]
   `Inspired from <http://www.cis.syr.edu/~wedu/Teaching/IntrCompSec/LectureNotes_New/Race_Condition.pdf>`_
