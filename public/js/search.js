document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('#search-input');
    const customerTable = document.querySelector('#customer-table tbody');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = customerTable.querySelectorAll('tr');

        rows.forEach(row => {
            const customerName = row.querySelector('td:first-child a').textContent.toLowerCase();
            if (customerName.includes(searchTerm)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    });
});
