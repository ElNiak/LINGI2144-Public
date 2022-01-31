MCQ 8: Format String
********************

Question 1. Format String
--------------------------


..
    From: https://resources.infosecinstitute.com/exploiting-protostar-format-string-vulnerabilities/#gref

.. question:: shell
   :nb_prop: 4
   :nb_pos: 1

   | Consider the following code:

   .. code-block:: c

        #include <stdlib.h>
        #include <unistd.h>
        #include <stdio.h>
        #include <string.h>

        void vuln() {
            char buffer[512];
            fgets(buffer, sizeof(buffer), stdin);
            printf(buffer);
            if(target == 0x01025544) {
                printf(“you have modified the target :)\n”);
            } else {
                printf(“target is %08x :(\n”, target);
            }
        }

        int main(int argc, char **argv) {
            vuln();
        }


   | What would the resulting shellcode if this program ?

   .. positive::

      -

   .. negative::

      -

   .. negative::

      -


   .. negative::

      -
