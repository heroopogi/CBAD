// Medicine Inventory using localStorage
let medicines = JSON.parse(localStorage.getItem('medicines')) || [];

function saveData() {
  localStorage.setItem('medicines', JSON.stringify(medicines));
}

// CREATE
const addForm = document.getElementById('addForm');
if (addForm) {
  addForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const quantity = document.getElementById('quantity').value;
    const expiry = document.getElementById('expiry').value;
    medicines.push({ id: medicines.length + 1, name, quantity, expiry });
    saveData();
    alert('Medicine added!');
    addForm.reset();
  });
}

// READ
const table = document.getElementById('medicineTable');
if (table) {
  const tbody = table.querySelector('tbody');
  tbody.innerHTML = '';
  medicines.forEach((m) => {
    const row = `<tr><td>${m.id}</td><td>${m.name}</td><td>${m.quantity}</td><td>${m.expiry}</td></tr>`;
    tbody.innerHTML += row;
  });
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
    