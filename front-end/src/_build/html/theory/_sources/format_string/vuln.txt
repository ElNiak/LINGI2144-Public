Some vulnerabilities
--------------------

[4]_ [5]_ [6]_

..  image:: image/29.PNG
    :scale: 80%
    :align: center

The Stunnem vulnerability
~~~~~~~~~~~~~~~~~~~~~~~~~

Secure TCP connection via shannel. ``smtp_client()`` from version 3.2 is
vulnerable

-  ``stunnel -c -n smtp \ -r 127.0.0.1:4444`` (client)

-  ``nc -l -p 4444`` (simulate smtp), ``AAAA%x%x%x%x`` will read
   client’s stack

The ``wu-ftpd`` vulnerability
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Washington University FTP daemon ``wu-ftpd`` is a popular UNIX FTP
server shipped with many distributions of Linux and other UNIX operating
systems. A format string vulnerability exists in the ``insite_exec()``
function of ``wu-ftpd`` versions before 2.6.1. ``wu-ftpd`` is a string
vulnerability where the user input is incorporated in the format string
of a formatted output function in the Site ``Exec`` command
functionality.

The CDE ToolTalk vulnerability
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The common desktop environment CDE is an integrated graphical user
interface that runs on UNIX and Linux operating systems. CDE ToolTalk is
a message brokering system that provides an architecture for
applications to communicate with each other across hosts and platforms.
There is a remotely exploitable format string vulnerability in versions
of the CDE ToolTalk RPC database server.

.. [4]
   `Technique <https://repo.zenk-security.com/Techniques%20d.attaques%20%20.%20%20Failles/Hackin9%20Vulnerabilites%20de%20type%20format%20string.pdf>`_

.. [5]
   http://slidegur.com/doc/1080849/formatted-output-secure-coding-in-c-and-c---robert-c.-sea

.. [6]
   https://cs155.stanford.edu/papers/formatstring-1.2.pdf
