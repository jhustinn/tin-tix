<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::all();
        return view('admin.showtimes.index', compact('showtimes'));
    }

    public function create()
    {
        return view('admin.showtimes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required',
        ]);

        Showtime::create($request->all());

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime created successfully.');
    }

    public function show(Showtime $showtime)
    {
        return view('admin.showtimes.show', compact('showtime'));
    }

    public function edit(Showtime $showtime)
    {
        return view('admin.showtimes.edit', compact('showtime'));
    }

    public function update(Request $request, Showtime $showtime)
    {
        $request->validate([
            'time' => 'required',
        ]);

        $showtime->update($request->all());

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime updated successfully.');
    }

    public function destroy(Showtime $showtime)
    {
        $showtime->delete();

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime deleted successfully.');
    }
}
