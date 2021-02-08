char *s,c; int state = 0;
while(1){
    c = input();
    s = input();
    if(c =='[' && state == 0) state=1; if(c =='(' && state == 1) state=2;
    if(c =='{' && state == 2) state=3; if(c =='~' && state == 3) state=4;
    if(c =='a' && state == 4) state=5; if(c =='x' && state == 5) state=6;
    if(c =='}' && state == 6) state=7; if(c ==')' && state == 7) state=8;
    if(c ==']' && state == 8) state=9;
    if(s[0]=='r' && s[1] ='=e' && s[2] = 's' && s[3] == 'e'
    && s[4] == 't' && s[5] == 0 && state == 9){ ERROR;}
}