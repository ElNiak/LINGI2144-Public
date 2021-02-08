// Old code
val = mem[i];
// New (rewritten) code
if(mem < mem->base || mem > mem->base + mem->size) abort();
else  val = mem;