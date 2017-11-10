#!/bin/bash
echo "This is a idle script (infinite loop) to keep container running."                                          

#Capture stop signal
cleanup (){
 kill -s SIGTERM $!                                                         
 exit 0 
}
trap cleanup SIGINT SIGTERM

#Services

## Apache
service apache2 start

##Clamav
chown -R clamav:clamav /antim/clamav
echo "Updating Signatures Database ..."
freshclam
echo "Completed: Container is now runnable"

#Infinite Loop
while [ 1 ] 
do
 sleep 60 & wait $!
done
