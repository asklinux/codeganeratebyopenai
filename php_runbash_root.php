<?php

// Check if the script is being run as root
if (posix_getuid() != 0) {
    // If not, run the script as root using sudo
    system("sudo " . __FILE__ . " " . implode(" ", array_slice($argv, 1)));
    exit;
}

// The rest of the script will run as root

