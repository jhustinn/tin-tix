<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Tin Tix Invoice</h2>
                            </td>
                            <td>
                                Invoice #: {{ $booking->id }}<br>
                                Created: {{ $booking->created_at->format('d/m/Y') }}<br>
                                Status: {{ $booking->status }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $booking->user->username }}<br>
                                {{-- {{ $booking->user->email }} --}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Movie
                </td>
                <td>
                    Details
                </td>
            </tr>
            <tr class="item">
                <td>
                    Title
                </td>
                <td>
                    {{ $booking->movie->title }}
                </td>
            </tr>
            <tr class="item">
                <td>
                    Date
                </td>
                <td>
                    {{ $booking->dateShowtime->date->date }}
                </td>
            </tr>
            <tr class="item">
                <td>
                    Showtime
                </td>
                <td>
                    {{ $booking->dateShowtime->showtime->start_time }}
                </td>
            </tr>
            <tr class="item">
                <td>
                    Seats
                </td>
                <td>
                    @foreach ($booking->seats as $seat)
                        {{ $seat->seat_number }}@if (!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                   Total: Rp. {{  number_format($booking->total_price, 2, ",", ".") }}
                </td>
            </tr>
        </table>
        <a href="{{ url('/bookings') }}">Back</a>
    </div>
</body>
</html>
