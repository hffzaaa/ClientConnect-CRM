<?php

namespace App\Exports; // handle csv exports

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\WithHeadings; // allow to add headings
use carbon\carbon;


// ref: https://docs.laravel-excel.com/3.1/exports/collection.html
class TicketsExport implements FromCollection, WithHeadings
{
    protected $tickets;
    
    public function __construct($tickets){
        $this->tickets = $tickets; // export tickets
    }

    public function collection(){
        return $this->tickets->map(function($ticket) {
            return [
                'Customer ID' => $ticket->customer_id,  
                'Title' => $ticket->title,
                'Description' => $ticket->description,
                'Status' => $ticket->status,
                'Priority' => $ticket->priority,
                'Assigned To' => $ticket->user_id,  
                'Created At' => Carbon::parse($ticket->created_at)->format('Y-m-d H:i:s'),
                'Updated At' => Carbon::parse($ticket->updated_at)->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array {
        return [ // return column headers
            'Customer ID',
            'Title',
            'Description',
            'Status',
            'Priority',
            'Assigned To',
            'Created At',
            'Updated At',
        ];
    }
}
