int main(int argc , char* argv[]) {
    unsigned short s;       //Max val = 65535
    int i;
    char buf[80];
    i = atoi(argv[1]);      //i=65536 and s=0
    s = i ;
    if(s>=80) return 1;     //pass
    printf("s = %d n", s);
    memcpy(buf,argv[2],i);
    buf[i] = '\0';          // = buf[65536] => buffer overflow
    printf("%s n", buf );
    return 0;
}