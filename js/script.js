// Function to update dashboard stats
function updateDashboardStats() {
    fetch('includes/get_medicines.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const medicines = data.data;
                
                // Update total medicines count
                document.getElementById('totalMedicines').textContent = medicines.length;
                
                // Count low stock items
                const lowStockCount = medicines.filter(med => med.status === 'Low Stock').length;
                document.getElementById('lowStock').textContent = lowStockCount;
                
                // Count expiring soon items
                const expiringSoonCount = medicines.filter(med => med.status === 'Expiring Soon').length;
                document.getElementById('expiringSoon').textContent = expiringSoonCount;
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to update category counts
function updateCategoryCounts() {
    fetch('includes/get_category_counts.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update category counts
                document.getElementById('antibioticsCount').textContent = data.counts.antibiotics || 0;
                document.getElementById('painReliefCount').textContent = data.counts.painRelief || 0;
                document.getElementById('vitaminsCount').textContent = data.counts.vitamins || 0;
                document.getElementById('othersCount').textContent = data.counts.others || 0;
            }
        })
        .catch(error => console.error('Error:', error));

    // Add click handlers for category boxes
    document.querySelectorAll('.category-box').forEach(box => {
        box.style.cursor = 'pointer';
        box.addEventListener('click', function() {
            const category = this.querySelector('h6').textContent;
            window.location.href = `read.html?category=${encodeURIComponent(category)}`;
        });
    });
}

// Show details for a selected stat in a modal
function showStatDetails(stat) {
    fetch('includes/get_medicines.php')
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'success') return;
            let medicines = data.data || [];

            let title = 'Details';
            if (stat === 'total') {
                title = 'All Medicines';
            } else if (stat === 'low-stock') {
                medicines = medicines.filter(m => m.status === 'Low Stock');
                title = 'Low Stock Items';
            } else if (stat === 'expiring') {
                medicines = medicines.filter(m => m.status === 'Expiring Soon');
                title = 'Expiring Soon';
            }

            const tbody = document.getElementById('statDetailsBody');
            const modalTitle = document.getElementById('statDetailsModalLabel');
            tbody.innerHTML = '';
            modalTitle.textContent = title + ` (${medicines.length})`;

            medicines.forEach(m => {
                const expiry = m.expiry_date || m.expiry || '';
                const qty = m.quantity !== undefined ? m.quantity : (m.qty || '');
                const status = m.status || '';
                const row = `
                    <tr>
                        <td>${m.name}</td>
                        <td>${qty}</td>
                        <td>${expiry}</td>
                        <td>${status}</td>
                    </tr>`;
                tbody.innerHTML += row;
            });

            // Show bootstrap modal
            const modalEl = document.getElementById('statDetailsModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(err => console.error('Error loading medicines for details:', err));
}

// Initialize dashboard if we're on the dashboard page
if (document.getElementById('antibioticsCount')) {
    // Initial load
    updateDashboardStats();
    updateCategoryCounts();

    // Refresh every 30 seconds
    setInterval(() => {
        updateDashboardStats();
        updateCategoryCounts();
    }, 30000);

    // Attach click handlers to quick stat cards
    document.querySelectorAll('[data-stat]').forEach(el => {
        el.style.cursor = 'pointer';
        el.addEventListener('click', function() {
            const stat = this.getAttribute('data-stat');
            showStatDetails(stat);
        });
    });

    // Optional debug logging
    fetch('includes/get_category_counts.php')
        .then(response => response.json())
        .then(data => console.log('Category counts:', data))
        .catch(error => console.error('Error:', error));
}

// UPDATE
const updateForm = document.getElementById('updateForm');
if (updateForm) {
  updateForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const id = +document.getElementById('updateId').value;
    const qty = document.getElementById('updateQuantity').value;
    const exp = document.getElementById('updateExpiry').value;
    const med = medicines.find((m) => m.id === id);
    if (med) {
      med.quantity = qty;
      med.expiry = exp;
      saveData();
      alert('Medicine updated!');
      updateForm.reset();
    } else {
      alert('Medicine not found!');
    }
  });
}

// DELETE
const deleteForm = document.getElementById('deleteForm');
if (deleteForm) {
  deleteForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const id = +document.getElementById('deleteId').value;
    medicines = medicines.filter((m) => m.id !== id);
    saveData();
    alert('Medicine deleted!');
    deleteForm.reset();
  });
}
    