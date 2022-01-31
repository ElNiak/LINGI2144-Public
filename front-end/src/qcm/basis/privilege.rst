MCQ 2: Basic attacks/defences
=============================

Question 1. Privileges escalation
---------------------------------

..
    https://searchsecurity.techtarget.com/quiz/Test-your-privileged-user-management-knowledge?q0=0&q1=0&q2=0&q3=0&q4=0&q5=0&q6=0&x=63&y=17

.. question:: security
   :nb_prop: 4
   :nb_pos: 1

   | The security principle of least privilege is:

   .. positive::

      - The practice of limiting permissions to the minimal level that will allow users to perform their jobs.


   .. negative::

      - The practice of increasing permissions to a level that will allow users to perform their jobs and those of their supervisor.

   .. negative::

      - The practice of limiting permissions to a level that will allow users to perform their jobs and those of their immediate colleagues.

   .. negative::

      - The practice of increasing permissions to a level that will allow users to use the cloud services of their choice in order to get their jobs done more quickly.

.. question:: security2
   :nb_prop: 4
   :nb_pos: 1

   | Why does privilege creep (gradual accumulation of access rights beyond what an individual needs) pose a security risk?

   .. positive::

      -  Users have more privileges than they need and may use them to perform actions outside of their job description.


   .. negative::

      - Users privileges don't match their job or role responsibilities.

   .. negative::

      - Because with more privileges there are more responsibilities.

   .. negative::

      - Auditors won't be happy that there is a mismatch between an individual's responsibilities and their privilege and access rights.


.. question:: security3
   :nb_prop: 5
   :nb_pos: 1

   | Which of the following is not best practice:

   .. positive::

      - Providing training covering the responsibilities that come with privileged access once a new employee has been added organization's identity and access management system.

   .. negative::

      - A well-documented off-boarding process.

   .. negative::

      - Enforcing the principle of least privilege.

   .. negative::

      - Routinely reviewing role-based privileges to ensure the associated privileges are still relevant and required.

   .. negative::

      - Identifying and reducing the number of privileged accounts.



Question 2. Integer Overflow
-----------------------------

.. question:: integeroverflow
   :nb_prop: 4
   :nb_pos: 1

   | Tell which input will produce an integer overflow or produce a segmentation fault:

   .. code-block:: c

        int main(int argc, char *argv[]) {
            char buf[20];
            int i=atoi(argv[1]);
            memcpy(buf,argv[2],i*sizeof(int));
            printf("the number is:%d=%d\n",i,i*sizeof(int));
            printf("the buffer is:%s\n",buf);
        }

   .. positive::

      - ``argv[1]=-1`` and ``argv[2]="a swag string"``

   .. positive::

      - ``argv[1]=2147483648`` and ``argv[2]="a swag string"``

   .. positive::

      - ``argv[1]=2147483646`` and ``argv[2]="a swag string"``

   .. negative::

      - ``argv[1]=1`` and ``argv[2]="a swag string"``

   .. negative::

      - ``argv[1]=6`` and ``argv[2]="a swag string"``


.. question:: integeroverflow2
   :nb_prop: 4
   :nb_pos: 1

   | How could we fix that ?

   .. positive::

      .. code-block:: c

        int main(int argc, char *argv[]) {
            char buf[20];
            int i=atoi(argv[1]);
            if(i < 0 || i > MAX_INT || i > strlen(argv[2])) return -1;
            memcpy(buf,argv[2],i*sizeof(int));
            printf("the number is:%d=%d\n",i,i*sizeof(int));
            printf("the buffer is:%s\n",buf);
        }

   .. positive::

      .. code-block:: c

        int main(int argc, char *argv[]) {
            char buf[20];
            uint i=atoi(argv[1]);
            if(i > MAX_UINT || i > strlen(argv[2])) return -1;
            memcpy(buf,argv[2],i*sizeof(int));
            printf("the number is:%d=%d\n",i,i*sizeof(int));
            printf("the buffer is:%s\n",buf);
        }

   .. negative::

      .. code-block:: c

        int main(int argc, char *argv[]) {
            char buf[20];
            int i=atoi(argv[1]);
            if(i > strlen(argv[2])) return -1
            memcpy(buf,argv[2],i*sizeof(int));
            printf("the number is:%d=%d\n",i,i*sizeof(int));
            printf("the buffer is:%s\n",buf);
        }

   .. negative::

      .. code-block:: c

        int main(int argc, char *argv[]) {
            char buf[20];
            int i=atoi(argv[1]);
            if(i < 0 || i > MAX_INT) return -1;
            memcpy(buf,argv[2],i*sizeof(int));
            printf("the number is:%d=%d\n",i,i*sizeof(int));
            printf("the buffer is:%s\n",buf);
        }


