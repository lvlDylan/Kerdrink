<?php
$bytes = random_bytes(8);
$salt = bin2hex($bytes);
$password = "4321";
echo $salt . "\n\n\n" . hash("sha256", $password . $salt);
