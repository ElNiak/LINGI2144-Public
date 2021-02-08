Section .text
jump code
hello_world: db ‘hello world’, 0xa
code: ...
lea rsi,[rel hello_world]