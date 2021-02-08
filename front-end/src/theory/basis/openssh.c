/* Exploits: fail in openssh */
int main(int argc , char* argv[]) {
    int nresp = packet_get_int();                //Usually: 32 bits, i.e., 4294 967 296. If nresp = 1 073 741 824
    if(nresp > 0) {                              //sizeof(char*) = 4 bytes (address), unsigned int
        response = xmalloc(nresp*sizeof(char*)); //1 073 741 824 * 4 = 4 294 967 296 => max value => truncation to 0
        for(i = 0; i < nresp ; i++)
            response[i] = packet_get_string(NULL); //buffer overflow
    }
}