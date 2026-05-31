<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Stadium;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Player make a reservation
    public function store(Request  $request, $id)
    {

        $dataToInsert = [
            'startGame' => $request->startGame,
            'endGame' => $request->endGame,
            'date' => $request->date,
            'stadium_id' => $id,
            'player_id' => Auth::id(),

        ];
        Booking::create($dataToInsert);
        return redirect()->route('Player.dashboard');
    }
    // Player can see its reservations
    public function index()
    {
        $player_id = Auth::id();
        $reservations =    Booking::where('player_id', $player_id)->get();

        return view('Player/reservations_index', ['datas' => $reservations]);
    }
    // owner can see reservations of its stadiums
    public function ownerBookingsIndex()
    {

        $reservationList = Booking::whereHas('stadium', function ($q) {
            $q->where('owner_id', Auth::id());
        })->get();



        return view('Owner/reservations_lits', ['datas' => $reservationList]);
    }
    // confirm reservation
    public function confirmBooking($id)
    {
        $reservationInfos = Booking::find($id);
        return view('Owner/confirm_booking', ['datas' => $reservationInfos]);
    }
    public function confirm(Request $request, $id)
    {
        $booking = Booking::find($id);

        $booking->update([
            'status' => 'confirmed'
        ]);
        return redirect()->route('reservation.lists.index');
    }
    // cancel reservation
    public function cancelBooking($id)
    {
        $reservationInfos = Booking::find($id);
        return view('Owner/cancel_booking', ['datas' => $reservationInfos]);
    }
    public function cancel(Request $request, $id)
    {
        $booking = Booking::find($id);

        $booking->update([
            'status' => 'cancelled'
        ]);
        return redirect()->route('reservation.lists.index');
    }

    // get only the available time
    // and dont repeat the reservation for the owner
    public function availableTimes(Request $request, Stadium $stadium)
    {
        $date = $request->date;

        // get openTime and coloseTime
        $openTime  = Carbon::parse($stadium->openTime);
        $closeTime = Carbon::parse($stadium->closeTime);


        $allTimes = [];
        $current = $openTime->copy();

        while ($current->lt($closeTime)) {
            $allTimes[] = $current->format('H:i:s');
            $current->addHour();
        }


        $bookings = Booking::where('stadium_id', $stadium->id)
            ->where('date', $date)
            ->where('status', 'confirmed')
            ->get();


        $unavailable = [];

        foreach ($bookings as $booking) {
            $startBooking = Carbon::parse($booking->startGame);
            $endBooking   = Carbon::parse($booking->endGame);

            $currentBooking = $startBooking->copy();
            while ($currentBooking->lt($endBooking)) {
                $unavailable[] = $currentBooking->format('H:i:s');
                $currentBooking->addHour();
            }
        }


        $availableTimes = array_values(array_diff($allTimes, $unavailable));

        return response()->json([
            'available_times' => $availableTimes
        ]);
    }
}
