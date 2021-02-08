if (!access("/tmp/cool", W_OK)) {   //L1
    f = open("/tmp/cool", O_WRITE); //L2
    write_to_file(f);               //L3
} else {
    fprintf(stderr,"Permission denied n");
}