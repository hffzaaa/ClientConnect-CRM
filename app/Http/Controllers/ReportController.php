<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; 
use App\Models\Ticket;
use PDF;
use App\Exports\TicketsExport; //export class for CSV
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Get all customer 
        return view('reports.index', compact('customers'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'datefrom' => 'nullable|date', //date range
            'dateto' => 'nullable|date', // date range
            'status' => 'nullable|string|in:open,closed,in progress,resolved',
            'format' => 'required|in:csv,pdf' // format csv or pdf only
        ]);

        $start = $request->datefrom ? Carbon::parse($request->datefrom)->startOfDay() : null;
        $end = $request->dateto ? Carbon::parse($request->dateto)->endOfDay() : null;
        
        $tickets = Ticket::query()
            ->when($request->customer_id, function($query) use ($request) {
                return $query->where('customer_id', $request->customer_id);
            })
            ->when($start, function($query) use ($start) {
                return $query->where('created_at', '>=', $start);
            })
            ->when($end, function($query) use ($end) {
                return $query->where('created_at', '<=', $end);
            })
            ->when($request->status, function($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->get();
        
            // no record
        if ($tickets->isEmpty()) {
            return redirect()->back()->with('error', 'No records found for the selected filters.');
        }

        // report
        if ($request->format === 'csv'){
            return Excel::download(new TicketsExport($tickets), 'tickets_report.csv');
        } else if ($request->format === 'pdf'){ // ref: https://github.com/barryvdh/laravel-dompdf & https://laracasts.com/discuss/channels/general-discussion/generate-pdf?page=0
            $pdf = PDF::loadView('reports.pdf', ['tickets' => $tickets]); // create a pdf from view
            return $pdf->download('tickets_report.pdf'); // download pdf
        }
    }

}
