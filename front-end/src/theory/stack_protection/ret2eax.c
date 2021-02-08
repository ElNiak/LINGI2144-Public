void function(char *str){
  char buf[256];
  strcpy(buf, str);
}
int main(int argc, char **argv[]){
  function(argv[1]);
}