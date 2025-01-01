<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::all();
        return view('admin.spaces.index', compact('spaces'));
    }

    public function create()
    {
        return view('admin.spaces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Space::create($request->all());

        return redirect()->route('spaces.index')
                         ->with('success', 'Space created successfully.');
    }

    public function show(Space $space)
    {
        return view('admin.spaces.show', compact('space'));
    }

    public function edit(Space $space)
    {
        return view('admin.spaces.edit', compact('space'));
    }

    public function update(Request $request, Space $space)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $space->update($request->all());

        return redirect()->route('spaces.index')
                         ->with('success', 'Space updated successfully.');
    }

    public function destroy(Space $space)
    {
        $space->delete();

        return redirect()->route('spaces.index')
                         ->with('success', 'Space deleted successfully.');
    }
}
