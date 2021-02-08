disass cat
Dump of assembler code for functioncat:
0x000011a9 <+0>:push %ebp
//EBX is saved before pc_thunk_bx and restored afterwards
//If you erase saved EBX you may perturbate the rest of execution
0x000011aa <+1>:mov %esp,%ebp
0x000011ac <+3>:push %ebx
0x000011ad <+4>:sub $0x24,%esp
0x000011b0 <+7>:call 0x10b0 <__x86.get_pc_thunk.bx>
…
0x000011ea <+65>:mov -0x4(%ebp),%ebx  //1
0x000011ed <+68>:leave
0x000011ee <+69>:ret
End of assembler dump.