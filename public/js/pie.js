const ctx = document.getElementById('pie').getContext('2d'); // Corrected getContext
const pie = new Chart(ctx, { // Changed CharacterData to Chart
    type: 'pie',
    data: {
        labels: ticketinfo.labels.map(label => label.replace(/\b\w/g, char => char.toUpperCase())),
        // Passed from dashboard
        datasets: [{
            label: '# of Tickets',
            data: ticketinfo.counts,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',  
                'rgba(255, 159, 64, 0.2)',  
                'rgba(54, 162, 235, 0.2)',   
                'rgba(75, 192, 192, 0.2)'    
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',    
                'rgba(255, 159, 64, 1)',     
                'rgba(54, 162, 235, 1)',      
                'rgba(0, 128, 0, 1)'         
            ],
            
            borderWidth: 1
        }]
    },
    options: {
        responsive: true, // Make chart responsive
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += context.raw; // Display count
                        return label;
                    }
                }
            }
        }
    }
});

