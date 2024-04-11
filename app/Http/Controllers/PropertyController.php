<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();

        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homes = Home::all();

        return view('property.create', compact('homes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'home_id' => 'required|exists:homes,id'
        ]);

        Property::create([
            'name' => $request->name,
            'description' => $request->description,
            'home_id' => $request->home_id
        ]);

        return redirect('/properties')->with('message', 'success saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $homes = Home::all();

        return view('property.edit', compact('property', 'homes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        tap($property)->update([
            'name' => $request->name,
            'description' => $request->description,
            'home_id' => $request->home_id
        ]);

        return redirect('/properties')->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect('/properties')->with('message', 'success delete');
    }
}
