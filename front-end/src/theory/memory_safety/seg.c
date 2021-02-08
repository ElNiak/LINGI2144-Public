#include <stdio.h>
void main() {
    int buffer[10];
    printf("here is the value d",buffer[1000]);
    //Segmentation fault = Access data which is potentially outside of stack of the process, or not allowed
    //No SF certainly means that we touch something still in the stack
}