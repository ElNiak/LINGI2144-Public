//cbmc file1.c --show-properties --bounds-check --pointer-check
//result: [main.pointer_dereference.6] line 7
//dereference failure: pointer outside object
//bounds in argv[(signed long int)2]: FAILURE

int puts(const char *s) { } 
int main(int argc, char **argv) { 
    puts(argv[2]); 
    return 0; 
}
