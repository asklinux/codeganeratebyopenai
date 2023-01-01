#!/bin/bash

# Check if the script was run with the required number of arguments
if [ "$#" -ne 2 ]; then
    echo "Usage: configure-vhost SERVER_NAME DOCUMENT_ROOT"
    exit 1
fi

server_name=$1
document_root=$2

# Create the configuration file for the vhost
config_file="/etc/apache2/sites-available/$server_name.conf"
cat > $config_file <<EOF
<VirtualHost *:80>
    ServerName $server_name
    DocumentRoot $document_root
    <Directory $document_root>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF

# Enable the vhost
a2ensite $server_name.conf

# Reload Apache to apply the changes
systemctl reload apache2
