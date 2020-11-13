#!/usr/bin/expect
set ip '10.11.90.2'
set passwd 'zyp123'
set port '40022'

spawn ssh -p $port zhangyupeng@ip
expect{
    "password"
    {
      send "zyp123"
    }
}
expect eof
