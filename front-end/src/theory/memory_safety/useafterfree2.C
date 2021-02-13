//example 2
int main(int argc, char ** argv) {
  char *admin = NULL;
  char *name = NULL;
  admin = malloc(32);
  admin[0] = 0;
  if (admin == NULL || admin[0] == 0) //(1) we have admin[0] = 0
      printf("not allowed!\n");
  free(admin); //(2) we free admin, but not set it to Null
  name= malloc(32); //(3) ) name takes the place of admin
  strncpy(name, "pixis", 5); //(4) name[0] is set to “p” and so is admin[0]
  if (admin == NULL || admin[0] == 0) { //(5) admin[0] is thus no longer equal to 0
       printf("not allowed!\n");
       return -1;
   }
   printf("Allowed: you're in secret zone! !\n");
   free(name); 
   name = NULL;
   return 0;
   /*
   should give:                                 
    not allowed!
    not allowed!
   However, it gives:
    not allowed!
    Allowed: you’re in secret zone!
   Admin has been freed, but not set to NULL
   */
}