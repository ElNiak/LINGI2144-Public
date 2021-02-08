To the attention of the students
================================


Adding new MCQ
**************

Very simple, imagine you want to create a new question for ``introduction/introduction.rst``.
First you need to know if you want "radio MCQ" (1 solution on all possible choice) or "checkbox MCQ"
(many solution for all possible choice).

If you choose checkbox MCQ, here what you should have:

.. code-block:: html

    .. question:: security  <!-- id of the question                 -->
       :nb_prop: 6          <!-- number of proposition presented    -->
       :nb_pos: 2           <!-- number of solutions presented (>1) -->

       | Choose the right answer to "Security is ..."

       .. positive:: <!-- solution -->

          - the protection against illegal actions against a society or people.
          - armed with IP filtering  to avoid data theft for example.

       .. positive:: <!-- solution -->

          - not quantifiable.

       .. negative:: <!-- false proposition -->

          - quantifiable with statistics.

       .. negative:: <!-- false proposition -->

          - protection against illegal actions against a society or people.
          - about checksums for example to ensure data is safe from failure.

       .. negative:: <!-- false proposition -->

          - protection against fault with unintended consequences.
          - about checksums for example to ensure data is safe from failure.

       .. negative:: <!-- false proposition -->

          - protection against fault with unintended consequences.
          - armed with IP filtering  to avoid data theft for example.


If you choose radio MCQ, here what you should have:

.. code-block:: html

    .. question:: security  <!-- id of the question                 -->
       :nb_prop: 6          <!-- number of proposition presented    -->
       :nb_pos: 1           <!-- number of solutions presented (==1)-->

       | Choose the right answer to "Security is ..."

       .. positive:: <!-- solution -->

          - the protection against illegal actions against a society or people.
          - armed with IP filtering  to avoid data theft for example.

       .. positive:: <!-- solution -->

          - not quantifiable.

       .. negative:: <!-- false proposition -->

          - quantifiable with statistics.

       .. negative:: <!-- false proposition -->

          - protection against illegal actions against a society or people.
          - about checksums for example to ensure data is safe from failure.

       .. negative:: <!-- false proposition -->

          - protection against fault with unintended consequences.
          - about checksums for example to ensure data is safe from failure.

       .. negative:: <!-- false proposition -->

          - protection against fault with unintended consequences.
          - armed with IP filtering  to avoid data theft for example.

Everything shuffle and compute the result alone thanks to the excellent extension
made by `Lionel Chalet <https://bitbucket.org/u531355/sphinx-form/src/default/>`_.