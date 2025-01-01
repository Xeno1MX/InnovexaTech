<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Subject;
use App\Models\Space;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $subjects = Subject::all();
        $spaces = Space::all();
        $lecturers = Lecturer::all();
        $bookings = Booking::with(['subject', 'space', 'lecturer'])->where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings', 'subjects', 'spaces', 'lecturers'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $subjects = Subject::all();
        $spaces = Space::all();
        $lecturers = Lecturer::all();
        return view('bookings.create', compact('subjects', 'spaces', 'lecturers'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'space_id' => 'required|exists:spaces,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'required'
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'space_id' => $request->space_id,
            'lecturer_id' => $request->lecturer_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        $subjects = Subject::all();
        $spaces = Space::all();
        $lecturers = Lecturer::all();
        return view('bookings.edit', compact('booking', 'subjects', 'spaces', 'lecturers'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'space_id' => 'required|exists:spaces,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'required',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    // Function to display the booking approval page for admin
    public function showApprovalPage()
    {
        // Fetch all bookings, you can apply filtering or sorting if needed
        $bookings = Booking::with(['subject', 'space', 'lecturer'])->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    // Function to approve a booking
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->route('admin.bookings.approval')->with('success', 'Booking approved successfully.');
    }

    // Function to reject a booking
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('admin.bookings.approval')->with('success', 'Booking rejected successfully.');
    }
}

