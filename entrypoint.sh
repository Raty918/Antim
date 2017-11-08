#!/bin/bash
echo "This is a idle script (infinite loop) to keep container running."    
echo "Please replace this script."                                         

#Capture stop signal
cleanup (){
 kill -s SIGTERM $!                                                         
 exit 0 
}
trap cleanup SIGINT SIGTERM

#Services
service apache2 start
chown -R clamav:clamav /antim/clamav
freshclam

#Infinite Loop
while [ 1 ] 
do
 sleep 60 & wait $!
done
