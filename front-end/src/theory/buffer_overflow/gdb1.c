//main
0x56555607 <+34>: mov eax,DWORD PTR [eax]
0x56555609 <+36>: sub esp,0xc
0x5655560c <+39>: push eax
0x5655560d <+40>: call 0x5655557d <check_authentification> //breakpoint I
0x56555612 <+45>: add esp,0x10                             //Saved EIP
0x56555615 <+48>: test eax,eax
//check_authentification
0x56555599 <+28>: push DWORD PTR [ebp+0x8]
0x5655559c <+31>: lea eax ,[ebp 0x1c]
0x5655559f <+34>: push eax
0x565555a0 <+35>: call 0x56555410 <strcpy@plt>            //breakpoint II
0x565555a5 <+40>: add esp,0x10