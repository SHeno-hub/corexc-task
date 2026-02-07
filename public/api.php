<?php
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

use App\Services\HotelService;
use App\Providers\AdvertiserOneProvider;
use App\Providers\AdvertiserTwoProvider;
use App\Providers\AdvertiserThreeProvider;

$service = new HotelService();
$service->addProvider(new AdvertiserOneProvider());
$service->addProvider(new AdvertiserTwoProvider());
$service->addProvider(new AdvertiserThreeProvider());

try {
    echo json_encode($service->getAllRooms());
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Something went wrong']);
}