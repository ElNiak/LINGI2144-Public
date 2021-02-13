axel@axel-VirtualBox:~$ python
Python 2.7.15+ (default, Oct  2 2018, 22:12:08) 
[GCC 8.2.0] on linux2
Type "help", "copyright", "credits" or "license" for more information.
>>> def foo():
...     return foo()
... 
>>> 
>>> foo()
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
….

  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
  File "<stdin>", line 2, in foo
RuntimeError: maximum recursion depth exceeded
>>> 
s
