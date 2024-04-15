<?php

namespace App\Http\Controllers;

use App\Interfaces\PropertyInterface;
use App\Models\Home;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function __construct(
        private PropertyInterface $property
    ) {
        $this->property = $property;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ['results' => $properties] = $this->property->indexPropertyService();

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

        ['status' => $status, 'message' => $message] = $this->property->createPropertyService($request->toArray());
        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/properties')->with('success', $message);
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

        ['status' => $status, 'message' => $message] = $this->property->updatePropertyService($request->toArray(), $property->id);

        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/properties')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        ['status' => $status, 'message' => $message] = $this->property->deletePropertyService($property->id);

        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/properties')->with('success', $message);
    }
}
