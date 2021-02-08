void main() {
    int *a,*b,*c,*d,*e,*f;
    a = malloc(sizeof(int));
    b = malloc(sizeof(int));
    c = malloc(sizeof(int));
    free(a);                 //Justification from here
    free(b);
    free(a);                 //double free
    d = malloc(sizeof(int));
    e = malloc(sizeof(int));
    f = malloc(sizeof(int));
    *d = 5;
    printf("voici la valeur %d",*d);//5
    *f = 6;
    printf("voici la valeur %d",*d);//6
}