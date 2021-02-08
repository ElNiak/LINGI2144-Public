/proc/sys/kernel/randomize_va_space
#If x = 0, randomization is disabled, if x=2 then it is enabled

#Disable
cat /proc/self/maps | egrep '(libc|stack)'
7ffff79e4000-7ffff7bcb000 r-xp 00000000 08:01 1967871                   /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7bcb000-7ffff7dcb000 ---p 001e7000 08:01 1967871                    /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7dcb000-7ffff7dcf000 r--p 001e7000 08:01 1967871                     /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7dcf000-7ffff7dd1000 rw-p 001eb000 08:01 1967871                   /lib/x86_64-linux-gnu/libc-2.27.so
7ffffffde000-7ffffffff000 rw-p 00000000 00:00 0                                     [stack]


cat /proc/self/maps | egrep '(libc|stack)'
7ffff79e4000-7ffff7bcb000 r-xp 00000000 08:01 1967871                    /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7bcb000-7ffff7dcb000 ---p 001e7000 08:01 1967871                     /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7dcb000-7ffff7dcf000 r--p 001e7000 08:01 1967871                      /lib/x86_64-linux-gnu/libc-2.27.so
7ffff7dcf000-7ffff7dd1000 rw-p 001eb000 08:01 1967871                    /lib/x86_64-linux-gnu/libc-2.27.so
7ffffffde000-7ffffffff000 rw-p 00000000 00:00 0                                      [stack]

#Enable
cat /proc/self/maps | egrep '(libc|stack)'
7f83bd643000-7f83bd82a000 r-xp 00000000 08:01 1967871           /lib/x86_64-linux-gnu/libc-2.27.so
7f83bd82a000-7f83bda2a000 ---p 001e7000 08:01 1967871            /lib/x86_64-linux-gnu/libc-2.27.so
7f83bda2a000-7f83bda2e000 r--p 001e7000 08:01 1967871            /lib/x86_64-linux-gnu/libc-2.27.so
7f83bda2e000-7f83bda30000 rw-p 001eb000 08:01 1967871          /lib/x86_64-linux-gnu/libc-2.27.so
7ffc75b81000-7ffc75ba2000 rw-p 00000000 00:00 0                          [stack]

cat /proc/self/maps | egrep '(libc|stack)'
7f3c9bab6000-7f3c9bc9d000 r-xp 00000000 08:01 1967871            /lib/x86_64-linux-gnu/libc-2.27.so
7f3c9bc9d000-7f3c9be9d000 ---p 001e7000 08:01 1967871             /lib/x86_64-linux-gnu/libc-2.27.so
7f3c9be9d000-7f3c9bea1000 r--p 001e7000 08:01 1967871             /lib/x86_64-linux-gnu/libc-2.27.so
7f3c9bea1000-7f3c9bea3000 rw-p 001eb000 08:01 1967871            /lib/x86_64-linux-gnu/libc-2.27.so
7ffe91732000-7ffe91753000 rw-p 00000000 00:00 0                          [stack]