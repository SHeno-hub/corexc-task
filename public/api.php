<?php
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

use App\Services\HotelService;

$advertisersData = [
    ['name' => 'Advertiser 1', 'url' => 'https://coresolutions.app/php_task/api/api_v1.php'],
    ['name' => 'Advertiser 2', 'url' => 'https://coresolutions.app/php_task/api/api_v2.php'],
    ['name' => 'Advertiser 3', 'url' => 'https://coresolutions.app/php_task/api/api_v3.php'],
];
$service = new HotelService();
foreach ($advertisersData as $data) {
    $service->addProvider(new \App\Providers\GenericHotelProvider(
        $data['url'], 
        $data['name']
    ));
}
try {
    $rooms = $service->getAllRooms();
    echo json_encode($rooms);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]); 
}