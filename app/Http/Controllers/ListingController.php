<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index()
    {
        //this will get all of our listings
        $listings = Listing::all();

        return Inertia::render('Index/Listings', ['listings' => $listings]);
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
    }
}
