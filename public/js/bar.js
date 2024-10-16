document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('bar').getContext('2d');
    var createdTickets = window.createdTickets;
    var resolvedTickets = window.resolvedTickets;
    var interactedTickets = window.interactedTickets;

    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Created Tickets', 'Resolved Tickets', 'Interacted Tickets'],
            datasets: [{
                label: 'User Activity',
                data: [createdTickets, resolvedTickets, interactedTickets],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',  
                    'rgba(102, 51, 153, 0.2)',  
                    'rgba(75, 0, 130, 0.2)'     
                ], borderColor: [
                    'rgba(153, 102, 255, 1)',     
                    'rgba(102, 51, 153, 1)',      
                    'rgba(75, 0, 130, 1)'       
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
