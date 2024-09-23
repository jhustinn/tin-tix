@extends('layouts.app')

@section('content')
<section id="filter" class="w-full p-6 max-w-7xl mx-auto lg:p-8">
<div class="space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Add Movie
    </h1>
    

    <div class="mt-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-x-auto">
            <form action="{{ route('admin.movies.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="movie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Title
                        </label>
                        <input type="text" name="title" id="title" aria-label="title"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('title')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                    <div class="w-full">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Realease Date
                        </label>
                        <input type="date" name="release_date" id="release_date" aria-label="release_date"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('realese_date')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                    <div class="w-full">
                        <label for="showtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Poster URL
                        </label>
                        <input type="text" name="poster_url" id="poster_url" aria-label="poster_url"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('poster_url')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                    <div class="w-full">
                        <label for="showtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Age Rating
                        </label>
                        <input type="text" name="age_rating" id="age_rating" aria-label="age_rating"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('age_rating')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="showtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ticket Price
                        </label>
                        <input type="number" name="ticket_price" id="ticket_price" aria-label="ticket_price"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Rp.">
                            @error('ticket_price')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="showtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Description
                        </label>
                        <textarea type="text" name="description" id="description" aria-label="description"
                            class="text-gray-900 text-sm rounded-lg block w-full p-2.5"></textarea>
                            @error('description')
                    <x-error-message :message="$message" />
                @enderror
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-500 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-600">
                    Add Movie
                </button>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
