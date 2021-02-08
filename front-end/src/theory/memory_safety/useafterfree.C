typedef struct{
    void (*vulnfunc )();
} exploitable;
void legitimate(){
    printf ("I am the legitimate \n");
}
void bad() {
    printf ("I am the bad function \n");
}
void main(){
    exploitable *malloc1 = malloc(sizeof(exploitable));
    malloc1->vulnfunc = legitimate;
    malloc1->vulnfunc();         //I am the legitimate function
    free(malloc1);               //Prevention: malloc1 = NULL;
    //long *malloc3 = malloc(0); //with that we got a segfault at L1 => malloc3 has now taken the place of malloc2
                                 //in the chunk of the stack.Consequently, malloc3 points to a new chunk that must be assigned
    long *malloc2 = malloc(0);   //Will access the preceding free memory without erasing it.
    *malloc2 = (long)bad;
    malloc1->vulnfunc();         //L1 : I am the bad function
                                 //Should throw memory error
                                 //Explanation : malloc2 took the space of malloc1
}