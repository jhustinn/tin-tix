<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Index returns the home page.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $title = request()->input('search');
        $sort = request()->input('sort');

        $movies = Movie::filter($title, $sort)
            ->latest()
            ->paginate(8);

        return view('movies.home', compact('movies'));
    }


    /**
     * Show returns the movie detail page.
     *
     * @param Movie $movie
     * @return View
     */
    public function show(Movie $movie): View
    {
        $currentDate = today('Asia/Jakarta')->format('Y-m-d');
        $currentTime = now('Asia/Jakarta')->format('H:i:s');

        $movie = $movie->loadDatesForCurrentWeek();

        return view('movies.show', compact('movie', 'currentDate', 'currentTime'));
    }

    public function movies(): View {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }
    public function create(): View {
        // $movies = Movie::all();
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'age_rating' => 'required|string|max:10',
            'ticket_price' => 'required|numeric',
            'poster_url' => 'required|url',
            // 'release_date' => 'required|date',
        ]);
        // Create the movie

            // Log the request data for debugging
            Log::info('Creating movie with data: ', $request->all());

            // Create the movie
            $movie = Movie::create($request->all());

                // var_dump($movie);
                // die;
            // Log the created movie
            // Log::info('Movie created successfully: ', $movie->toArray());

            // Redirect with success message
            return redirect()->route('admin.movies')->with('success', 'Movie created successfully.');

            // Redirect back with error message
    }


    public function edit(Movie $movie)
    {
        // var_dump(compact('movie'));
        // die;
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'age_rating' => 'required',
            'ticket_price' => 'required',
            'poster_url' => 'required',
            'release_date' => 'required|date',
        ]);

        $movie->update($request->all());

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies')
            ->with('success', 'Movie deleted successfully.');
    }
}
