void foo(char *buffer) {
    char newbuffer[32];
    strcpy(newbuffer,buffer);
}
int main() {
    char *buffer = malloc(44*sizeof(char)); //32*sizeof(char)
    memset(buffer, '\x90',44);
    //0x565555f1 <+116>: call 0x56555608 <foo>
    buffer[44]='\xf1';
    buffer[45]='\x55';
    buffer[46]='\x55';
    buffer[47]='\x56';
    foot(buffer);
}