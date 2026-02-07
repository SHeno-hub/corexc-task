<?php
namespace App\DTO;

class HotelRoom {
    public function __construct(
        public string $name,
        public string $room_code,
        public float $total_price,
        public string $source
    ) {}
}