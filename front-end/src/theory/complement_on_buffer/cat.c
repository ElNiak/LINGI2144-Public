#include stdio.h
#include stdlib.h
#include string.h
void cat(char *argument) {
    int i = 5;
    char buffer[16];
    strcpy(buffer,argument);
    printf("voici i %d",i); //1
}
void main(int argc , char* argv[]) {
    cat(argv[1]);
}