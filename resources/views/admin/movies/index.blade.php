@extends('layouts.app')

@section('content')
<section id="filter" class="w-full p-6 max-w-7xl mx-auto lg:p-8">
<div class="space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Movies Dashboard
    </h1>


    <div class="mt-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Movies</h2>
            <a href="{{ route('admin.movies.add') }}" class="text-white  bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Movies</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">Title</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-2 px-4">{{ $movie->title }}</td>
                            <td class="py-2 px-4"><a href="{{ route('admin.movies.edit', $movie) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
@endsection
