int main(int argc , char *argv[]){
    char text [1024];
    static int test_val = -72;
    strcpy(text,argv[1]);
    printf("the right way to do things \n");
    printf("%s",text);
    printf("the wrong way to do things \n");
    printf(text);
    printf("\n");
    printf("test val is %d at 0x%08x and contains 0x%08x",test_val,&test_val,test_val);
    exit(0);
}