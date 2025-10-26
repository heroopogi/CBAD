<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order - RM Diabetes Health Options Pharmacy</title>
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
                        <a class="nav-link active" href="track-order.php">Track Your Order</a>
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

    <!-- Track Order Section -->
    <section class="track-order-section">
        <div class="container">
            <a href="index.php" class="btn btn-link text-decoration-none mb-4">
                <i class="bi bi-chevron-left"></i> Back
            </a>
            
            <h1 class="text-center mb-4">Track Your Order</h1>
            <p class="text-center text-muted mb-5">
                To find out the current status of your order, please provide your Order ID and the<br>
                Phone Number you used during checkout. The tracking information will then be sent<br>
                as a text message.
            </p>

            <div class="track-order-form">
                <form id="trackOrderForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="orderId" class="form-label fw-bold">Order ID</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg" 
                                id="orderId" 
                                placeholder="Found in your order confirmation email"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="phoneNumber" class="form-label fw-bold">Phone Number</label>
                            <input 
                                type="tel" 
                                class="form-control form-control-lg" 
                                id="phoneNumber" 
                                placeholder="Found in your order confirmation email"
                                required>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark btn-lg px-5">Track</button>
                    </div>
                </form>
                
                <div id="trackingResult" class="mt-5" style="display: none;">
                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-check-circle"></i> Order Found!</h5>
                        <p class="mb-0">Tracking information has been sent to your phone number via SMS.</p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Status</h5>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Order ID:</strong> <span id="displayOrderId"></span></p>
                                    <p><strong>Status:</strong> <span class="badge bg-success">Processing</span></p>
                                    <p><strong>Estimated Delivery:</strong> 2-3 business days</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact Number:</strong> <span id="displayPhone"></span></p>
                                    <p><strong>Order Date:</strong> <?php echo date('F d, Y'); ?></p>
                                </div>
                            </div>
                        </div>
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
    <script>
        document.getElementById('trackOrderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const orderId = document.getElementById('orderId').value;
            const phoneNumber = document.getElementById('phoneNumber').value;
            
            // Display tracking result
            document.getElementById('displayOrderId').textContent = orderId;
            document.getElementById('displayPhone').textContent = phoneNumber;
            document.getElementById('trackingResult').style.display = 'block';
            
            // Scroll to result
            document.getElementById('trackingResult').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>