#!/bin/bash

redisUrl='r1.pc.sh.optaim.com'
port='6381'
result='./queryResult'
echo "查询文件$filename 的所有的key"
queryResult='redisResult'
flag=''
for line in `cat $result`
do
    echo "get $line" | redis-cli -h $redisUrl -p $port  >> $flag
    if [ ! $flag ]; then
        flag=''
    else
        echo $line >> $queryResult
    fi
    flag=''
done