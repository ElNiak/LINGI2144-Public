void func(char *arg) {
    char buffer[64];
    strcpy(buffer,arg);
}
int main(int argc, char *argv[])
    if(argc != 2) printf("binary \n");
    else          func(argv[1]);
    return 0;
}