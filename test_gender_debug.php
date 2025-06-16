<?php

// Simulate the exact data from the JSON provided by the user
$data = [
    'enrollment_no' => 'REG20250616740812',
    'enrollment_date' => 'Jun 16, 2025',
    'enrollment_status' => 'Pending',
    'verification_status' => 'Pending',
    'learning_mode' => 'Face to Face',
    'tuition_status' => 'Voucher Holder',
    'strand' => 'Technical-Vocational-Livelihood Information and Communications Technology',
    'year_level' => 11,
    'school_year' => '2025-2026',
    'semester' => '1st Semester',
    'campus' => 'Golden Minds Colleges of Pandi Bulacan Inc.',
    'campus_address' => 'Bernando St. Gulod, Poblacion, Pandi, Bulacan',
    'student_no' => '2025877890',
    'lrn' => '136528100399',
    'full_name' => 'DOE, John T.',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'middle_name' => 'Test',
    'extension_name' => null,
    'email' => 'jeromesavc@gmail.com',
    'gender' => 'M',
    'birthdate' => 'Mar 24, 2004',
    'age' => 21,
    'appointment_schedule' => 'June 18, 2025 (Wednesday) - 8:30 AM to 3:30 PM'
];

echo "\nTesting with the exact JSON data provided by the user:\n";
echo "Value of \$data['gender']: '" . $data['gender'] . "'\n";
echo "Type of \$data['gender']: " . gettype($data['gender']) . "\n";
echo "Length of \$data['gender']: " . strlen($data['gender']) . "\n";

// Test different comparison methods
echo "\nComparison Tests:\n";
echo "1. == comparison: \$data['gender'] == 'M': " . ($data['gender'] == 'M' ? 'true' : 'false') . "\n";
echo "2. === comparison: \$data['gender'] === 'M': " . ($data['gender'] === 'M' ? 'true' : 'false') . "\n";
echo "3. With trim(): trim(\$data['gender']) == 'M': " . (trim($data['gender']) == 'M' ? 'true' : 'false') . "\n";
echo "4. With trim() and ===: trim(\$data['gender']) === 'M': " . (trim($data['gender']) === 'M' ? 'true' : 'false') . "\n";

// Detailed character analysis
echo "\nDetailed Character Analysis:\n";
echo "ASCII values of each character in \$data['gender']: ";
for ($i = 0; $i < strlen($data['gender']); $i++) {
    echo "[" . $i . "]" . ord($data['gender'][$i]) . " ";
}
echo "\n";

echo "Hex representation of each character in \$data['gender']: ";
for ($i = 0; $i < strlen($data['gender']); $i++) {
    echo "[" . $i . "]" . bin2hex($data['gender'][$i]) . " ";
}
echo "\n";

// Test with a manually created string
echo "\nComparison with manually created string:\n";
$manualM = 'M';
echo "Value of \$manualM: '" . $manualM . "'\n";
echo "Type of \$manualM: " . gettype($manualM) . "\n";
echo "Length of \$manualM: " . strlen($manualM) . "\n";
echo "ASCII value of \$manualM: " . ord($manualM) . "\n";
echo "Hex representation of \$manualM: " . bin2hex($manualM) . "\n";

echo "\$data['gender'] == \$manualM: " . ($data['gender'] == $manualM ? 'true' : 'false') . "\n";
echo "\$data['gender'] === \$manualM: " . ($data['gender'] === $manualM ? 'true' : 'false') . "\n";

// Test with different variations of 'M'
echo "\nTesting with different variations of 'M':\n";
$variations = [
    'M',       // Standard M
    ' M',      // M with leading space
    'M ',      // M with trailing space
    ' M ',     // M with both leading and trailing spaces
    "\tM",    // M with leading tab
    "M\t",    // M with trailing tab
    "\nM",    // M with leading newline
    "M\n",    // M with trailing newline
    "\rM",    // M with leading carriage return
    "M\r",    // M with trailing carriage return
    "\0M",    // M with leading null byte
    "M\0",    // M with trailing null byte
];

foreach ($variations as $index => $var) {
    echo "Variation $index: '" . addcslashes($var, "\0..\37") . "'\n";
    echo "  Length: " . strlen($var) . "\n";
    echo "  Hex: ";
    for ($i = 0; $i < strlen($var); $i++) {
        echo bin2hex($var[$i]) . " ";
    }
    echo "\n";
    echo "  \$data['gender'] == Variation $index: " . ($data['gender'] == $var ? 'true' : 'false') . "\n";
    echo "  \$data['gender'] === Variation $index: " . ($data['gender'] === $var ? 'true' : 'false') . "\n";
    echo "  trim(\$data['gender']) === trim(Variation $index): " . (trim($data['gender']) === trim($var) ? 'true' : 'false') . "\n";
}

// Test the actual condition from the blade template
echo "\nSimulating the blade template condition:\n";
echo "Original condition (\$data['gender'] == 'M'): " . ($data['gender'] == 'M' ? 'Mr.' : 'Ms.') . "\n";
echo "Updated condition (trim(\$data['gender']) === 'M'): " . (trim($data['gender']) === 'M' ? 'Mr.' : 'Ms.') . "\n";