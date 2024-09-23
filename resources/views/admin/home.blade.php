@extends('layouts.app')

@section('content')
<section id="filter" class="w-full p-6 max-w-7xl mx-auto lg:p-8">
<div class="space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Admin Dashboard
    </h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg font-medium text-gray-900 dark:text-white">Total User</h5>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg font-medium text-gray-900 dark:text-white">Total Movies</h5>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $totalMovies }}</p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg font-medium text-gray-900 dark:text-white">Total Ticket Sales</h5>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTicketSales }}</p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg font-medium text-gray-900 dark:text-white">Total Ticket Revenue</h5>
            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">Rp. {{  number_format($totalRevenue, 2, ",", ".") }}</p>
        </div>
    </div>

    <div class="mt-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Recent Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">User</th>
                        <th class="py-2 px-4 text-left">Movie</th>
                        {{-- <th class="py-2 px-4 text-left">Quantity</th> --}}
                        <th class="py-2 px-4 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentBookings as $booking)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-2 px-4">{{ $booking->user->username }}</td>
                            <td class="py-2 px-4">{{ $booking->movie->title }}</td>
                            {{-- <td class="py-2 px-4">{{ $booking->quantity }}</td> --}}
                            <td class="py-2 px-4">{{ $booking->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
@endsection
