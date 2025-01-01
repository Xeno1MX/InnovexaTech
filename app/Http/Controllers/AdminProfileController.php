<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', [
            'user' => $admin,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        // Get the currently authenticated admin user
        $admin = Auth::guard('admin')->user();

        // Fill the admin's profile with validated data
        $admin->fill($request->validated());

        // If the email is changed, set email_verified_at to null
        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        // Save the changes
        $admin->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }


}
