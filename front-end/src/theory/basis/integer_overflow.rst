Integer Overflow
-----------------

An **integer overflow** occurs when an arithmetic operation attempts to
create a numeric value that is outside of the range that can be
represented with a given number of digits, either larger than the
maximum or lower than the minimum representable value. Can compromise
safety/security: crash system, or obtain privileges, or even prepare a
buffer overflow, etc. Confusion between safety and security is high
here.

.. container::
   :name: tab:my-table

   .. table:: Integer range

      +------------------+----------+------------------+------------------+
      |                  | **Size** | **Range**        |                  |
      +------------------+----------+------------------+------------------+
      | **int**          | 2 bytes  | -32.768 **to**   |                  |
      |                  |          | 32767            |                  |
      +------------------+----------+------------------+------------------+
      | **int**          | 4 bytes  | -2.147.483.648   |                  |
      |                  |          | **to**           |                  |
      |                  |          | 2.147.483.647    |                  |
      +------------------+----------+------------------+------------------+
      | **unsigned int** | 2 bytes  | 0 **to** 65535   |                  |
      +------------------+----------+------------------+------------------+
      | **unsigned int** | 4 bytes  | 0 **to**         |                  |
      |                  |          | 4.294.967.295    |                  |
      +------------------+----------+------------------+------------------+
      | **short**        | 2 bytes  | -32.768 **to**   |                  |
      |                  |          | 32767            |                  |
      +------------------+----------+------------------+------------------+
      | **unsigned       | 2 bytes  | 0 **to** 65535   |                  |
      | short**          |          |                  |                  |
      +------------------+----------+------------------+------------------+
      | **long**         | 8 bytes  | -922             |                  |
      |                  |          | 3372036854775808 |                  |
      |                  |          | **to**           |                  |
      |                  |          | 922              |                  |
      |                  |          | 3372036854775807 |                  |
      +------------------+----------+------------------+------------------+
      | **unsigned       | 8 bytes  | 0 **to**         |                  |
      | long**           |          | 1844             |                  |
      |                  |          | 6744073709551615 |                  |
      +------------------+----------+------------------+------------------+
      | **float**        | 4 bytes  | 1.2E38 **to**    | (6 decimal       |
      |                  |          | 3.4E+38          | places)          |
      +------------------+----------+------------------+------------------+
      | **double**       | 8 bytes  | 2.3E308          | (15 decimal      |
      |                  |          | **to**\ 1.7E+308 | places)          |
      +------------------+----------+------------------+------------------+
      | **long double**  | 10 bytes | 3.4E4932 **to**  | (19 decimal      |
      |                  |          | 1.1E+4932        | places)          |
      +------------------+----------+------------------+------------------+
      |                  |          |                  |                  |
      +------------------+----------+------------------+------------------+

Encoding principles
~~~~~~~~~~~~~~~~~~~

| Numbers are code in binary on a certain number of bits. In case of
  *positive numbers* only (unsigned), with :math:`n` bits, one can code
  :math:`2^{n-1}` numbers and :math:`0`.

| *Negative number are via 2’complement*: switch all the digits and add
  1. With :math:`n` bits, up to :math:`2^{n-1}-1` positive digits and
  :math:`2^{n-1}` negative digits and :math:`0`. To retrieve the value,
  on :math:`n` bits encoding: take the value of the :math:`n-1` first
  right bits, and subtract :math:`2^{n-1}`.

Signedness bug overflow
~~~~~~~~~~~~~~~~~~~~~~~

Signedness bugs occur when an unsigned (signed) variable is interpreted
as signed (unsigned).

-  (on 8 bits) :math:`127 + 2 = 01111111+00000010 = 10000001 = -127`
   (signed) :math:`= 129` (unsigned)

This can happened when :

#. Signed integers are used in arithmetic operations

#. Signed integers are compare to unsigned ones. When a signed digit is
   compared with an unsigned one, they’re both considered unsigned.
   Check compiler’s specification for more!

.. literalinclude:: int_overflow.c
   :language: c


Truncation bug
~~~~~~~~~~~~~~

Truncation bugs occur when the value assigned to a variable exceeds its
capacities.

-  | On 2 bits, :math:`3 + 2 = 11 + 10 = 101`
   | But :math:`101` is 3 bits, by truncation one removes the top left
     one, hence we get 01

This can happened :

- mostly in arithmetic operations

| A famous example is the truncation error responsible for the crash of
  Ariane 5. The software had been considered bug free since it had been
  used in many previous flights. However: those used smaller rockets
  which generated lower acceleration than Ariane 5. On Ariane 4:
  velocity coded with 8 bits, but it is 16 bits on Ariane 5

:math:`=` This is a software engineering problem, a safety issue but also illustrate a security one link to software reuse/update.

Famous Truncation bug overflow in video games
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In Donkey Kong , it is impossible to pass level 22:

- due to an integer overflow in its time/bonus that is saved as an unsigned 8 bits integer

- the game takes **the level number a user is on, multiplies it by 10 and adds 40**

- this value is coded on 8 bits, hence a maximum of :math:`2^8 1=255`

- on level 22: time/bonus number is 260, which gives time bonus of 4

- indeed, 260 (decimal) = 1 0 0 0 0 0 1 0 0, it requires 9 bits

- But only 8 are allowed, and the most significant digit is thus truncated

"Nuclear Gandhi" in Civilization:

- aggressivity level saved as a unsigned 8 bits integer

- Gandhi had 1 as initial value

- could get a bonus of 2 for democracy

- hence leading to 1

- represented with 11111111 ... and interpreted as :math:`2^8 1= 255`


Beyond classical integer overflow
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Different types of integers are encoded with different numbers of bits.
If one tries to assign a 8 bits variable integer to a 4 bits variable
integer, then a truncation occurs. That is, the four biggest bits are
not taken into account

:math:`=` this assignment is a type of integer overflow.

.. literalinclude:: int_overflow2.c
   :language: c

Prevention/Detection
~~~~~~~~~~~~~~~~~~~~

#. Use of preconditions

   .. math:: ((s1>0) \wedge 0) \wedge (s2 > 0)\wedge (s1 > (\text{INT\_MAX} - s2))) \vee ((s1<0)\wedge  0)\wedge (s2< 0)\wedge (s1 < (\text{INT\_MIN}- s2)))

#. Perform each individual arithmetic operation using the next larger
   primitive integer type and explicitly checking for overflow

   .. literalinclude:: explicit.c
      :language: c

#. Use dedicated classes in some programming languages (e.g BigInteger,
   Bigdecimal in java)

#. Use CPU flag postcondition test

   .. literalinclude:: flag.c
       :language: c

Exploits
~~~~~~~~

-  Mostly to crash the system, or to obtain very basic game privileges
   (e.g civilization)

-  But then can prepare to "bigger exploits" : Integer overflow can help
   Buffer Overflow (we have just seen that)

.. literalinclude:: openssh.c
   :language: c
