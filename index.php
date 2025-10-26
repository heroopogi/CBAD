<?php
session_start();

// Sample product data
$featured_products = [
    [
        'id' => 1002,
        'name' => 'Cetirizine 10mg Tablets',
        'description' => 'An antihistamine used to relieve symptoms of allergies such as sneezing, runny nose, itchy eyes, and skin rashes.',
        'price' => 25.00,
        'image' => 'https://via.placeholder.com/300x200/e8e8e8/666666?text=Cetirizine'
    ],
    [
        'id' => 1005,
        'name' => 'Amoxicillin 500mg Capsules',
        'description' => 'A broad-spectrum antibiotic used to treat a variety of bacterial infections. Requires a prescription.',
        'price' => 80.00,
        'image' => 'https://via.placeholder.com/300x200/e8e8e8/666666?text=Amoxicillin',
        'badge' => 'NEW'
    ],
    [
        'id' => 1004,
        'name' => 'Multivitamin Complex',
        'description' => 'A dietary supplement containing essential vitamins and minerals to support overall health and well-being.',
        'price' => 150.00,
        'image' => 'https://via.placeholder.com/300x200/e8e8e8/666666?text=Multivitamin'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Diabetes Health Options Pharmacy</title>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/600x400/d4d4d4/666666?text=Pharmacy+Interior" alt="Pharmacy" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4">Your Trusted Partner for Health & Wellness!</h1>
                    <p class="lead mb-4">We offer a wide selection of prescription and over-the-counter medications, ensuring you have access to the healthcare products you need, when you need them.</p>
                    <a href="orderMed.php" class="btn btn-primary btn-lg">Shop Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h4>Fast & Convenient Service</h4>
                    <p class="text-muted">Quick pickup and delivery options available</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature-icon">
                        <i class="bi bi-patch-check"></i>
                    </div>
                    <h4>Safe & Accurate</h4>
                    <p class="text-muted">Verified medications and precise dosages</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">
                        <i class="bi bi-shield-plus"></i>
                    </div>
                    <h4>Reliable Access</h4>
                    <p class="text-muted">Always stocked with essential medications</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Featured Products</h2>
                <a href="orderMed.php" class="text-decoration-none text-primary fw-bold">View all products →</a>
            </div>
            <div class="row">
                <?php foreach ($featured_products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <?php if (isset($product['badge'])): ?>
                        <span class="badge-label bg-danger"><?php echo $product['badge']; ?></span>
                        <?php endif; ?>
                        <span class="most-sold-badge">MOST SOLD</span>
                        <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text flex-grow-1"><?php echo $product['description']; ?></p>
                            <div class="mt-3">
                                <p class="fw-bold fs-5 mb-2">₱<?php echo number_format($product['price'], 2); ?></p>
                                <button class="btn btn-primary w-100" onclick="viewProductDetails(<?php echo $product['id']; ?>)">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Why Choose Us</h2>
                <h4 class="text-muted">for Your Pharmacy Needs?</h4>
                <p class="lead mt-3">At RM Diabetes Health Options Pharmacy, we are dedicated to providing high quality medications, exceptional customer service, and a convenient online experience.</p>
            </div>
            <div class="row text-center mb-4">
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5>Fast Pickup Service</h5>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5>Verified and Safe Medications</h5>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h5>Know Our Stock Levels Instantly</h5>
                </div>
            </div>
            <div class="text-center">
                <a href="orderMed.php" class="btn btn-primary btn-lg px-5">Explore Products</a>
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
    <button class="floating-cart-btn" onclick="alert('Cart is only available on the Order Medicines page.')">
        <i class="bi bi-cart"></i>
        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
    </button>
    
</body>
</html>
