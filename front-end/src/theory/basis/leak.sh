$ ./leakage
fd is 3
$ echo hellocat >&3
$ more hifile
hellocat
$ exit