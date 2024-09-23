@extends('layouts.app')

@section('content')
<section id="filter" class="w-full p-6 max-w-7xl mx-auto lg:p-8">
<div class="space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Dates Dashboard
    </h1>


    <div class="mt-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Dates</h2>
            <a href="{{ route('admin.dates.add') }}" class="text-white  bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Dates</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dates as $date)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-2 px-4">{{ $date->date }}</td>
                            <td class="py-2 px-4">Edit | Delete</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
@endsection
