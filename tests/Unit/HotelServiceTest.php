<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\HotelService;
use App\DTO\HotelRoom;

class HotelServiceTest extends TestCase
{
    public function test_sorting_logic_prioritizes_lowest_price()
    {
        $rooms = [
            new HotelRoom("Hotel A", "CODE1", 200, "Source 1"),
            new HotelRoom("Hotel B", "CODE2", 100, "Source 2"),
        ];

        // نفترض أن الخدمة لديها ميثود لترتيب الغرف
        $service = new HotelService([]);
        $sorted = $service->sortRoomsByPrice($rooms);

        $this->assertEquals(100, $sorted[0]->total_price);
    }
}