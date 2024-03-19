FROM rockylinux:8

RUN /usr/bin/crb enable
RUN dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm

RUN dnf -y install php56-php-fpm php56-php-gd php56-php-mbstring php56-php-mssql php56-php-xcache php56-php-pdo

RUN yum -y update && yum clean all
RUN yum -y install php-fpm php-mbstring php-mysql php-gd && yum clean all
RUN sed -e 's/127.0.0.1:9000/9000/' \
        -e '/allowed_clients/d' \
        -e '/catch_workers_output/s/^;//' \
        -e '/error_log/d' \
        -i /etc/php-fpm.d/www.conf
RUN mkdir -p /var/www/html
EXPOSE 9000
ENTRYPOINT /usr/sbin/php-fpm --nodaemonize
