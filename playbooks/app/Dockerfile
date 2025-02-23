FROM php:8.2-apache

# Ativar módulos necessários do Apache
RUN a2enmod rewrite remoteip headers

# Criar diretórios necessários para NFS (caso não existam)
RUN mkdir -p /download /var/upload /var/www/eproc_tmp

# Definir permissões para o Apache
RUN chown -R www-data:www-data /var/www/html /download /var/upload /var/www/eproc_tmp

# Copiar configurações personalizadas
COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/php.ini /usr/local/etc/php/php.ini

# Copiar código-fonte da aplicação
COPY html/ /var/www/html/

CMD ["apachectl", "-D", "FOREGROUND"]
