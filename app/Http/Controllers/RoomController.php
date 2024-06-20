<?php

namespace App\Models\Room;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

       // $rooms = \App\Models\Room::whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
       // Fetch available rooms
    $rooms = \App\Models\Room::whereNotIn('id', function($query) use ($checkin, $checkout) {
        $query->select('room_id')
              ->from('bookings')
              ->where(function($query) use ($checkin, $checkout) {
                  $query->whereBetween('start_date', [$checkin, $checkout])
                        ->orWhereBetween('end_date', [$checkin, $checkout])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$checkin])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$checkout]);
              });
    })->get();   
    
    

    // Fetch images for each room
    //$rooms->each(function($room) {
       // $room->images = \App\Models\RoomImage::where('room_id', $room->id)->get();
        //$room->images = DB::table('room_images')->where('room_id', $room->id)->get();
    //});

    // Fetch images for each room from the roomphotos table
    $rooms->each(function($room) {
        $room->images = DB::table('room_images')->where('room_id', $room->id)->get()->map(function($image) {
            $image->image_path = Storage::url($image->image_path);
            return $image;
        });
    });



        return response()->json($rooms);
    }
}
