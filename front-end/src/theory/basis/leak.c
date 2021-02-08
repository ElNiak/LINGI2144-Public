/* leakage.c */
void main() {
    int fd;
    char *v[2];
    fd = open("hifile",O_RDWR      //root owned file
                     | O_APPEND);
    if (fd == -1){
        printf("cannot open file");
        exit(0);
    }
    printf("fd is %d\n", fd);
    setuid(getuid());             //we have lost group's owner privileges
    v[0] = "/bin/sh";
    v[1] = 0;                    //Hack me :We did NOT close fd before launching the shell and fd has root privileges
    execve(v[0],v,0);
}