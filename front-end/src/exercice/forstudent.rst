To the attention of the students
================================


Adding new tutorial
*******************


For the attention of students wishing to add any tutorials,
here is how to proceed:

#. | First since we use Sphinx, we only need to write the document in
     Restructured Text (reST) which is very easy. You can find some example
     in the git or `online <https://thomas-cokelaer.info/tutorials/sphinx/rest_syntax.html>`_.

#. | Now, let's consider that you are currently in the folder ``exercice``, then you simply need to add your
     file in ``folder/mytuto.rst``.

#. | Then  to update ``index.rst`` in the "Extra Tutorial" section, the sphinx "toc", with
     ``folder/mytuto``.

#. | Finally since use ``PHP`` for the solution part, you should also add in ``exercice/makehtml.sh``,
     ``folder/mytuto`` in ``files_extra`` array.

Now everything is ready for the build, you can in the root folder of the project, execute ``makeallhtml.sh`` and
voila.

PHP for the solution
********************

This part is not perfect so feel free to improve if you want but here is how to proceed if you want to add solution.
You need to add at the end of the current section/question the following code in you ``.rst`` file. This will add the button
"Show solution" and link it to all te solution of the question.

.. code-block:: html

    .. raw:: html

       <?php
             if($good) { //not for you
                //nothing
             } else {
                echo '<script type="text/javascript">',
                         'updateSol("tp1_0_1",".tp1_s0","php-for-the-solution");',
                      '</script>';
                include "../_static/solution.html";
             }
       ?>

Then for each solution that you want to hide with the preceding button, put the following code

.. code-block:: html

    .. raw:: html <!-- "Header" of solution -->

       <div class="collapse tp1_s0" id="tp1_0_1">

    ..  image:: imageTP/1.PNG <!-- Solution content -->
        :scale: 60%
        :align: center
        :class: sol-img

    .. raw:: html <!-- End of solution-->

       </div>

Note that for many ids, here how to use the ``updateSol()`` function:

.. centered:: ``updateSol(<class>,<id1 id2 ... idn>,<section of question>)``


Adding extra material files
***************************

If you want to add new file such ``files.zip`` or ``LINGI2144_TPs.pdf`` (need these name) file for a tutorial
``folder/mytuto.rst`` here is how to proceed:


#. | First for a put them in ``exercice/_static/dl/mytuto/<zip or pdf>``.

#. | Then you need to modify ``exercice/_static/script.js`` by adding in
     either ``getTPpdf(path)`` or either ``getTPzip(path)``, but let's take
     the pdf as example:

   .. code-block:: js

        var myvar = "mytuto";
        ...
        else if (path.contains(myvar)) {
            pdf = pdf + myvar;
        }

Adding extra material video
***************************

If you want to add new video for a tutorial ``folder/mytuto.rst``, all you need to do is:

#. | Create a file ``exercice/_static/mytuto.html``

   .. code-block:: html

    <iframe class="embed-responsive-item" id="video"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen  frameborder="0" src="<https://www.youtube.com/embed/your link>">
    </iframe>

#. | Then you need to modify ``exercice/_static/script.js`` by adding in
     either ``getVideo(path)``

   .. code-block:: js

        else if (path.contains("tp9")) {
            vid = "../_static/video/mytuto.html";
        }