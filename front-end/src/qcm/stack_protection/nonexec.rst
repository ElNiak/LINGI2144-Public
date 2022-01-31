MCQ 7: Stack Protection
**********************

Question 1. Stack protection
----------------------------

.. question:: sp1
   :nb_prop: 11
   :nb_pos: 3

   |  What exploits are concern for the protection "non executable stack"

   .. positive::

      - ``ret2libc``

   .. negative::

      - Pointer Rewritting Attack

   .. positive::

      - Structured Exception Handling exploit (``SEH``)

   .. positive::

      - Some kind of bruteforce attack

   .. negative::

      - Pointer Redirection Attack

   .. negative::

      - ``ret2text``

   .. negative::

      - ``ret2bss``

   .. negative::

      - ``ret2eax``

   .. negative::

      - ``ret2esp``

   .. negative::

      - ``ret2ret``

   .. negative::

      - Stack stethoscope

.. question:: sp2
   :nb_prop: 11
   :nb_pos: 2

   |  What exploits are concern for the protection "Stack Guard"

   .. negative::

      - ``ret2libc``

   .. positive::

      - Pointer Rewritting Attack

   .. negative::

      - Structured Exception Handling exploit (``SEH``)

   .. positive::

      - Some kind of bruteforce attack

   .. negative::

      - Pointer Redirection Attack

   .. negative::

      - ``ret2text``

   .. negative::

      - ``ret2bss``

   .. negative::

      - ``ret2eax``

   .. negative::

      - ``ret2esp``

   .. negative::

      - ``ret2ret``

   .. negative::

      - Stack stethoscope

.. question:: sp3
   :nb_prop: 11
   :nb_pos: 8

   |  What exploits are concern for the protection "ASLR"

   .. negative::

      - ``ret2libc``

   .. negative::

      - Pointer Rewritting Attack

   .. negative::

      - Structured Exception Handling exploit (``SEH``)

   .. positive::

      - Some kind of bruteforce attack

   .. positive::

      - Pointer Redirection Attack

   .. positive::

      - ``ret2text``

   .. positive::

      - ``ret2bss``

   .. positive::

      - ``ret2eax``

   .. positive::

      - ``ret2esp``

   .. positive::

      - ``ret2ret``

   .. positive::

      - Stack stethoscope