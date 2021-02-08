void public(char *args){
  char buff[12];
  strcpy(buff,args);
  printf("public\n");
}
void secret(void){
  printf("secret function");
}
int main(int argc, char *argv[]){
  if(getuid()==0) secret();
  else public(argv[1]);
 }