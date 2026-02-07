<?php

namespace App\Providers;

use App\Interfaces\HotelProviderInterface;
use App\DTO\HotelRoom;

class AdvertiserThreeProvider extends AbstractProvider implements HotelProviderInterface
{
    private const API_URL = 'https://coresolutions.app/php_task/api/api_v3.php';

    public function fetchRooms(): array
    {
        $hotels = $this->makeRequest(self::API_URL);
        $roomsList = [];

        foreach ($hotels as $hotel) {
            foreach ($hotel['rooms'] as $room) {
                
                $price = $room['total'] ?? $room['totalPrice'] ?? 0;
                
                $roomsList[] = new HotelRoom(
                    name: $hotel['name'],
                    room_code: $room['code'],
                    total_price: (float) $price,
                    source: 'Advertiser 3'
                );
            }
        }

        return $roomsList;
    }
}