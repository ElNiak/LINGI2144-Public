int f(char ** argv) {
    char *p;
    char a[30];             //Observation: p is before a on the stack (not always)
    p=a;                    //p points to a[0]

    strcpy(p,argv[1]);      //L1 <= vulnerable strcpy(),
                            //Writes on a as p points on a, but in case of overflow, also rewrite p as it follows a in the stack.

    strncpy(p,argv[2],16);  //L2
                            //Writes on address pointed by p which may have been modified by L1
}

void main (int argc, char ** argv) {
    f(argv);
    execl("back_to_vul","",0); //<-- The exec that fails
    printf("End of program\n");
}