Question 3. Concurrency
-----------------------

.. question:: concu
   :nb_prop: 5
   :nb_pos: 1

   | Tell which sentence is true:

   .. positive::

      - CWE-362: Race condition: “The program contains a code sequence that can run concurrently with other code, and the code sequence requires temporary, exclusive access to a shared resource, but a timing window exists in which the shared resource can be modified by another code sequence that is operating concurrently.”

   .. positive::

      - CWE-662: Improper Synchronization: “The software utilizes multiple threads or processes to allow temporary access to a shared resource that can only be exclusive to one process at a time, but it does not properly synchronize these actions, which might cause simultaneous accesses of this resource by multiple threads or processes.”

   .. positive::

      - CWE-367: Time-of-check Time-of-use (TOCTOU) "The software checks the state of a resource before using that resource, but the resource's state can change between the check and the use in a way that invalidates the results of the check. This can cause the software to perform invalid actions when the resource is in an unexpected state."

   .. positive::

      - CWE-1037: Processor Optimization Removal or Modification of Security-critical Code "The developer builds a security-critical protection mechanism into the software, but the processor optimizes the execution of the program such that the mechanism is removed or modified."


   .. negative::

      - CWE-662: Improper Synchronization: “The program contains a code sequence that can run concurrently with other code, and the code sequence requires temporary, exclusive access to a shared resource, but a timing window exists in which the shared resource can be modified by another code sequence that is operating concurrently.”

   .. negative::

      - CWE-362: Race condition: “The software utilizes multiple threads or processes to allow temporary access to a shared resource that can only be exclusive to one process at a time, but it does not properly synchronize these actions, which might cause simultaneous accesses of this resource by multiple threads or processes.”

   .. negative::

      - CWE-1037: Processor Optimization Removal or Modification of Security-critical Code "The software checks the state of a resource before using that resource, but the resource's state can change between the check and the use in a way that invalidates the results of the check. This can cause the software to perform invalid actions when the resource is in an unexpected state."

   .. negative::

      - CWE-367: Time-of-check Time-of-use (TOCTOU) "The developer builds a security-critical protection mechanism into the software, but the processor optimizes the execution of the program such that the mechanism is removed or modified."


   .. negative::

      - CWE-1037: Processor Optimization Removal or Modification of Security-critical Code “The program contains a code sequence that can run concurrently with other code, and the code sequence requires temporary, exclusive access to a shared resource, but a timing window exists in which the shared resource can be modified by another code sequence that is operating concurrently.”

   .. negative::

      - CWE-367: Time-of-check Time-of-use (TOCTOU) The software utilizes multiple threads or processes to allow temporary access to a shared resource that can only be exclusive to one process at a time, but it does not properly synchronize these actions, which might cause simultaneous accesses of this resource by multiple threads or processes.”

   .. negative::

      - CWE-662: Improper Synchronization: "The software checks the state of a resource before using that resource, but the resource's state can change between the check and the use in a way that invalidates the results of the check. This can cause the software to perform invalid actions when the resource is in an unexpected state."

   .. negative::

      - CWE-362: Race condition: "The developer builds a security-critical protection mechanism into the software, but the processor optimizes the execution of the program such that the mechanism is removed or modified."

