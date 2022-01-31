MCQ 4: Assembly/Debugger
************************


Question 1. Assembly
--------------------

..
    From: https://www.sanfoundry.com/computer-organization-mcqs-assembly-language/

.. question:: ass1
   :nb_prop: 4
   :nb_pos: 1

   |  The instructions like ``MOV`` or ``ADD`` are called as

   .. negative::

      -  Operators

   .. negative::

      - Commands

   .. negative::

      - None of the mentioned

   .. positive::

      - OP-Code


.. question:: ass2
   :nb_prop: 4
   :nb_pos: 1

   |  Which register usually contains the result of a function call

   .. negative::

      -  ``EDX``

   .. negative::

      - ``ECX``

   .. negative::

      - ``EBX``

   .. positive::

      - ``EAX``


.. question:: ass3
   :nb_prop: 4
   :nb_pos: 1

   |  Check the true statement

   .. negative::

      This is an example of opaque predicate

      .. code-block:: c

        int a=5,b=9,c=10;
        int sum=a+b;
        if((sum*c)%2) {
            l1();
        } else {
            l1();
            l2();
        }
        if(!(sum*c)%2) {
            l2();
            l3();
        } else {
            l3();
        }

   .. positive::

      This is an example of dynamic predicate

      .. code-block:: c

        int a=5,b=9,c=10;
        int sum=a+b;
        if((sum*c)%2) {
            l1();
        } else {
            l1();
            l2();
        }
        if(!(sum*c)%2) {
            l2();
            l3();
        } else {
            l3();
        }

   .. negative::

      This is an example of dynamic predicate

      .. code-block:: c

        int a=5,b=9,c=10;
        int sum=a+b;
        if((sum*c)%2) {
            printf("Success");
            exit(0);
        }
        printf("Next time!");

   .. positive::

      This is an example of opaque predicate

      .. code-block:: c

        int a=5,b=9,c=10;
        int sum=a+b;
        if((sum*c)%2) {
            printf("Success");
            exit(0);
        }
        printf("Next time!");



Question 2. Debugger
--------------------

..
    From: https://www.sanfoundry.com/gdb-debugger-questions-answers-2/

.. question:: debug1
   :nb_prop: 4
   :nb_pos: 1

   | Which GDB command prints the value of a variable in hex.

   .. positive::

      -  None of the mentioned


   .. negative::

      - ``print/h``

   .. negative::

      -  ``print/x``

   .. negative::

      - ``print/e``

.. question:: debug2
   :nb_prop: 4
   :nb_pos: 1

   | Which GDB command interrupts the program whenever the value of a variable is modified and prints the value old and new values of the variable?

   .. negative::

      -  None of the mentioned


   .. negative::

      - ``trace``

   .. negative::

      -  ``show``

   .. positive::

      - ``watch``

.. question:: debug3
   :nb_prop: 4
   :nb_pos: 1

   | Which GDB command produces a stack trace of the function calls that lead to a segmentation fault?

   .. negative::

      -  none of the mentioned

   .. negative::

      - ``forwardtrace``

   .. negative::

      -  ``trace``

   .. positive::

      - ``backtrace``

.. question:: debug4
   :nb_prop: 4
   :nb_pos: 1

   |  GDB can be used

   .. negative::

      -  to find out the memory leakages

   .. negative::

      - to get the result of a particular expression in a program

   .. negative::

      - to find the reason of segmentation fault

   .. positive::

      - all of the mentioned

