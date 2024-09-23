<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // Get booking details from the request
        $bookingId = $request->input('booking_id');
        $booking = Booking::findOrFail($bookingId);

        // Set up Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Create payment token
        $params = [
            'transaction_details' => [
                'order_id' => $bookingId,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'username' => $booking->user->username,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Redirect to Midtrans payment page
        return redirect()->away(Snap::generateSnapURL($snapToken));
    }

    public function callback(Request $request)
    {
        // Retrieve the request's body and decode it
        $json = json_decode($request->getContent(), true);

        if ($json) {
            $transactionStatus = $json['transaction_status'];
            $orderId = $json['order_id'];

            // Retrieve the booking based on the order ID
            $booking = Booking::findOrFail($orderId);

            // Update the booking status based on the transaction status
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $booking->status = BookingStatus::PAID;
            } elseif ($transactionStatus == 'pending') {
                $booking->status = BookingStatus::PENDING;
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $booking->status = BookingStatus::CANCELLED;
            }

            $booking->save();

            if ($booking->status == 'paid') {
                return redirect()->route('bookings.show', $booking->id)
                    ->with('success', 'Payment successful and booking confirmed!');
            } else if ($booking->status == 'pending') {
                return redirect()->route('bookings.show', $booking->id)
                    ->with('warning', 'Payment pending, please complete the payment.');
            } else {
                return redirect()->route('bookings.index')
                    ->with('error', 'Payment failed or cancelled.');
            }

            // return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 400);
    }
}

