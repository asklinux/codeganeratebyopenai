<?php

$ldap_host = "ldap://localhost";
$ldap_port = 389;

// Connect to the LDAP server
$ldap_conn = ldap_connect($ldap_host, $ldap_port);

if ($ldap_conn) {
    // Bind to the LDAP server as the administrator
    $ldap_bind = ldap_bind($ldap_conn, "cn=admin,dc=example,dc=com", "password");

    if ($ldap_bind) {
        // Add the domain entry to the LDAP directory
        $domain_dn = "dc=example,dc=com";
        $domain_entry = array(
            "objectClass" => "domain",
            "dc" => "example",
        );
        $result = ldap_add($ldap_conn, $domain_dn, $domain_entry);

        if ($result) {
            echo "Successfully added domain entry\n";
        } else {
            echo "Failed to add domain entry: " . ldap_error($ldap_conn) . "\n";
        }

        // Add the admin entry to the LDAP directory
        $admin_dn = "cn=admin,dc=example,dc=com";
        $admin_entry = array(
            "objectClass" => "simpleSecurityObject",
            "cn" => "admin",
            "userPassword" => "password",
        );
        $result = ldap_add($ldap_conn, $admin_dn, $admin_entry);

        if ($result) {
            echo "Successfully added admin entry\n";
        } else {
            echo "Failed to add admin entry: " . ldap_error($ldap_conn) . "\n";
        }
    } else {
        echo "Failed to bind to LDAP server: " . ldap_error($ldap_conn) . "\n";
    }

    // Close the LDAP connection
    ldap_close($ldap_conn);
} else {
    echo "Failed to connect to LDAP server\n";
}

