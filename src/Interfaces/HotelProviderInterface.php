<?php
namespace App\Interfaces;

interface HotelProviderInterface {
    /** @return \App\DTO\HotelRoom[] */
    public function fetchRooms(): array;
}