<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::with('subject')->get();
        $subjects = Subject::all();
        return view('admin.lecturers.index', compact('lecturers', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('admin.lecturers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Lecturer::create($request->all());

        return redirect()->route('lecturers.index')->with('success', 'Lecturer created successfully.');
    }

    public function edit(Lecturer $lecturer)
    {
        $subjects = Subject::all();
        return view('admin.lecturers.edit', compact('lecturer', 'subjects'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $lecturer->update($request->all());

        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully.');
    }
}
