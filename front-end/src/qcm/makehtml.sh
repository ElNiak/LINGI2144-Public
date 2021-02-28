#!/bin/bash
find . -type f -name "*.rst" -exec touch {} +
find . -type f -name "*.py" -exec touch {} +
touch _static/*.js
make html