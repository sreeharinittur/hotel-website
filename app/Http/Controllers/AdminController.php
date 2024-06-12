<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if($usertype=="user")
            {
                return view ('home.index');
            }

            else if($usertype=="admin")
            {
                return view ('admin.index');
            }
            
            else
            {
                return redirect()->back();
            }
        }

    }

    public function home()
    {
        return view('home.index');
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function view_rooms()
    {
        $data=Room::all();
        return view('admin.view_rooms',compact('data'));
    }

    public function add_room(Request $request)
    {
        try {
            // Validate form data
            $validatedData = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'wifi' => 'required|in:yes,no',
                'type' => 'required|string|in:regular,premium,delux',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048' // Validate uploaded images
            ]);
    
            // Convert 'yes' or 'no' to boolean
            $wifi = $validatedData['wifi'] === 'yes' ? 1 : 0;
    
            // Create the room
            $room = Room::create([
                'room_title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'wifi' => $wifi, // Store as boolean
                'room_type' => $validatedData['type'],
            ]);
    
            // Handle room images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $image = new RoomImage();
                    $image->room_id = $data->id;
                    // Store the image in the public storage directory
                    $path = $file->store('room_images', 'public');
                    $image->image_path = $path;
                    $image->save();
                }
            }
    
            return redirect()->route('admin.create_room')->with('success', 'Room created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
 
            }
        }

        public function show_rooms()
{
    $rooms = Room::with('images')->get();
    return view('admin.show_rooms', compact('rooms'));
}

        public function bookings()
         {
            $data=Booking::all();
            return view('admin.booking',compact('data'));
        }

        public function mybookings()
        {
            $userEmail = auth()->user()->email;
    $userBookings = Booking::where('email', $userEmail)->get(); // Retrieve bookings based on user's email
    return view('mybookings', compact('userBookings'));
        }


        public function delete_bookings($id)
        {
            $data=Booking::find($id);

            $data->delete();

            return redirect()->back();

        }

        public function approve_book($id)
        {
            $booking=Booking::find($id);

            $booking->status="approved";

            $booking->save();

            return redirect()->back();
        }

        public function reject_book($id)
        {
            $booking=Booking::find($id);

            $booking->status="rejected";

            $booking->save();

            return redirect()->back();
        }


        

        
    }

    


