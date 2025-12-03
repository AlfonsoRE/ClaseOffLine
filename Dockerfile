# Usa una imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Habilita la extensión mysqli (necesaria para la conexión a MySQL/TiDB)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Configura Apache para que sirva desde el directorio html
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia todo el código de tu proyecto al directorio de servicio de Apache
COPY . /var/www/html/

# Exponer el puerto por defecto de Apache
EXPOSE 80

# Comando para iniciar Apache en primer plano (lo que Render necesita)
CMD ["apache2-foreground"]