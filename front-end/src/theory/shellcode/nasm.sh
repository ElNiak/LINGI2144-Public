nasm display-shell.asm -o display-shell.o -f elf
    && ld -s -m elf_i386 display-shell.o-o display-shell
    && ./affichage-shell