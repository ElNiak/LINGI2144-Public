#Make the stack non executable
gcc -m32 -z  --no_execstack  password.c -o password
#Make it executable = compiler based solution
gcc -m32 -z  --execstack  password.c -o password