/* arithmetic sbo */
int main() {
    short nb1, nb2, res; //2 bytes
    res = 0;
    printf ("enter first digit : ");             //10 000
    scanf("%hd", &nb1);
    printf("enter second digit : ");             //22 769
    scanf("%hd ", &nb2);
    res = nb1 + nb2;
    printf("%hd + %hd = %hd \n", nb1, nb2, res); // answer: -32 767
}

/*comparison sbo */
int main() {
    int a = 25; unsigned int b = 1000;
    if (a>b) printf ("bravo"); //= result
    else printf ("failure");
}

/*comparison sbo */
int copy(char * buf , int len){
    char kbuf[800];                  //buffer overflow
    if(len > sizeof(kbuf)) return 1; //Put a negative value for len , it will pass
                                     //But will then be interpreted as a huge positive number by memcpy
    return memcpy(kbuf,buf,len);     //memcpy takes an unsigned int as third argument
}