disass cat
Dump of assembler code for
function cat:
0x000011a9 <+0>:push % ebp
0x000011aa <+1>:mov % ebp
0x000011ac <+3>:sub $0x28,%esp
0x000011af <+6>:movl $-0xc(%ebp)
0x000011b6 <+13>:sub $0x8,%esp
0x000011b9 <+16>:pushl 0x8(%ebp)
0x000011bc <+19>: lea 0x1c (%ebp), %eax
0x000011bf <+22>: push % eax
0x000011c0 <+23>: call 0x11c1 <cat+24>
0x000011c5 <+28>: add $0x10,%esp
0x000011c8 <+31>: sub $0x8,%esp
0x000011cb <+34>: pushl 0xc (%ebp)
0x000011ce <+37>: push $0x2008
0x000011d3 <+42>: call 0x11d4 <cat+43>
0x000011d8 <+47>: add $0x10,%esp
0x000011db <+50>: nop
0x000011dc <+51>: leave
0x000011dd <+52>: ret
End of assembler dump.