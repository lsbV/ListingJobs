<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index',
            [
                'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6),
            ]
        );
    }

    public static function show(Listing $listing)
    {
        return view('listings.show',
            [
                'listing' => $listing,
            ]
        );
    }

    public static function create()
    {
        return view('listings.create');
    }

    public static function store()
    {
        $attributes = request()->validate(

            [
                'title' => 'required|min:3|max:255',
                'tags' => 'required|min:0|max:255',
                'company' => ['required', 'min:3', 'max:255'],
                'location' => 'required',
                'email' => 'required',
                'website' => 'required',
                'description' => 'required',
            ]
        );
//        [
//            'title' => 'required|min:3|max:255',
//            'tags' => 'required|min:0|max:255',
//            'company' => ['required', 'min:3', 'max:255', Rule::unique('listings', 'company')],
//            'location' => 'required',
//            'email' => 'required|email',
//            'website' => 'required|url',
//            'description' => 'required',
//        ];

        if (request()->hasFile('logo')) {
            $attributes['logo'] = request()->file('logo')->store('logos', 'public');
        }
        $attributes['user_id'] = auth()->id();
        Listing::create($attributes);


        return redirect('/')->with('message', 'Your listing has been added!');
    }

    public static function edit(Listing $listing)
    {
        return view('listings.edit',
            [
                'listing' => $listing,
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        if($listing->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to edit this listing');
        }

        $attributes = request()->validate(
            [
                'title' => 'required|min:3|max:255',
                'tags' => 'required|min:0|max:255',
                'company' => ['required', 'min:3', 'max:255', Rule::unique('listings', 'company')->ignore($listing->id)],
                'location' => 'required',
                'email' => 'required',
                'website' => 'required',
                'description' => 'required',
            ]
        );
        if (request()->hasFile('logo')) {
            $attributes['logo'] = request()->file('logo')->store('logos', 'public');
        }
        $listing->update($attributes);


        return back()->with('message', 'Your listing has been updated!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Your listing has been deleted!');
    }

    public function manage()
    {
        return view('listings.manage',
            [
                'listings' => auth()->user()->listings,
            ]
        );
    }
}
