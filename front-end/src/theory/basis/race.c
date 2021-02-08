/* race.c Compile program as root and give SET-UID to 1*/
int main() {
    struct stat st; FILE* fd ;
    if(!stat("password.txt",&st)) {
        printf("file already exists n");
        return 0;
    }
    fd = fopen("password.txt", "a");  //L1
    fputs("monsupermotdepasse", fd ); //L2
    chmod("password.txt", 700);       //L3
    fclose(fd);
    return 0;
}