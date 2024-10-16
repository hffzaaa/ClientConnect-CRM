<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Customer; 

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Create a query builder instance
        $query = Ticket::query();
    
        // Filter by status if a specific status is selected
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
    
        // Filter by priority if a specific priority is selected
        if ($request->has('priority') && $request->priority !== '') {
            $query->where('priority', $request->priority);
        }
    
        // Get the filtered tickets or all tickets if no filter is applied
        $tickets = $query->get();
    
        // Return the view with tickets data
        return view('tickets.index', compact('tickets'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('tickets.create', compact('customers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // TicketController.php
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in progress,resolved,closed',
            'priority' => 'required|in:low,medium,high',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::with('customer', 'user')->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id); // Fetch the ticket by ID
        $customers = Customer::all();
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate ([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in progress,resolved,closed',
            'priority' => 'required|string|in:low,medium,high',
        ]);

        $ticket->update($request->all());
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
}
