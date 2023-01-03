#!/bin/bash

# Allow SELinux to open port 8000
echo "Allowing SELinux to open port 8000..."
semanage port -a -t http_port_t -p tcp 8000

# Allow user to use sudo to write to files
echo "Allowing user to use sudo to write to files..."
USERNAME="user"
echo "$USERNAME ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USERNAME

echo "Done."
