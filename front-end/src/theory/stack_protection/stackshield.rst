StackShield
-----------

| The main objective is to guarantee that ``saved EIP`` **has not been
  corrupted**. The idea is to maintain a separate **list with all**
  ``saved EIP`` from function calls and each time a function
  terminates, one checks whether ``saved EIP`` is the one in the list.
  Takes an assembly file and produces another one (**not at compiler
  level**).
| Known Limitations:

#. Size of the list is bounded

#. List has to be saved somewhere (very similar to global objects problem)

#. Vulnerable to alter frame pointer, function argument’s control, etc