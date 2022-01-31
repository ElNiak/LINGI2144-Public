MCQ 3: Memory Safety
*******************

Question 1. Memory safety
--------------------------

.. question:: memsafety
   :nb_prop: 4
   :nb_pos: 1

   | Which of these propositions are true:

   .. positive::

      We have a spacial memory issue

      .. code-block:: c

        char *ptr = malloc(24);
        for(int i = 0; i < 26; ++i)
            ptr[i] = i + 0x41;

   .. negative::

      We have a temporal memory issue

      .. code-block:: c

        char *ptr = malloc(24);
        for(int i = 0; i < 26; ++i)
            ptr[i] = i + 0x41;


   .. positive::

      We have a temporal memory issue

      .. code-block:: c

        char *ptr = malloc(24);
        free(ptr);
        for(int i = 0; i < 24; ++i)
            ptr[i] = i + 0x41;

   .. negative::

      We have a spacial memory issue

      .. code-block:: c

        char *ptr = malloc(24);
        free(ptr);
        for(int i = 0; i < 26; ++i)
            ptr[i] = i + 0x41;

   .. positive::

      - Buffer overflow and format string are both stack vulnerability.

   .. negative::

      - Buffer overflow and format string are both heap vulnerability.

   .. positive::

      - Heap vulnerability are related to memory allocation/deallocation. This include for example "use after free" or "double free" vulnerabilities.

   .. positive::

      - Buffer overflow may be an example of heap vulnerability since it's about the allocated memory with ``malloc``.
