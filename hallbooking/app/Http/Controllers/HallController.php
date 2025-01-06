<?php
namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    // List all halls
    public function index()
    {
        // Retrieve all halls with pagination (if needed)
        $halls = Hall::paginate(10);  // You can adjust pagination as needed
        return view('admin.halls.index', compact('halls'));
    }

    // Show the form to create a new hall
    public function create()
    {
        // Return view for creating a hall
        return view('admin.halls.create');
    }

    
    public function show($id)
    {
        // Fetch the hall by its ID
        $hall = Hall::findOrFail($id);
        
        // Fetch bookings related to this hall
        $bookings = $hall->bookings; // This will use 'hallID' as the foreign key
    
        return view('admin.halls.show', compact('hall', 'bookings'));
    }
    
    
    // Store a new hall
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255', // If needed, add 'location' validation
        ]);

        // Create the new hall
        Hall::create($request->all());

        // Redirect to the index route for halls
        return redirect()->route('admin.halls.index');
    }

    // Show the form to edit an existing hall
    public function edit($id)
    {
        // Find the hall by ID
        $hall = Hall::findOrFail($id);

        // Return the edit view with hall data
        return view('admin.halls.edit', compact('hall'));
    }

    // Update an existing hall
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255', // If needed, add 'location' validation
        ]);

        // Find the hall by ID and update it
        $hall = Hall::findOrFail($id);
        $hall->update($request->all());

        // Redirect to the index route for halls
        return redirect()->route('admin.halls.index');
    }

    // Delete a hall
    public function destroy($id)
    {
        // Find the hall and delete it
        $hall = Hall::findOrFail($id);
        $hall->delete();

        // Redirect to the index route for halls
        return redirect()->route('admin.halls.index');
    }
}
