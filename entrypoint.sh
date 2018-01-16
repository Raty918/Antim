#!/bin/bash
echo "This is a idle script (infinite loop) to keep container running."                                          

#Capture stop signal
cleanup (){
 kill -s SIGTERM $!                                                         
 exit 0 
}
trap cleanup SIGINT SIGTERM

#Services

#Time synchronization
if [ "$SET_CONTAINER_TIMEZONE" == "true" ]; then
	cp /usr/share/zoneinfo/${CONTAINER_TIMEZONE} /etc/localtime && \
	echo "${CONTAINER_TIMEZONE}" >  /etc/timezone && \
	echo "Container timezone set to: $CONTAINER_TIMEZONE"
else
	echo "Container timezone not modified"
fi

## Apache
a2enmod ssl
a2enmod headers
service apache2 start

##Clamav
chown -R clamav:clamav /antim/clamav
echo "Updating Signatures Database ... ."
freshclam
echo "Completed: Container is now running."

#Infinite Loop
while [ 1 ] 
do
 sleep 60 & wait $!
done
