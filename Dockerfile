FROM wordpress:php8.3-apache

# Pinova (Illuminate Database) requires the PDO MySQL driver.
# The stock image enables mysqli, but not always pdo_mysql.
RUN docker-php-ext-install pdo_mysql \
	&& docker-php-ext-enable pdo_mysql

# Encoded plugins from the imported site require the ionCube Loader.
# It must load before other Zend extensions, so the ini file is prefixed with 00-.
RUN set -eux; \
	arch="$(uname -m)"; \
	case "$arch" in \
		x86_64) ion_arch="x86-64" ;; \
		aarch64) ion_arch="aarch64" ;; \
		*) echo "Unsupported architecture: $arch" >&2; exit 1 ;; \
	esac; \
	curl -fsSL "https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_${ion_arch}.tar.gz" -o /tmp/ioncube.tar.gz; \
	tar -xzf /tmp/ioncube.tar.gz -C /tmp; \
	ext_dir="$(php -r 'echo ini_get("extension_dir");')"; \
	cp "/tmp/ioncube/ioncube_loader_lin_8.3.so" "${ext_dir}/"; \
	echo "zend_extension=ioncube_loader_lin_8.3.so" > /usr/local/etc/php/conf.d/00-ioncube.ini; \
	rm -rf /tmp/ioncube /tmp/ioncube.tar.gz
