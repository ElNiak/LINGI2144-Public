// Old code
val = mem[i];
// New (rewritten) code
if(mem->ptr[i] < mem->base || mem->ptr[i] > mem->base + mem->size) abort();
else  val = mem->ptr[i];