echo "Moving Exercices"
rm -r _build/html/exercice/
rm -r _build/doctrees/exercice/
mkdir _build/doctrees/exercice _build/html/exercice
cp -r exercice/_build/html/.  _build/html/exercice
cp -r exercice/_build/doctrees/. _build/doctrees/exercice
echo "Moving QCM"
rm -r _build/html/qcm/
rm -r _build/doctrees/qcm/
mkdir _build/doctrees/qcm _build/html/qcm
cp -r qcm/_build/html/.  _build/html/qcm
cp -r qcm/_build/doctrees/. _build/doctrees/qcm
echo "Moving Theory"
rm -r _build/html/theory/
rm -r _build/doctrees/theory/
mkdir _build/doctrees/theory _build/html/theory
cp -r theory/_build/html/.  _build/html/theory
cp -r theory/_build/doctrees/. _build/doctrees/theory
echo "Moving Manager"
rm -r _build/html/manager/
rm -r _build/doctrees/manager/
mkdir _build/doctrees/manager _build/html/manager
cp -r manager/_build/html/.  _build/html/manager
cp -r manager/_build/doctrees/. _build/doctrees/manager