<?php

namespace App\Http\Controllers;

use App\Models\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
        $dates = Date::all();
        return view('admin.dates.index', compact('dates'));
    }

    public function create()
    {
        return view('admin.dates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:dates,date',
        ]);

        Date::create($request->all());

        return redirect()->route('admin.dates.index')
            ->with('success', 'Date created successfully.');
    }

    public function show(Date $date)
    {
        return view('admin.dates.show', compact('date'));
    }

    public function edit(Date $date)
    {
        return view('admin.dates.edit', compact('date'));
    }

    public function update(Request $request, Date $date)
    {
        $request->validate([
            'date' => 'required|date|unique:dates,date,' . $date->id,
        ]);

        $date->update($request->all());

        return redirect()->route('admin.dates.index')
            ->with('success', 'Date updated successfully.');
    }

    public function destroy(Date $date)
    {
        $date->delete();

        return redirect()->route('admin.dates.index')
            ->with('success', 'Date deleted successfully.');
    }
}
