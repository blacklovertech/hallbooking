<?php

namespace App\Http\Controllers;

use App\Models\Amenities;  // Assuming you have an Amenities model
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    // Display a listing of the amenities
    public function index()
    {
        $amenities = Amenities::all(); // Retrieve all amenities
        return view('admin.amenities.index', compact('amenities'));
    }

    // Show the form for creating a new Amenities
    public function create()
    {
        return view('admin.amenities.create');
    }

    public function show($id)
    {
        // Fetch the amenity by its ID
        $amenity = Amenities::findOrFail($id); // Fetch the amenity by its ID
    
        // Return the view with the amenity data
        return view('admin.amenities.show', compact('amenity'));
    }
    
    
    // Store a newly created Amenities in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Create a new Amenities in the database
        Amenities::create($validated);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenities created successfully.');
    }

    public function edit($id)
    {
        // Fetch the amenity by its ID
        $amenity = Amenities::findOrFail($id);
    
        // Return the view with the amenity data
        return view('admin.amenities.edit', compact('amenity'));
    }
    
    // Update the specified Amenities in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $Amenities = Amenities::findOrFail($id); // Find the Amenities by its ID
        $Amenities->update($validated);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenities updated successfully.');
    }

    // Remove the specified Amenities from the database
    public function destroy($id)
    {
        $Amenities = Amenities::findOrFail($id); // Find the Amenities by its ID
        $Amenities->delete(); // Delete the Amenities

        return redirect()->route('admin.amenities.index')->with('success', 'Amenities deleted successfully.');
    }
}
