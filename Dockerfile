FROM ubuntu:16.04

# RUN Section
    # Update packages
RUN apt-get update &&\
    apt-get upgrade -y &&\

    # Install Apache and PHP for WebUI  
    apt-get install -y openssl apache2 php7.0 libapache2-mod-php7.0 php7.0-sqlite sqlite &&\
    # Antimalware requirements
    apt-get install -y python yara python-yara python-pefile clamav ssdeep && apt-get clean && rm -rf /var/lib/apt/lists/* 

#ENVIRONMENT Section
    # Apache server
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# EXPOSE Section
       # Apache server
EXPOSE 80 
EXPOSE 443
# WORKDIR Section
WORKDIR /antim

# COPY Section
     # Services to start  
COPY entrypoint.sh /entrypoint.sh   

ENTRYPOINT ["/entrypoint.sh"]

