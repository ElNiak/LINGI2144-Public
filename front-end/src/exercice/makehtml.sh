#!/bin/bash
find . -type f -name "*.rst" -exec touch {} +
make html

files=(/tp0/tp /tp1/tp /tp2/tp /tp3/tp /tp4/tp /tp5/tp /tp6/tp /tp7/tp /tp8/tp /tp9/tp)

for i in "${files[@]}"; do
  touch _build/html${i}.html
  ls -l _build/html${i}.html
  mv _build/html${i}.html _build/html${i}.php
  ls -l _build/html${i}.php
done

files_extra=(/extra/nfsshare /extra/nfsshare2 /extra/heapoverflow /extra/heapoverflow2 /extra/handmadeshellcode /extra/phpmyadmin /extra/en-var /extra/extra /extra/gdb /extra/stackstethoscope)

for i in "${files_extra[@]}"; do
  touch _build/html${i}.html
  ls -l _build/html${i}.html
  mv _build/html${i}.html _build/html${i}.php
  ls -l _build/html${i}.php
done
