<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        // total number  of customers
        $totalCust = Customer::count();

        // recent interactions
        $recent = Ticket::with('customer')
            ->orderBy ('created_at', 'desc')
            ->take(5)
            ->get();

        // pending follow-ups (status: open)
        $pending = Ticket::where('status', 'open')->count(); // count status == open

        // active tickets and their statuses (status: open/in progress)
        $ticket = Ticket::select('status', \DB::raw('count(*) as count')) // count all tickets for each status
            ->whereIn('status', ['open', 'in progress'])
            ->groupBy('status')
            ->get();

        $ticketinfo = [
            'labels' => $ticket->pluck('status'),
            'counts' => $ticket->pluck('count')
        ];

        $user = auth()->user();

        // num of tickets created 
        $createdTickets = Ticket::where('user_id', $user->id)->count();

        // num of resolved tickets 
        $resolvedTickets = Ticket::where('user_id', $user->id)->where('status', 'resolved')->count();

        // num of tickets the user interacted
        $interactedTickets = Ticket::where('user_id', $user->id)->whereNotIn('status', ['open', 'closed'])->count();

        return view('dashboard', compact('totalCust', 'recent', 'pending', 'ticket', 'ticketinfo', 'createdTickets', 'resolvedTickets', 'interactedTickets'));
    }
}
