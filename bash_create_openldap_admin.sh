#!/bin/bash

# Set the domain name and the admin password
DOMAIN="example.com"
ADMIN_PASSWORD="adminpassword"

# Add the domain to the OpenLDAP server
echo "Adding domain '$DOMAIN' to OpenLDAP server..."
ldapadd -x -D "cn=admin,dc=example,dc=com" -w "$ADMIN_PASSWORD" <<EOF
dn: dc=$DOMAIN
objectclass: dcObject
objectclass: organization
o: $DOMAIN
dc: $DOMAIN
EOF

# Add the admin user to the OpenLDAP server
echo "Adding admin user to OpenLDAP server..."
ldapadd -x -D "cn=admin,dc=$DOMAIN" -w "$ADMIN_PASSWORD" <<EOF
dn: cn=admin,dc=$DOMAIN
objectclass: organizationalRole
cn: admin
description: LDAP administrator
EOF

echo "Done."
