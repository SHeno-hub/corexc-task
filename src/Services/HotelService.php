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
        $allRooms = [];
        foreach ($this->providers as $provider) {
            $allRooms = array_merge($allRooms, $provider->fetchRooms());
        }

        
        usort($allRooms, fn($a, $b) => $a->total_price <=> $b->total_price);

        return $allRooms;
    }
}