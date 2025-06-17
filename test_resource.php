<?php

use App\Models\Student;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Resources\Api\V1\StudentDetailResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\UserRoleResource;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

// Bootstrap Laravel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Get a student with ID 1
    $student = Student::findOrFail(1);
    echo "Student ID: " . $student->id . "\n";
    echo "Student account (User ID): " . $student->account . "\n";
    
    // Get the User model
    $user = User::find($student->account);
    if ($user) {
        echo "User found: ID = " . $user->id . ", Role ID = " . $user->role . "\n";
        
        // Get the UserRole model
        $userRole = UserRole::find($user->role);
        if ($userRole) {
            echo "UserRole found: ID = " . $userRole->id . ", Name = " . $userRole->role_name . "\n";
            
            // Test UserRoleResource directly
            echo "\nTesting UserRoleResource directly...\n";
            $userRoleResource = new UserRoleResource($userRole);
            $userRoleArray = $userRoleResource->toArray(request());
            echo "UserRoleResource: " . json_encode($userRoleArray) . "\n";
            
            // Test UserResource directly
            echo "\nTesting UserResource directly...\n";
            // Set the userRole relationship manually
            $user->setRelation('userRole', $userRole);
            $userResource = new UserResource($user);
            $userArray = $userResource->toArray(request());
            echo "UserResource: " . json_encode($userArray) . "\n";
            echo "UserResource role: " . json_encode($userArray['role']) . "\n";
        } else {
            echo "UserRole not found for role ID " . $user->role . "\n";
        }
    } else {
        echo "User not found for account ID " . $student->account . "\n";
    }
    
    // Create the StudentDetailResource
    echo "\nCreating StudentDetailResource...\n";
    $resource = new StudentDetailResource($student);
    
    // Convert to array
    $array = $resource->toArray(request());
    
    // Check if account is present
    echo "Account present in resource: " . (isset($array['account']) ? 'Yes' : 'No') . "\n";
    
    if (isset($array['account'])) {
        echo "Account in resource: " . json_encode($array['account']) . "\n";
        
        // Check if account has role
        echo "Account has role: " . (isset($array['account']['role']) ? 'Yes' : 'No') . "\n";
        
        if (isset($array['account']['role'])) {
            echo "Role in resource: " . json_encode($array['account']['role']) . "\n";
        }
    }
    
    echo "Resource created and processed successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n";
}