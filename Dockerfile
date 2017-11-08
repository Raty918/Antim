FROM debian:jessie-slim

# RUN Section
    # Update packages
RUN apt-get update &&\
    apt-get upgrade -y &&\

    # Install Apache and PHP for WebUI  
    apt-get install -y apache2 php5 libapache2-mod-php5 php5-sqlite sqlite &&\
    # Antimalware requirements
    apt-get install -y python python-pip yara python-yara clamav ssdeep && pip install team-cymru-api && apt-get clean && rm -rf /var/lib/apt/lists/* 

#ENVIRONMENT Section
    # Apache server
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# EXPOSE Section
       # Apache server
EXPOSE 80 

# WORKDIR Section
WORKDIR /antim

# COPY Section
     # Services to start  
COPY entrypoint.sh /entrypoint.sh   

ENTRYPOINT ["/entrypoint.sh"]

