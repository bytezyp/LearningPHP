#! /usr/bin/env sh

function usage() {
    echo "$1 huananbgp|BjuCloud|shnew"
    exit
}
# $# 传递脚本参数个数   -ne 不等于1
if [ $# -ne 1 ];then
    usage "$0"
fi
#故障记录数据库
#checkServerId=1
#checkRequestServer="10.200.95.2:25001"
#checkRecorder="jiyalei@optaim.com"

#mail config
server="10.200.95.5"
to="jiyalei@optaim.com;wanggaoming@optaim.com;shixiudong@optaim.com"
cc="liumingzhao@optaim.com;lishitong@optaim.com"
subject="monitor real cost"
redisPort=6380

CPC=0
CPM=1
CPI=64
CPA=128
PDB=256
declare -A bTypeMap
bTypeMap=([0]="cpc" [1]="cpm" [64]="cpi" [128]="cpa" [256]="pdb")
fieldsMap=([0]="ckrevenue" [1]="imrevenue" [64]="cpirevenue" [128]="cparevenue" [256]="pdbrevenue")

declare -A redisCluster
if [ "X$1" == "Xhuananbgp" ];then
    #redisCluster=([0]="10.13.18.230" [1]="10.13.30.77" [2]="10.13.4.22" [3]="10.13.7.175")
    redisCluster=([0]="10.3.10.11" [1]="10.3.10.12" [2]="10.3.10.30" [3]="10.3.10.31")
    #server="10.13.14.109"
    server="10.3.10.11"
    #checkServerId=3
    #checkRequestServer="10.13.4.127:25001"
elif [ "X$1" == "XBjuCloud" ];then
    redisCluster=([0]="10.200.95.10" [1]="10.200.95.12" [2]="10.200.95.13" [3]="10.200.95.14")
    server="10.200.95.5"
elif [ "X$1" == "Xshnew" ];then
    redisCluster=([0]="r1.cost.sh.optaim.com" [1]="r2.cost.sh.optaim.com" [2]="r3.cost.sh.optaim.com" [3]="r4.cost.sh.optaim.com")
    server="10.0.0.3"
    #checkServerId=2
    #checkRequestServer="10.0.0.1:25001"
else
    usage "$0"
fi
#test cluster
#redisCluster=([0]="10.4.8.153" [1]="10.4.8.153")
redisClusterNum=${#redisCluster[@]}

#dataroot=/opt/optz/cpaicost
dataroot=/data/optz/cpaicost/data
destDir=./data
mailClentPath=/opt/zyz/ops/bin
logFilePrefix=/opt/zyz/log/cpaicostupdate.log
# test data dir
#dataroot=./cpaicost
criticalDurationMin=20
gConfigKey="smoothGconfig"
autoModeField="auto"
autoModeFlag="automode"
scriptIncCode="if redis.call('EXISTS', KEYS[1]) == 0 then \
                redis.call('HMSET', KEYS[1], ARGV[1], ARGV[2]); \
                redis.call('EXPIREAT', KEYS[1], ARGV[3]); \
            else redis.call('HINCRBY', KEYS[1], ARGV[1], ARGV[2]); \
            end; return 0"

scriptSetCode="if redis.call('EXISTS', KEYS[1]) == 0 then \
                redis.call('HMSET', KEYS[1], ARGV[1], ARGV[2]); \
                redis.call('EXPIREAT', KEYS[1], ARGV[3]); \
            else redis.call('HMSET', KEYS[1], ARGV[1], ARGV[2]); \
            end; return 0"

function crc32() {
    #gzip/gunzip命令有较验crc32的功能，一个文件压缩之后的第二个倒数4字节存放的是该文件的crc32
    echo -n "$1" | gzip -1 | tail -c 8 | head -c 4 | hexdump -e '1/4 "%u" "\n"'
}

function buildAdgKey() {
    echo "${1}"#6#"${2}"
}

function debug()
{
    echo "$(date +"%F %T") [DEBUG] $1"
}

function writeRedis() {
    adgId=$1
    cost=$2
    bidtypeInt=$3
    fileName=$4
    bidTypeStr=${bTypeMap[$bidtypeInt]}
    fieldName=${fieldsMap[$bidtypeInt]}
    adgkey=$(buildAdgKey "$bidTypeStr" "$adgId")
    crc32sum=$(crc32 "$adgkey")
    clusterInd=$((crc32sum%redisClusterNum))
    stamp=$(getTomorrowDaybreakStamp)
    # cost文件名中包含full是总和文件，直接set
    # $scriptCode后面的1表示有1个key其他是args
    echo "$fileName" | grep -q "full"
    if [ $? -eq 0 ]; then
        debug "import full ${redisCluster[$clusterInd]} $adgkey $fieldName $cost $stamp"
        redis-cli -h "${redisCluster[$clusterInd]}" -p $redisPort eval "$scriptSetCode" 1 "$adgkey" "$fieldName" "$cost" "$stamp"
    else
        redis-cli -h "${redisCluster[$clusterInd]}" -p $redisPort eval "$scriptIncCode" 1 "$adgkey" "$fieldName" "$cost" "$stamp"
    fi
    return $?
}

function requestRecord() {
    msg="
    {
        \"serverid\": $checkServerId,
        \"time\": \"$(date +%Y-%m-%dT%T%:z)\",
        \"status\": $1,
        \"recoder\": \"$checkRecorder\",
        \"info\": \"$2\"
    }
    "
    curl -X POST -H 'Content-Type: application/json' -d "${msg}" "http://"${checkRequestServer}"/malfuncLog" -v
}

function startAuto() {
    crc32sum=$(crc32 $gConfigKey)
    clusterInd=$((crc32sum%redisClusterNum))
    redis-cli -h "${redisCluster[$clusterInd]}" -p "$redisPort" HSET "$gConfigKey" "$autoModeField" 1
    if [ ! -f $autoModeFlag ];then
        touch $autoModeFlag
    fi
}

function recover() {
    crc32sum=$(crc32 $gConfigKey)
    clusterInd=$((crc32sum%redisClusterNum))
    redis-cli -h "${redisCluster[$clusterInd]}" -p "$redisPort" HSET $gConfigKey "$autoModeField" 0
    if [ -f $autoModeFlag ];then
        rm $autoModeFlag
    fi
}

function sendMail() {
    body=$1
    $mailClentPath/mailclient -server="$server" -to="$to" -cc="$cc" -subject="${subject} ${body}" -body="$body" -priority="1"
}

# 明日凌晨时间戳
function getTomorrowDaybreakStamp() {
    nextDaybreak=$(date -d 'tomorrow' +"%F")
    dayBreakStamp=$(date -d "$nextDaybreak" +%s)
    echo "$dayBreakStamp"
}



costfiles=$(find $dataroot -maxdepth 1 -type f | sort)
today=$(date +"%F")
dateDir=$destDir/$today
if [ ! -d "$dateDir" ];then
    mkdir "$dateDir"
fi

# 非当天数据不写入redis，文件名cost.2015-12-03_00-33-01.full
debug "task start"
# 删除一周前日志和三天前数据文件
find "$logFilePrefix".* -maxdepth 1 -ctime +5 -type f | xargs -r rm
find "$destDir" -maxdepth 1 -ctime +1 -type d | xargs -r rm -r
for costfile in $costfiles;do
    costFileName=$(basename "$costfile")
    costFileDate=${costFileName:5:10}
    debug "$costfile $costFileDate"
    if [ "X$costFileDate" == "X$today" ];then
        awk -F, '{if($3 == "'"$CPA"'" || $3 == "'"$CPI"'" || $3 == "'"$PDB"'" || $3 == "'"$CPC"'"){print $1, $2, $3} else if($3 == "'"$CPM"'"){print $1, $2*1000, $3}}' "$costfile" | while read -r adgId cost bidtype
        do
            writeRedis "$adgId" "$cost" "$bidtype" "$costfile"
            if [ $? -ne 0 ];then
                debug "$costfile $adgId $cost $bidtype update redis error"
            fi
        done
    fi
    mv "$costfile" "$dateDir"
done

# 凌晨防抖，只处理文件不检测
nowHourMin=$(date +"%H-%M")
if [[ $nowHourMin < "00-"${criticalDurationMin} ]];then
    debug "task end:no check"
    exit
fi

autoMode=1
fileCount=$(find "$dateDir" -type f -cmin -$criticalDurationMin -not -empty | wc -l)
if [ "$fileCount" -ne 0 ];then
    autoMode=0
fi

alreadyAutoMode=0
if [ -f $autoModeFlag ];then
    alreadyAutoMode=1
fi

mailmsg="$1-$(hostname):"
if [ $autoMode -ne 0 ];then
    mailmsg=${mailmsg}"start auto mode"
    debug "$mailmsg"
    startAuto
    if [ $alreadyAutoMode -eq 0 ];then
        sendMail "$mailmsg"
        #requestRecord "$autoMode" "$mailmsg"
    fi
else
    mailmsg=${mailmsg}"recover from auto mode"
    debug "$mailmsg"
    recover
    if [ $alreadyAutoMode -ne 0 ];then
        sendMail "$mailmsg"
        #requestRecord "$autoMode" "$mailmsg"
    fi
fi
debug "task end"