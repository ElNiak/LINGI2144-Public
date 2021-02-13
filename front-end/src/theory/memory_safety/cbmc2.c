// cbmc file1.c --show-properties --bounds-check --pointer-check
// result: nothing bad
void foo(int x) {
    int buf[10];
    buf[x] = 0; // <- ERROR
    if (x == 1000) {}
}
int main() {
    srand(time(NULL));
    foo(rand()%1000);
}