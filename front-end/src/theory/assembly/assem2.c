//Before the call
0x0000053e <+0>: lea ecx,[esp+0x4]
0x00000542 <+4>: and esp,0xfffffff0
0x00000545 <+7>: push DWORD PTR [ecx-0x4]
0x00000548 <+10>: push ebp
0x00000549 <+11>: mov ebp,esp
0x0000054b <+13>: push ebx
0x0000054c <+14>: push ecx
0x0000054d <+15>: sub esp,0x10
0x00000550 <+18>: call 0x420
<__x86.get_pc_thunk.bx>
0x00000555 <+23>: add ebx,0x1a83
0x0000055b <+29>: push 0x5          //Push parameters
0x0000055d <+31>: call 0x51d <func> //Call func; includes push EIP

//Entering func
0x0000051d <+0>: push ebp     //Save EBP
0x0000051e <+1>: mov ebp,esp  //New EBP is current ESP
0x00000520 <+3>: sub esp,0x10 //Prepare space for local variables (space depends on the compiler (alignment))

//Exit func
0x0000053c <+31>: leave   //equivalent to MOV ESP, EBP; POP EBP (now EBP point to the other stack frame)
0x0000053d <+32>: ret     //equivalent to POP EIP