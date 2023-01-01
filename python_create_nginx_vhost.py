import subprocess

def create_vhost(server_name, root_directory):
    # Create the configuration file for the vhost
    config_file = f"""
server {{
    listen 80;
    server_name {server_name};
    root {root_directory};
    index index.html;
}}
    """

    # Write the configuration file to /etc/nginx/sites-available
    with open(f"/etc/nginx/sites-available/{server_name}", "w") as f:
        f.write(config_file)

    # Create a symbolic link from the configuration file to the sites-enabled directory
    subprocess.run(["ln", "-s", f"/etc/nginx/sites-available/{server_name}", "/etc/nginx/sites-enabled/"])

    # Reload nginx to apply the changes
    subprocess.run(["nginx", "-s", "reload"])

# Example usage:
create_vhost("example.com", "/var/www/example.com")
