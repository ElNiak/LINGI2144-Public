echo "Moving exercice config"
cp  _static/config.json  _build/html/_static
chmod 777 _build/html/_static/config.json

echo "Moving manager config"
cp  manager/_static/user.json  _build/html/manager/_static
chmod 777 _build/html/manager/_static/user.json