<?php

$data = ['gender' => 'M'];
echo "Test 1: Using == operator\n";
echo "\$data['gender'] == 'M': " . ($data['gender'] == 'M' ? 'true' : 'false') . "\n";
echo "Value of \$data['gender']: '" . $data['gender'] . "'\n";
echo "Type of \$data['gender']: " . gettype($data['gender']) . "\n";
echo "ASCII value of first character: " . ord($data['gender'][0]) . "\n\n";

$data2 = ['gender' => ' M'];
echo "Test 2: With leading space\n";
echo "\$data2['gender'] == 'M': " . ($data2['gender'] == 'M' ? 'true' : 'false') . "\n";
echo "Value of \$data2['gender']: '" . $data2['gender'] . "'\n";
echo "Type of \$data2['gender']: " . gettype($data2['gender']) . "\n";
echo "ASCII value of first character: " . ord($data2['gender'][0]) . "\n\n";

// Test with the exact value from the JSON
echo "Test 3: Using the exact value from JSON\n";
$data3 = ['gender' => "M"];
echo "\$data3['gender'] == 'M': " . ($data3['gender'] == 'M' ? 'true' : 'false') . "\n";
echo "Value of \$data3['gender']: '" . $data3['gender'] . "'\n";
echo "Type of \$data3['gender']: " . gettype($data3['gender']) . "\n";
echo "ASCII value of first character: " . ord($data3['gender'][0]) . "\n\n";

// Test with strict comparison
echo "Test 4: Using === operator\n";
echo "\$data['gender'] === 'M': " . ($data['gender'] === 'M' ? 'true' : 'false') . "\n";
echo "\$data2['gender'] === 'M': " . ($data2['gender'] === 'M' ? 'true' : 'false') . "\n";
echo "\$data3['gender'] === 'M': " . ($data3['gender'] === 'M' ? 'true' : 'false') . "\n\n";

// Test with trim
echo "Test 5: Using trim()\n";
echo "trim(\$data['gender']) == 'M': " . (trim($data['gender']) == 'M' ? 'true' : 'false') . "\n";
echo "trim(\$data2['gender']) == 'M': " . (trim($data2['gender']) == 'M' ? 'true' : 'false') . "\n";
echo "trim(\$data3['gender']) == 'M': " . (trim($data3['gender']) == 'M' ? 'true' : 'false') . "\n\n";

// Dump all characters as hex
echo "Test 6: Hex dump of each character\n";
echo "Hex dump of \$data['gender']: ";
for ($i = 0; $i < strlen($data['gender']); $i++) {
    echo bin2hex($data['gender'][$i]) . " ";
}
echo "\n";

echo "Hex dump of \$data2['gender']: ";
for ($i = 0; $i < strlen($data2['gender']); $i++) {
    echo bin2hex($data2['gender'][$i]) . " ";
}
echo "\n";

echo "Hex dump of \$data3['gender']: ";
for ($i = 0; $i < strlen($data3['gender']); $i++) {
    echo bin2hex($data3['gender'][$i]) . " ";
}
echo "\n";