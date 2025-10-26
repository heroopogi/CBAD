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
                        <a class="nav-link active" href="order-medicines.php">Order Medicines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="track-order.php">Track Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory.php">Inventory (Staff)</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control" type="search" placeholder="Search for medicines or health products...">
                </form>
            </div>
        </div>
    </nav>

    <!-- Order Medicines Header -->
    <section class="py-4" style="background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold">Check Availability &</h1>
                    <h1 class="display-5 fw-bold">Place Your Order</h1>
                    <h1 class="display-5 fw-bold">Online</h1>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/500x300/d4d4d4/666666?text=Pharmacy+Shelves" alt="Pharmacy" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container-fluid">
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
                        </select>
                        
                        <select class="form-select" id="size">
                            <option>Size</option>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                        </select>
                        
                        <select class="form-select" id="price">
                            <option>Price</option>
                            <option>₱0 - ₱100</option>
                            <option>₱101 - ₱200</option>
                            <option>₱201+</option>
                        </select>
                        
                        <div class="mt-3">
                            <label class="fw-bold mb-2">Sort by:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortAZ">
                                <label class="form-check-label" for="sortAZ">A to Z</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sortLowest">
                                <label class="form-check-label" for="sortLowest">Lowest</label>
                            </div>
                        </div>
                        
                        <select class="form-select mt-3" id="source">
                            <option>Source</option>
                            <option>Local</option>
                            <option>Imported</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-md-10">
                    <!-- Category Tabs -->
                    <div class="mb-4">
                        <button class="btn btn-outline-secondary me-2">Diabetes Care</button>
                        <button class="btn btn-outline-secondary me-2 active">Vitamins</button>
                        <button class="btn btn-outline-secondary me-2">Medicine</button>
                        <button class="btn btn-outline-secondary">Other</button>
                    </div>

                    <div class="product-grid">
                        <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <h6><?php echo $product['name']; ?></h6>
                            <div class="product-price">₱<?php echo number_format($product['price'], 2); ?></div>
                            <?php if ($product['id'] <= 6): ?>
                            <div class="quantity-controls">
                                <button class="btn-decrease" onclick="decreaseQty(<?php echo $product['id']; ?>)">-</button>
                                <span id="qty-<?php echo $product['id']; ?>">0</span>
                                <button class="btn-increase" onclick="increaseQty(<?php echo $product['id']; ?>)">+</button>
                            </div>
                            <button class="btn btn-dark btn-sm w-100" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>)">
                                Add to cart
                            </button>
                            <?php else: ?>
                            <p class="text-muted mb-2">N/A</p>
                            <button class="btn btn-dark btn-sm w-100" disabled>Add to cart</button>
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
            <a href="#" class="btn btn-link text-decoration-none mb-4" onclick="hideCheckout()">
                <i class="bi bi-chevron-left"></i> Back
            </a>
            
            <div class="row">
                <!-- Items Overview -->
                <div class="col-md-5">
                    <div class="items-overview">
                        <h4 class="mb-4">Items overview</h4>
                        <p class="text-muted">Please verify the items in your cart and choose your preferred shipping method.</p>
                        
                        <div id="cartItems"></div>
                        
                        <div class="mt-4">
                            <h5>Available Shipping Methods</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="homeDelivery" checked>
                                <label class="form-check-label" for="homeDelivery">
                                    Home Delivery <span class="float-end">Free</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Payment Options</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="mobilePay" checked>
                                <label class="form-check-label" for="mobilePay">
                                    Mobile Pay
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="col-md-7">
                    <div class="payment-details">
                        <h4 class="mb-4">Payment details</h4>
                        <p class="text-muted">Fill in your payment details and complete the order.</p>
                        
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
                            
                            <button type="submit" class="btn btn-dark w-100 py-3">Finish purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Let's stay in touch! Sign up to our newsletter and get the best deals!</h5>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Insert your email address here">
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="cart.js"></script>
</body>
</html>