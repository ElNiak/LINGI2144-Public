#!/bin/bash
find . -type f -name "*.rst" -exec touch {} +
make html