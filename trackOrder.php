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
                        <a class="nav-link active" href="trackOrder.php">Track Your Order</a>
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

    <!-- Track Order Section -->
    <section class="track-order-section">
        <div class="container">
            <a href="index.php" class="btn btn-link text-decoration-none mb-4 fw-bold">
                <i class="bi bi-chevron-left"></i> Back to Home
            </a>
            
            <h1 class="text-center mb-4 fw-bold">Track Your Order</h1>
            <p class="text-center text-muted mb-5 lead">
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
                        <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold">Track Order</button>
                    </div>
                </form>
                
                <div id="trackingResult" class="mt-5" style="display: none;">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading fw-bold"><i class="bi bi-check-circle me-2"></i> Order Found!</h5>
                        <p class="mb-0">Tracking information has been sent to your phone number via SMS.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Order Status</h5>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Order ID:</strong> <span id="displayOrderId"></span></p>
                                    <p><strong>Status:</strong> <span class="badge bg-success">Processing</span></p>
                                    <p><strong>Estimated Delivery:</strong> 2-3 business days</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact Number:</strong> <span id="displayPhone"></span></p>
                                    <p><strong>Order Date:</strong> <?php echo date('F d, Y'); ?></p>
                                    <p><strong>Order Total:</strong> ₱1,250.00</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h6 class="fw-bold">Order Progress</h6>
                                <div class="progress-steps mt-3">
                                    <div class="step completed">
                                        <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <p class="mt-2 mb-0 fw-bold">Order Placed</p>
                                        <p class="text-muted small">Oct 25, 2025</p>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <p class="mt-2 mb-0 fw-bold">Payment Received</p>
                                        <p class="text-muted small">Oct 25, 2025</p>
                                    </div>
                                    <div class="step active">
                                        <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-box-seam"></i>
                                        </div>
                                        <p class="mt-2 mb-0 fw-bold">Processing</p>
                                        <p class="text-muted small">Expected: Oct 27, 2025</p>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon bg-light text-dark rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                        <p class="mt-2 mb-0 fw-bold">Shipped</p>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon bg-light text-dark rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-house-door"></i>
                                        </div>
                                        <p class="mt-2 mb-0 fw-bold">Delivered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
    <style>
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #e2e8f0;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        
        .step-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto;
            font-size: 16px;
        }
        
        .step.completed .step-icon {
            background-color: #10b981 !important;
        }
        
        .step.active .step-icon {
            background-color: #2563eb !important;
        }
        
        .step:not(.completed):not(.active) .step-icon {
            background-color: #f1f5f9 !important;
            color: #94a3b8 !important;
        }
    </style>
    
    <!-- Floating Cart Button -->
    <button class="floating-cart-btn" onclick="window.location.href='orderMed.php'">
        <i class="bi bi-cart"></i>
        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
    </button>
    
</body>
</html>
