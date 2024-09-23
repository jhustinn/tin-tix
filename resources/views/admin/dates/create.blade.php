@extends('layouts.app')

@section('content')
<section id="filter" class="w-full p-6 max-w-7xl mx-auto lg:p-8">
<div class="space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Add Dates
    </h1>


    <div class="mt-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-x-auto">
            <form action="{{ route('admin.dates.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="movie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Movie
                        </label>
                        <input type="text" name="movie" id="movie" aria-label="movie"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400"
                            value="HAHA" disabled readonly>
                            
                    </div>
                    <div class="w-full">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Date
                        </label>
                        <input type="text" name="date" id="date" aria-label="date"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400"
                            value="HAHA" disabled readonly>
                    </div>
                    <div class="w-full">
                        <label for="showtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Showtime
                        </label>
                        <input type="text" name="showtime" id="showtime" aria-label="showtime"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400"
                            value="HAHA" disabled readonly>
                    </div>
                </div>
               
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-500 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-600">
                    Book Now
                </button>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
