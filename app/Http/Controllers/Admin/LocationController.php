<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = \App\Models\Location::paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required|in:head_office,branch_office,mine',
            'region' => 'required',
        ]);

        \App\Models\Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $location = \App\Models\Location::findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $location = \App\Models\Location::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required|in:head_office,branch_office,mine',
            'region' => 'required',
        ]);

        $location->update($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diperbarui');
    }
}
