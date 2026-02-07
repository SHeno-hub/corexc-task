<?php

namespace App\Services;

class HotelService
{
    private array $providers = [];

    public function addProvider(\App\Interfaces\HotelProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function getAllRooms(): array
    {
        $uniqueRooms = [];
        foreach ($this->providers as $provider) {
            foreach ($provider->fetchRooms() as $room) {
                
                $identifier = $room->name . '-' . $room->room_code;

                
                if (!isset($uniqueRooms[$identifier]) || $room->total_price < $uniqueRooms[$identifier]->total_price) {
                    $uniqueRooms[$identifier] = $room;
                }
            }
        }

        $allRooms = array_values($uniqueRooms);
        
        
        usort($allRooms, fn($a, $b) => $a->total_price <=> $b->total_price);

        return $allRooms;
    }
}