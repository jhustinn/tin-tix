<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\DateShowtime;
use App\Models\Movie;
use App\Models\Date;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    /**
     * Create returns the booking page.
     *
     * @param Movie $movie
     * @param Date $date
     * @param Showtime $showtime
     * @return View|RedirectResponse
     */
    public function create(Movie $movie, Date $date, Showtime $showtime): View|RedirectResponse
{
    $user = auth()->user();

    // Check if the user is old enough to watch the movie
    if ($user->age < $movie->age_rating) {
        return back()->with('error', 'You are not old enough to watch this movie!');
    }

    $currentDate = today('Asia/Jakarta')->format('Y-m-d');
    $currentTime = now('Asia/Jakarta')->format('H:i:s');

    // Date formatting
    $formattedDate = $date->date->format('Y-m-d');
    $isToday = $formattedDate == $currentDate;
    $isPastDate = $formattedDate < $currentDate;
    $isPastShowtime = $showtime->start_time < $currentTime;

    // Check if the date and showtime are in the past of the current date and time
    if ($isPastDate || ($isToday && $isPastShowtime)) {
        return back()->with('error', 'Cannot book tickets for past dates and showtimes!');
    }

    $seats = Seat::all();

    // Calculate total price (if needed)
    $totalPrice = count($seats) * $movie->ticket_price;

    // Set up Midtrans configuration
    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Create payment token
    $params = [
        'transaction_details' => [
            'order_id' => uniqid(), // Generate a unique order ID
            'gross_amount' => $totalPrice, // Use the total price here if needed
        ],
        'customer_details' => [
            'email' => $user->email,
            'first_name' => $user->name,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    // Check if the request is AJAX or not
    if (request()->ajax()) {
        // If AJAX, return the Snap token
        return response()->json(['snap_token' => $snapToken]);
    } else {
        // If not AJAX, return the booking create view
        return view('bookings.create', compact('movie', 'date', 'showtime', 'seats'));
    }
}

    /**
     * Store the booking.
     *
     * @param Request $request
     * @return RedirectResponse
     */


     public function store(Request $request): RedirectResponse
     {
         $request->validate([
             'seats' => ['required', 'array', 'min:1', 'max:6', 'exists:seats,id'],
         ]);
     
         $user = User::find(auth()->id());
         $movie = Movie::find($request->movie);
         $date = Date::find($request->date);
         $showtime = Showtime::find($request->showtime);
         $seats = Seat::find($request->seats);
         $date_showtime = DateShowtime::where('date_id', $date->id)
             ->where('showtime_id', $showtime->id)
             ->first();
     
         $booking = new Booking();
         $booking->user_id = $user->id;
         $booking->movie_id = $movie->id;
         $booking->date_showtime_id = $date_showtime->id;
         $booking->total_price = count($seats) * $movie->ticket_price;
         $booking->status = BookingStatus::PENDING;
         $booking->save();
     
         foreach ($seats as $seat) {
             $booking->seats()->attach($seat->id, ['date_showtime_id' => $date_showtime->id]);
         }
     
         Config::$serverKey = env('MIDTRANS_SERVER_KEY');
         Config::$isProduction = false;
     
         $params = [
             'transaction_details' => [
                 'order_id' => $booking->id,
                 'gross_amount' => $booking->total_price,
             ],
             'customer_details' => [
                 'first_name' => $user->name,
                 'email' => $user->email,
             ],
         ];
     
         $snapToken = Snap::getSnapToken($params);
         $snapCheckoutUrl = 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken;
     
         return redirect()->away($snapCheckoutUrl);
     }
     

public function notificationHandler(Request $request)
{
    $payload = $request->getContent();
    $notification = json_decode($payload);

    $transaction = $notification->transaction_status;
    $orderId = $notification->order_id;

    $booking = Booking::find($orderId);

    if (!$booking) {
        return response()->json(['message' => 'Booking not found'], 404);
    }

    if ($transaction == 'capture' || $transaction == 'settlement') {
        $booking->status = BookingStatus::PAID;
    } elseif ($transaction == 'deny' || $transaction == 'cancel' || $transaction == 'expire') {
        $booking->status = BookingStatus::FAILED;
    } else {
        $booking->status = BookingStatus::PENDING;
    }

    $booking->save();

    return response()->json(['message' => 'Notification received successfully'], 200);
}



    /**
     * Index returns the booking history page.
     *
     * @return View
     */
    public function index(): View
    {
        $user = User::find(auth()->id());
        $bookings = Booking::where('user_id', $user->id)
            ->with('movie', 'dateShowtime.date', 'dateShowtime.showtime', 'seats')
            ->latest()
            ->paginate(5);

        $currentDate = today('Asia/Jakarta')->format('Y-m-d');
        $currentTime = now('Asia/Jakarta')->format('H:i:s');

        return view('bookings.index', compact('bookings', 'currentDate', 'currentTime'));
    }

    /**
     * Update the booking status.
     *
     * @param Booking $booking
     * @return RedirectResponse
     */
    public function update(Booking $booking): RedirectResponse
    {
        $booking->status = BookingStatus::CANCELLED;
        $booking->update();

        foreach ($booking->seats as $seat) {
            $booking->seats()->detach($seat->id);
        }

        $user = User::find(auth()->id());
        // $user->balance += $booking->total_price;
        $user->update();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking cancelled!');
    }

    public function callback(Request $request)
{
    // Handle callback from Midtrans
    $transaction = Snap::getTransactionStatus($request->input('transaction_id'));

    // Process the transaction status and update booking status accordingly

    return response()->json($transaction);
}

public function invoice(Booking $booking)
{
    // Ensure the booking belongs to the authenticated user
    if ($booking->user_id !== auth()->id()) {
        return redirect()->route('home')->with('error', 'Unauthorized access to the invoice.');
    }

    $booking->load('movie', 'dateShowtime.date', 'dateShowtime.showtime', 'seats');
    
    return view('bookings.invoice', compact('booking'));
}
}
