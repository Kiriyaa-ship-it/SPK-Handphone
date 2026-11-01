<?php
// Test password verification
$hash = '$2y$10$/eOp/5dXqjVOgczIgQbpa.itr1hDj6pavdm.CCOvNag3zRu39OSkC';
$password = 'admin123';

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "Verify result: " . (password_verify($password, $hash) ? 'TRUE' : 'FALSE') . "\n";
