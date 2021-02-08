Prevention/Detection
--------------------

#. **Forbid** ``%n``: Does not prevent from reading memory and some
   programs needs it.

#. **Permit only static format strings:** Many programs use dynamic ones
   (e.g Client/Server). In fact, the GNU internationalization library,
   generate format strings dynamically, so this too would break an
   undesirable amount of software.

Lexical Analysis
~~~~~~~~~~~~~~~~

The ``pscan`` tool is a lexical analysis tool that automatically scans
source code for format string vulnerabilities. The scan works by
searching for formatted output functions and applying the following rule

.. centered:: “**IF** the last parameter of the function is the format string, **AND** the
              format string is **NOT** a static string, **THEN** complain”

**Limits:**

-  Does not detect vulnerabilities if arguments follow the string

FormatGuard: Counting the number of arguments (old)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

| Patch to ``glibc`` rather old (from 2002) by restricting the number of
  arguments processed by a variadic function to the actual number of
  arguments passed. Done by replacing the normal call to a modified
  function that uses a specific token based mechanism to count
  arguments. Counting is hard arguments are passed as ``varargs list``,
  which has no counting mechanism. Use CPP macros and specific methods
  to count arguments using ``varargs``.

| **Limits:**

-  Block function that contains fewer conversion convention than
   arguments, can be fixed

-  Indirect call to functions disabled the mechanism

-  Some functions such as ``vprintf`` have their own ``varargs list``

-  CPP macros may not all be compatible with C

-  Requires ``glibc`` compilation, i e source code

Compiler option (now replace formatguard)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

| To warm about uses of format functions where the format string is not
  a string literal and there are no format arguments. View it as
  format-guard embedded.

| Options Wformat (called with ``-Wall``) and ``-Wformat-security`` of
  gcc

.. literalinclude:: wformat.sh
    :language: bash

**Limits:**

-  ``int (*printf_ptr) (const char *format,...)=&printf;``

Libsafe Implementation (for ``%n``)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

| ``Libsafe`` known to implement safer versions of vulnerable ones.
  Version 2 0 prevents format string vulnerability exploits that attempt
  to overwrite return addresses on the stack. ``Libsafe`` logs a warning
  and terminates the targeted process Its first task is to make sure
  that the functions can be safely executed based on their arguments.
  **Does not require source code**. [3]_

| Two checks:

#. The first check examines the pointer argument associated with each
   ``%n`` conversion specifier to determine whether the address
   references a return address or frame pointer

#. The second check determines whether the initial location of the
   argument pointer is in the same stack frame as the final location of
   the argument pointer

**Limits:**

-  Restrict access to current stack frame

-  **Problem:** password may be stored there (hence can be modified/read)

-  **Conclusion:** Does not protect from programs trying to read in the
   stack frame

Testing
~~~~~~~

| It is extremely difficult to construct a test suite that exercises all
  possible paths through a program. A major source of format string bugs
  comes from error reporting code. Because such code is triggered as a
  result of exceptional conditions, these paths are often missed by
  runtime testing.

| **News**: situation is changing (work of Xavier Devroye).

Static Taint Analysis
~~~~~~~~~~~~~~~~~~~~~

Inputs from untrusted sources are marked as tainted, data propagated
from a tainted source is marked as tainted. A warning is generated if
tainted data is interpreted as a format string but can generate a lot of
false positives.

.. [3]
   `Libsafe <https://www.researchgate.net/publication/2400968_Libsafe_20_Detection_of_Format_String_Vulnerability_Exploits>`_
