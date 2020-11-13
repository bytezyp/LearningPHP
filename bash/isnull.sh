#!/bin/bash

result='./redisResult'
for line in `cat $result`
do
    if [ ! $line ]; then
        flag=''
    else
        echo $line >> notnull
    fi

done
