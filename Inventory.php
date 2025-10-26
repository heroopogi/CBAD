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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                        <a class="nav-link" href="orderMed.php">Order Medicines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trackOrder.php">Track Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Inventory.php">Inventory (Staff)</a>
                    </li>
                </ul>
                <form class="d-flex" onsubmit="performSearch(event)">
                    <input class="form-control me-2" type="search" placeholder="Search for medicines or health products..." id="searchInput">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Inventory Section -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold">Inventory Management</h1>
                <button class="btn btn-primary btn-lg rounded-pill px-4" onclick="addNewProduct()">
                    <i class="bi bi-plus-lg me-2"></i>Add New Product
                </button>
            </div>
            
            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-md-3 col-lg-2">
                    <div class="filter-sidebar">
                        <h4 class="mb-4">Filters</h4>
                        
                        <select class="form-select" id="medicineType">
                            <option selected>Medicine type</option>
                            <option>Tablets</option>
                            <option>Capsules</option>
                            <option>Liquid</option>
                            <option>Spray</option>
                        </select>
                        
                        <select class="form-select" id="size">
                            <option selected>Size</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                        </select>
                        
                        <select class="form-select" id="price">
                            <option selected>Price</option>
                            <option>₱0 - ₱50</option>
                            <option>₱51 - ₱100</option>
                            <option>₱101 - ₱200</option>
                            <option>₱201+</option>
                        </select>
                        
                        <div class="mt-4">
                            <label class="fw-bold mb-3">Sort by:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortAZ">
                                <label class="form-check-label" for="sortAZ">A to Z (product)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortID">
                                <label class="form-check-label" for="sortID">Ascending # (ID)</label>
                            </div>
                        </div>
                        
                        <select class="form-select mt-4" id="source">
                            <option selected>Source</option>
                            <option>Manufacturer A</option>
                            <option>Manufacturer B</option>
                        </select>
                        
                        <button class="btn btn-primary w-100 mt-4" onclick="applyInventoryFilters()">Apply Filters</button>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="col-md-9 col-lg-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group w-50">
                            <input type="text" class="form-control" placeholder="Search for specific products...">
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
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
                                    <th>ACTIONS</th>
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
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-2" onclick="editProduct(<?php echo $item['id']; ?>)">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct(<?php echo $item['id']; ?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <p class="text-muted mb-0">Showing 1 to 16 of 16 entries</p>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Let's stay in touch! Sign up to our newsletter and get the best deals!</h5>
                    <form class="mt-3" onsubmit="subscribeToNewsletter(event)">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Insert your email address here" required>
                            <button class="btn btn-outline-light" type="submit">Subscribe now</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="logo-box mb-3">
                        <span class="logo-text">rm</span>
                        <small class="logo-subtext">HEALTH MEDS</small>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <h6>Help</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Customer service</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">How to guides</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3">
                    <h6>Other</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Sitemap</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Subscriptions</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0 text-white-50">© 2025 RM Diabetes Health Options Pharmacy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="cart.js"></script>
    
    <!-- Floating Cart Button -->
    <button class="floating-cart-btn" onclick="window.location.href='orderMed.php'">
        <i class="bi bi-cart"></i>
        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
    </button>
    
</body>
</html>
