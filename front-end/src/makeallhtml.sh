#!/bin/bash
bash makehtml.sh
cd theory &&  bash makehtml.sh
cd ..
cd exercice && bash makehtml.sh
cd ..
cd qcm && bash makehtml.sh

cd ..
bash move_html.sh
bash copy_config.sh