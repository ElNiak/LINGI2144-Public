#StackGuard by default
gcc -m32 password.c -o password
#Disable StackGuard
gcc -m32 -z  -fno-stack-protector password.c -o password
#On a compiled software
readelf -l password | grep STACK
                      GNU_STACK      0x000000 0x00000000 0x00000000 0x00000 0x00000 RW'E' 0x10