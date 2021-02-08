//main
0x56555586 <+0>: lea ecx ,[esp+0x4]
…
//I. break before call func to know value of EBP : i r ebp : 0xffffd0e8 0xffffd0e8
0x565555c8 <+66>: call 0x5655554d <func> //called at 0x565555c8
0x565555cd <+71>: add esp,0x10           //Saved EIP is the next address
0x565555d0 <+74>: mov eax,0x0
0x565555d5 <+79>: lea esp,[ebp-0x8]
0x565555d8 <+82>: pop ecx
0x565555d9 <+83>: pop ebx
0x565555da <+84>: pop ebp
0x565555db <+85>: lea esp,[ecx-0x4]
0x565555de <+88>: ret

//func
0x5655554d <+0>: push ebp
0x5655554e <+1>: mov ebp,esp
0x56555550 <+3>: push ebx
0x56555551 <+4>: sub esp,0x44        //Space for local variable
0x56555554 <+7>: call 0x56555450 <__x86.get_pc_thunk.bx>
0x56555559 <+12>: add ebx,0x1a7b
0x5655555f <+18>: sub esp,0x8       //Space for the buffer
0x56555562 <+21>: push DWORD_PTR [ebp+0x8]
0x56555565 <+24>: lea eax ,[ebp-0x48]

//Space for buffer : 4*16+8 = 72 bytes, The return address which should be near &buffer + 72 bytes
//Takes 78 bytes: |buffer| + |saved EBP| + |saved EIP| - 2, this should erase 2 bytes of saved EIP + 1 for '\0'
// -> (gdb) run `perl e 'print "A"x78'`