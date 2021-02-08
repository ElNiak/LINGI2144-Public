char globalBuff[256];
void function(char *input){
  char localBuff[256];
  strcpy(localBuff,input);
  strcpy(globalBuff,localBuff);
}
int main(int argc, char *argv[]){
  function(argv[1]);
 }