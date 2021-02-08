// Old code
val = mem[i];
// New (rewritten) code
meminfo = lookup(mem);
if(unsafe(meminfo,i)) abort();
else  val = mem[i];