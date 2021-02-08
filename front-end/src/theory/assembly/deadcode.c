#True code:
jmp next
db 0a 05;
next:
    cmp ecx, 0x2
    je 0x8048069
    mov ebx, 0x2;