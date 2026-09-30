<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\ImmunizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

$user = User::first();
Auth::login($user);

echo "Testing ChildController@index..." . PHP_EOL;
$childCtrl = new ChildController();
$resIndex = $childCtrl->index(new Request());
echo "ChildController@index rendered successfully (" . strlen($resIndex->render()) . " bytes)" . PHP_EOL;

echo "Testing ChildController@create..." . PHP_EOL;
$resCreate = $childCtrl->create(new Request());
echo "ChildController@create rendered successfully (" . strlen($resCreate->render()) . " bytes)" . PHP_EOL;

echo "Testing ImmunizationController@index (Children Tab)..." . PHP_EOL;
$immCtrl = new ImmunizationController();
$resImmChild = $immCtrl->index(new Request(['tab' => 'children']));
echo "ImmunizationController@index (children) rendered successfully (" . strlen($resImmChild->render()) . " bytes)" . PHP_EOL;

echo "Testing ImmunizationController@index (Mothers Tab)..." . PHP_EOL;
$resImmMother = $immCtrl->index(new Request(['tab' => 'mothers']));
echo "ImmunizationController@index (mothers) rendered successfully (" . strlen($resImmMother->render()) . " bytes)" . PHP_EOL;

echo "ALL CONTROLLERS & VIEWS VALIDATED SUCCESSFULLY!" . PHP_EOL;
