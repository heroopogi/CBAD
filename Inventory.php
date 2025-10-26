<?php
session_start();

// Sample inventory data
$inventory_items = [
    ['id' => 1001, 'product' => 'Paracetamol 500mg', 'quantity' => 500, 'cost' => 15.00, 'sales' => 7500.00, 'orders' => 150, 'exp_date' => '2026-08-15'],
    ['id' => 1002, 'product' => 'Cetirizine 10mg Tabs', 'quantity' => 555, 'cost' => 25.00, 'sales' => 6250.00, 'orders' => 100, 'exp_date' => '2027-01-20'],
    ['id' => 1005, 'product' => 'Amoxicillin 500mg Caps', 'quantity' => 444, 'cost' => 80.00, 'sales' => 12000.00, 'orders' => 150, 'exp_date' => '2025-12-31'],
    ['id' => 1004, 'product' => 'Multivitamin Adult', 'quantity' => 222, 'cost' => 150.00, 'sales' => 66000.00, 'orders' => 200, 'exp_date' => '2028-05-10'],
    ['id' => 1005, 'product' => 'Vitamin C 500mg Tabs', 'quantity' => 150, 'cost' => 60.00, 'sales' => 18000.00, 'orders' => 300, 'exp_date' => '2027-03-25'],
    ['id' => 1006, 'product' => 'Saline Nasal Spray', 'quantity' => 180, 'cost' => 70.00, 'sales' => 8750.00, 'orders' => 125, 'exp_date' => '2028-06-01'],
    ['id' => 1007, 'product' => 'Band-Aids', 'quantity' => 850, 'cost' => 50.00, 'sales' => 12000.00, 'orders' => 400, 'exp_date' => '2029-04-12'],
    ['id' => 1008, 'product' => 'Alcohol 70% Solution', 'quantity' => 400, 'cost' => 90.00, 'sales' => 13500.00, 'orders' => 150, 'exp_date' => '2027-11-30'],
    ['id' => 1009, 'product' => 'Povidone-Iodine Solution', 'quantity' => 150, 'cost' => 110.00, 'sales' => 11000.00, 'orders' => 100, 'exp_date' => '2026-09-18'],
    ['id' => 1010, 'product' => 'Ibuprofen 200mg Tabs', 'quantity' => 144, 'cost' => 40.00, 'sales' => 13500.00, 'orders' => 225, 'exp_date' => '2028-02-05'],
    ['id' => 1011, 'product' => 'Ranitidine 150mg Tabs', 'quantity' => 186, 'cost' => 55.00, 'sales' => 5250.00, 'orders' => 75, 'exp_date' => '2025-11-15'],
    ['id' => 1012, 'product' => 'Oral Rehydration Salts', 'quantity' => 257, 'cost' => 10.00, 'sales' => 7000.00, 'orders' => 700, 'exp_date' => '2027-07-01'],
    ['id' => 1013, 'product' => 'First Aid Kit', 'quantity' => 56, 'cost' => 250.00, 'sales' => 12500.00, 'orders' => 50, 'exp_date' => '2026-12-22'],
    ['id' => 1014, 'product' => 'Face Masks', 'quantity' => 600, 'cost' => 120.00, 'sales' => 18000.00, 'orders' => 150, 'exp_date' => 'N/A'],
    ['id' => 1015, 'product' => 'Hand Sanitizer', 'quantity' => 21, 'cost' => 45.00, 'sales' => 12375.00, 'orders' => 275, 'exp_date' => '2026-03-10'],
    ['id' => 1016, 'product' => 'Loratadine 10mg Tabs', 'quantity' => 156, 'cost' => 50.00, 'sales' => 9000.00, 'orders' => 120, 'exp_date' => '2027-04-05'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - RM Diabetes Health Options Pharmacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">RM Diabetes Health Options Pharmacy</span>
        </div>
    </nav>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <div class="logo-box">
                    <span class="logo-text">rm</span>
                    <small class="logo-subtext">HEALTH MEDS</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="order-medicines.php">Order Medicines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="track-order.php">Track Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="inventory.php">Inventory (Staff)</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control" type="search" placeholder="Search for medicines or health products...">
                </form>
            </div>
        </div>
    </nav>

    <!-- Inventory Section -->
    <section class="py-5">
        <div class="container-fluid">
            <h1 class="text-center mb-5">Inventory</h1>
            
            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-md-2">
                    <div class="filter-sidebar">
                        <h4>Filter</h4>
                        
                        <select class="form-select" id="medicineType">
                            <option>Medicine type</option>
                            <option>Tablets</option>
                            <option>Capsules</option>
                            <option>Liquid</option>
                            <option>Spray</option>
                        </select>
                        
                        <select class="form-select" id="size">
                            <option>Size</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                        </select>
                        
                        <select class="form-select" id="price">
                            <option>Price</option>
                            <option>₱0 - ₱50</option>
                            <option>₱51 - ₱100</option>
                            <option>₱101 - ₱200</option>
                            <option>₱201+</option>
                        </select>
                        
                        <div class="mt-3">
                            <label class="fw-bold mb-2">Sort by:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortAZ">
                                <label class="form-check-label" for="sortAZ">A to Z (product)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortID">
                                <label class="form-check-label" for="sortID">Ascending # (ID)</label>
                            </div>
                        </div>
                        
                        <select class="form-select mt-3" id="source">
                            <option>Source</option>
                            <option>Manufacturer A</option>
                            <option>Manufacturer B</option>
                        </select>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-dark btn-lg rounded-circle" style="width: 60px; height: 60px;">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <input type="text" class="form-control w-50" placeholder="Search for specific products...">
                    </div>

                    <div class="inventory-table table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PRODUCT NAME</th>
                                    <th>QUANTITY</th>
                                    <th>COST (₱)</th>
                                    <th>TOTAL SALES (₱)</th>
                                    <th># OF ORDERS</th>
                                    <th>EXP. DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inventory_items as $item): ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['product']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($item['cost'], 2); ?></td>
                                    <td><?php echo number_format($item['sales'], 2); ?></td>
                                    <td><?php echo $item['orders']; ?></td>
                                    <td><?php echo $item['exp_date']; ?></td>
                                </tr>
                                <?php endforeach; ?>