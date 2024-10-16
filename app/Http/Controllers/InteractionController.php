<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Customer;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $interactions = Interaction::with('customer')->get(); // get all interactions
        return view('interactions.index', compact('interactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all(); // get all customers
        return view('interactions.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date_time' => 'required|date',
            'typeinteraction' => 'required|in:meeting,call,email',
            'notes' => 'nullable|string',
        ]);

        Interaction::create($request->all());
        return redirect()->route('interactions.index')->with('success','Interaction logged successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interaction $interaction)
    {
        return view('interactions.show', compact('interaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interaction $interaction)
    {
        return view('interactions.edit', compact('interaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interaction $interaction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date_time' => 'required|date',
            'typeinteraction' => 'required|in:meeting,call,email',
            'notes' => 'nullable|string',
        ]);

        $interaction->update($request->all());
        return redirect()->route('interactions.index')->with('success', 'Interaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interaction $interaction)
    {
        $interaction->delete();
        return redirect()->route('interactions.index')->with('success', 'Interaction deleted successfully');
    }
}
