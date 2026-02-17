<?php
namespace App\Providers;
use App\Interfaces\HotelProviderInterface;
use App\DTO\HotelRoom;

class GenericHotelProvider extends AbstractProvider implements HotelProviderInterface
{
    private string $apiUrl;
    private string $sourceName;
    public function __construct(string $apiUrl, string $sourceName)
    {
        $this->apiUrl = $apiUrl;
        $this->sourceName = $sourceName;
    }

    public function fetchRooms(): array
    {
        $hotels = $this->makeRequest($this->apiUrl);
        $roomsList = [];
        if (!is_array($hotels)) {
            return [];
        }
        foreach ($hotels as $hotel) {
            if (!isset($hotel['rooms']) || !is_array($hotel['rooms'])) {
                continue;
            }
            foreach ($hotel['rooms'] as $room) {
                $price = $room['total'] ?? $room['totalPrice'] ?? $room['net_price'] ?? 0;
                $roomsList[] = new HotelRoom(
                    name: $hotel['name'] ?? 'Unknown Hotel',
                    room_code: $room['code'] ?? 'N/A',
                    total_price: (float) $price,
                    source: $this->sourceName 
                );
            }
        }
        return $roomsList;
    }
}