#!/bin/bash
chmod +x makehtml.sh && sudo ./makehtml.sh
cd theory && chmod +x makehtml.sh &&  sudo ./makehtml.sh
cd ..
cd exercice && chmod +x makehtml.sh && sudo ./makehtml.sh
cd ..
cd qcm && chmod +x makehtml.sh && sudo ./makehtml.sh

cd ..
bash move_html.sh
bash copy_config.sh