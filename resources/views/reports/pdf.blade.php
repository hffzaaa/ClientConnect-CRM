<!DOCTYPE HTML>
<html>
    <head>
        <title>PDF Report</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align:left;
            }
        </style>
    </head>
    <body>
        <!-- dompdf doesnt fully support bootstrap ?-->
        <h1 class="mb-4">ClientConnect</h1> 

        <div class="table-responsive">
            @foreach ($tickets as $ticket)
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ ucwords(strtolower($ticket->customer->name)) }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ ucwords(strtolower($ticket->title)) }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ ucwords(strtolower($ticket->description)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucwords(strtolower($ticket->status)) }}</td>
                        </tr>
                        <tr>
                            <th>Priority</th>
                            <td>{{ ucwords(strtolower($ticket->priority)) }}</td>
                        </tr>
                        <tr>
                            <th>Assigned To</th>
                            <td>{{ $ticket->user ? $ticket->user->name : 'Unassigned' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $ticket->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $ticket->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
            @endforeach
        </div>
    </body>
</html>