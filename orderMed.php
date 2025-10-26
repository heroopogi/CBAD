<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Sample product data
$products = [
    ['id' => 1, 'name' => 'Vitamin C 500mg Tablets', 'price' => 85.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Vitamin+C'],
    ['id' => 2, 'name' => 'Vitamin D3 1000 IU Capsules', 'price' => 120.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Vitamin+D3'],
    ['id' => 3, 'name' => 'B-Complex Vitamins Capsules', 'price' => 150.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=B-Complex'],
    ['id' => 4, 'name' => 'Multivitamin for Adults', 'price' => 250.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Multivitamin'],
    ['id' => 5, 'name' => 'Vitamin E 400 IU Capsule', 'price' => 180.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Vitamin+E'],
    ['id' => 6, 'name' => 'Calcium with Vitamin D Tablets', 'price' => 220.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Calcium'],
    ['id' => 7, 'name' => 'Prenatal Vitamins', 'price' => 350.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Prenatal'],
    ['id' => 8, 'name' => "Children's Chewable Multivitamins", 'price' => 200.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Kids+Vitamins'],
    ['id' => 9, 'name' => 'Vitamin B12', 'price' => 110.00, 'image' => 'https://via.placeholder.com/200x150/f0f0f0/666666?text=Vitamin+B12'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Medicines - RM Diabetes Health Options Pharmacy</title>
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
                        <a class="nav-link active" href="orderMed.php">Order Medicines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trackOrder.php">Track Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Inventory.php">Inventory (Staff)</a>
                    </li>
                </ul>
                <form class="d-flex" onsubmit="performSearch(event)">
                    <input class="form-control me-2" type="search" placeholder="Search for medicines or health products..." id="searchInput">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Order Medicines Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold">Check Availability &</h1>
                    <h1 class="display-5 fw-bold">Place Your Order</h1>
                    <h1 class="display-5 fw-bold">Online</h1>
                    <p class="lead mt-3">Browse our extensive collection of medications and health products. Add items to your cart and checkout when ready.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/500x300/d4d4d4/666666?text=Pharmacy+Shelves" alt="Pharmacy" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container-fluid">
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
                        </select>
                        
                        <select class="form-select" id="size">
                            <option selected>Size</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                        </select>
                        
                        <select class="form-select" id="price">
                            <option selected>Price</option>
                            <option>₱0 - ₱100</option>
                            <option>₱101 - ₱200</option>
                            <option>₱201+</option>
                        </select>
                        
                        <div class="mt-4">
                            <label class="fw-bold mb-3">Sort by:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortAZ">
                                <label class="form-check-label" for="sortAZ">A to Z</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortLowest">
                                <label class="form-check-label" for="sortLowest">Lowest Price</label>
                            </div>
                        </div>
                        
                        <select class="form-select mt-4" id="source">
                            <option selected>Source</option>
                            <option>Local</option>
                            <option>Imported</option>
                        </select>
                        
                        <button class="btn btn-primary w-100 mt-4" onclick="applyFilters()">Apply Filters</button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-md-9 col-lg-10">
                    <!-- Category Tabs -->
                    <div class="mb-4">
                        <button class="btn btn-outline-secondary me-2" onclick="filterProducts('diabetes')">Diabetes Care</button>
                        <button class="btn btn-outline-secondary me-2 active" onclick="filterProducts('vitamins')">Vitamins</button>
                        <button class="btn btn-outline-secondary me-2" onclick="filterProducts('medicine')">Medicine</button>
                        <button class="btn btn-outline-secondary" onclick="filterProducts('other')">Other</button>
                    </div>

                    <div class="product-grid">
                        <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <h6><?php echo $product['name']; ?></h6>
                            <div class="product-price">₱<?php echo number_format($product['price'], 2); ?></div>
                            <?php if ($product['id'] <= 6): ?>
                            <div class="quantity-controls">
                                <button class="btn-decrease" onclick="decreaseQuantity(<?php echo $product['id']; ?>)">-</button>
                                <span id="qty-<?php echo $product['id']; ?>">0</span>
                                <button class="btn-increase" onclick="increaseQuantity(<?php echo $product['id']; ?>)">+</button>
                            </div>
                            <button class="btn btn-primary btn-sm w-100" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>)">
                                Add to cart
                            </button>
                            <?php else: ?>
                            <p class="text-muted mb-2">Out of Stock</p>
                            <button class="btn btn-secondary btn-sm w-100" disabled>Add to cart</button>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section" id="checkoutSection" style="display: none;">
        <div class="container">
            <a href="#" class="btn btn-link text-decoration-none mb-4 fw-bold" onclick="hideCheckout()">
                <i class="bi bi-chevron-left"></i> Back to Shopping
            </a>
            
            <div class="row">
                <!-- Items Overview -->
                <div class="col-md-5">
                    <div class="items-overview">
                        <h4 class="mb-4 fw-bold">Order Summary</h4>
                        <p class="text-muted">Please verify the items in your cart and complete your purchase.</p>
                        
                        <div id="cartItems"></div>
                        
                        <div class="mt-4">
                            <h5 class="fw-bold">Shipping Method</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="homeDelivery" checked>
                                <label class="form-check-label" for="homeDelivery">
                                    Home Delivery <span class="float-end">Free</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="pickup">
                                <label class="form-check-label" for="pickup">
                                    In-Store Pickup <span class="float-end">Free</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5 class="fw-bold">Payment Options</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="mobilePay" checked>
                                <label class="form-check-label" for="mobilePay">
                                    Mobile Pay
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="cashOnDelivery">
                                <label class="form-check-label" for="cashOnDelivery">
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="col-md-7">
                    <div class="payment-details">
                        <h4 class="mb-4 fw-bold">Delivery Information</h4>
                        <p class="text-muted">Fill in your details to complete the order.</p>
                        
                        <form id="checkoutForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">Complete Purchase</button>
                        </form>
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
    <button class="floating-cart-btn" onclick="showCheckout()">
        <i class="bi bi-cart"></i>
        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
    </button>
    
</body>
</html>
