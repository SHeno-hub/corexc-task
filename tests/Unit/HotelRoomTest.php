<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\DTO\HotelRoom;

class HotelRoomTest extends TestCase
{
    public function test_hotel_room_dto_stores_data_correctly()
    {
        $room = new HotelRoom("Steigenberger", "DBL-RM", 150.5, "Advertiser 1");

        $this->assertEquals("Steigenberger", $room->name);
        $this->assertEquals("DBL-RM", $room->room_code);
        $this->assertEquals(150.5, $room->total_price);
        $this->assertEquals("Advertiser 1", $room->source);
    }
}