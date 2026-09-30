<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = \App\Models\User::find(2);
if ($user) {
    \App\Models\Mother::updateOrCreate(
        ['user_id' => $user->id],
        [
            'mother_name' => 'Kamala Silva',
            'phone_no' => '0712345678',
            'address' => 'Colombo',
            'midwife_id' => 1,
            'date_of_birth' => '1995-01-01'
        ]
    );
    echo "Linked mother to Kamala\n";
} else {
    echo "User 2 not found\n";
}
