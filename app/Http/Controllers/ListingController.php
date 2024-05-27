<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Events\JobEnquired;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::all();
        $authUser = auth()->user();

        return Inertia::render('Index/Listings', [
            'listings' => $listings,
            'auth' => [
                'user' => $authUser,
                'roles' => $authUser ? $authUser->getRoleNames() : [], // Fetch user roles
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::check()) {
            // Create a new listing and associate it with the authenticated user
            $listing = new Listing();
            $listing->title = $validated['title'];
            $listing->company = $validated['company'];
            $listing->description = $validated['description'];

            // Get the authenticated user
            $user = Auth::user();

            // Save the listing associated with the user
            $user->listings()->save($listing);

            // Redirect back to the listings index page
            return redirect()->route('home');
        }

        // Return a response indicating failure (e.g., if the user is not authenticated)
        return redirect()->route('login');
    }

    public function edit(Listing $listing)
    {
        return Inertia::render('EditDeleteListing', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $listing->title = $validated['title'];
        $listing->company = $validated['company'];
        $listing->description = $validated['description'];
        $listing->save();

        return redirect()->route('home');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('home');
    }

    public function enquire(Request $request, Listing $listing)
    {
        $enquirerEmail = $request->user()->email;

        // Log the enquirer email and listing owner email
        Log::info('Enquirer email: ' . $enquirerEmail);
        Log::info('Listing owner email: ' . $listing->user->email);

        event(new JobEnquired($listing, $enquirerEmail));
        return redirect()->back()->with('message', 'Enquiry sent successfully');
    }
}
