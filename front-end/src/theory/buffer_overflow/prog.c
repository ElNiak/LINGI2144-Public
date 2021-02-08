/* prog.c */
int check_authentification(char *password) {
    int auth_flag = 0;
    char password_buffer[16];
    strcpy(password_buffer,password); //vulnerability : strcpy does not check |worduser| <= |buff|
    if(strcmp password_buffer,"good ")==0)
        auth_flag = 1;
    else
        printf"bad password!");
    return auth_flag;
}
void main(int argc , char* argv[]) {
    if(check_authentification argv[1])
        printf("access granted");
}