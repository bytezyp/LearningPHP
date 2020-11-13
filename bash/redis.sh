#!/bin/bash

filename='redis'`date +%Y-%m-%d`
redisUrl='r1.cm.sh.optaim.com'
port='6379'
result='./result'
key='google#CAESEO*'
queryresult="./queryResult"
echo '实例化redis数据文件为：/tmp/'$filename
echo "keys $key" | redis-cli -h $redisUrl -p $port  > $result
echo "将所有的key保存到/$filename.txt文件中"
for line in `cat $result`
do
    echo "get $line" | redis-cli -h $redisUrl -p $port  >> $queryresult
done
