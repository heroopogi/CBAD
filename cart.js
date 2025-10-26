// Cart functionality
let cart = [];

// Load cart from session storage on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeCart();
    updateCartDisplay();
    updateCartCount();
});

function initializeCart() {
    try {
        const savedCart = sessionStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
        }
    } catch (error) {
        console.error('Error loading cart from session storage:', error);
        cart = [];
    }
}

function saveCart() {
    try {
        sessionStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
    } catch (error) {
        console.error('Error saving cart to session storage:', error);
    }
}

function increaseQuantity(productId) {
    try {
        const qtyElement = document.getElementById(`qty-${productId}`);
        if (!qtyElement) {
            console.error(`Quantity element not found for product ID: ${productId}`);
            return;
        }
        let currentQty = parseInt(qtyElement.textContent);
        if (isNaN(currentQty)) {
            currentQty = 0;
        }
        qtyElement.textContent = currentQty + 1;
    } catch (error) {
        console.error('Error increasing quantity:', error);
    }
}

function decreaseQuantity(productId) {
    try {
        const qtyElement = document.getElementById(`qty-${productId}`);
        if (!qtyElement) {
            console.error(`Quantity element not found for product ID: ${productId}`);
            return;
        }
        let currentQty = parseInt(qtyElement.textContent);
        if (isNaN(currentQty)) {
            currentQty = 0;
        }
        if (currentQty > 0) {
            qtyElement.textContent = currentQty - 1;
        }
    } catch (error) {
        console.error('Error decreasing quantity:', error);
    }
}

function addToCart(productId, productName, productPrice) {
    try {
        const qtyElement = document.getElementById(`qty-${productId}`);
        if (!qtyElement) {
            alert('Error: Product not found');
            return;
        }
        
        const quantity = parseInt(qtyElement.textContent);
        if (isNaN(quantity) || quantity <= 0) {
            alert('Please select a quantity first');
            return;
        }
        
        // Check if product already in cart
        const existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: parseFloat(productPrice),
                quantity: quantity
            });
        }
        
        // Save cart to session storage
        saveCart();
        
        // Reset quantity display
        qtyElement.textContent = '0';
        
        // Show success message
        alert(`${productName} added to cart!`);
        updateCartDisplay();
    } catch (error) {
        console.error('Error adding to cart:', error);
        alert('Error adding product to cart. Please try again.');
    }
}

function updateCartDisplay() {
    try {
        const cartItemsContainer = document.getElementById('cartItems');
        if (!cartItemsContainer) {
            console.error('Cart items container not found');
            return;
        }
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p class="text-muted text-center py-4">Your cart is empty</p>';
            return;
        }
        
        let cartHTML = '';
        let total = 0;
        
        cart.forEach((item, index) => {
            // Validate item data
            if (!item.name || isNaN(item.price) || isNaN(item.quantity)) {
                console.error('Invalid item data:', item);
                return;
            }
            
            const itemTotal = parseFloat(item.price) * parseInt(item.quantity);
            total += itemTotal;
            
            cartHTML += `
                <div class="cart-item">
                    <img src="https://via.placeholder.com/80x80/f0f0f0/666666?text=Product" alt="${item.name}">
                    <div class="flex-grow-1">
                        <h6 class="fw-bold">${item.name}</h6>
                        <p class="mb-1 text-muted">Packed Bags</p>
                        <p class="mb-1">Quantity: ${item.quantity}</p>
                        <p class="fw-bold mb-0 text-primary">₱${itemTotal.toFixed(2)}</p>
                    </div>
                    <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
        });
        
        cartHTML += `
            <div class="mt-4 pt-4 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold">Total:</h5>
                    <h5 class="fw-bold">₱${total.toFixed(2)}</h5>
                </div>
                <button class="btn btn-success w-100 mt-3 fw-bold" onclick="proceedToCheckout()">
                    Proceed to Checkout
                </button>
            </div>
        `;
        
        cartItemsContainer.innerHTML = cartHTML;
    } catch (error) {
        console.error('Error updating cart display:', error);
        if (document.getElementById('cartItems')) {
            document.getElementById('cartItems').innerHTML = '<p class="text-danger text-center py-4">Error loading cart items</p>';
        }
    }
}

function removeFromCart(index) {
    try {
        if (index < 0 || index >= cart.length) {
            console.error('Invalid cart item index:', index);
            return;
        }
        
        const removedItem = cart.splice(index, 1)[0];
        saveCart();
        updateCartDisplay();
        
        if (cart.length === 0) {
            hideCheckout();
        }
        
        // Show removal confirmation
        alert(`${removedItem.name} removed from cart!`);
    } catch (error) {
        console.error('Error removing item from cart:', error);
        alert('Error removing item from cart. Please try again.');
    }
}

function showCheckout() {
    if (cart.length === 0) {
        alert('Your cart is empty. Please add items first.');
        return;
    }
    
    updateCartDisplay();
    document.getElementById('checkoutSection').style.display = 'block';
    document.getElementById('checkoutSection').scrollIntoView({ behavior: 'smooth' });
}

function hideCheckout() {
    document.getElementById('checkoutSection').style.display = 'none';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function proceedToCheckout() {
    if (cart.length === 0) {
        alert('Your cart is empty. Please add items first.');
        return;
    }
    
    // Scroll to checkout form
    document.querySelector('#checkoutSection .payment-details').scrollIntoView({ 
        behavior: 'smooth' 
    });
}

// Checkout form submission
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkoutForm');
    
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Generate order ID
            const orderId = 'ORD' + Date.now();
            
            // Get form data
            const email = document.getElementById('email').value;
            const fullName = document.getElementById('fullName').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const zipCode = document.getElementById('zipCode').value;
            
            // Calculate total
            let total = 0;
            cart.forEach(item => {
                total += item.price * item.quantity;
            });
            
            // Show success message
            alert(`Order placed successfully!\n\nOrder ID: ${orderId}\nTotal: ₱${total.toFixed(2)}\n\nA confirmation email has been sent to ${email}`);
            
            // Clear cart
            cart = [];
            saveCart();
            hideCheckout();
            
            // Reset form
            checkoutForm.reset();
        });
    }
});

function updateCartCount() {
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
    }
}

function viewProductDetails(productId) {
    // Redirect to product details page with product ID
    // For now, we'll redirect to orderMed.php with a product parameter
    window.location.href = 'orderMed.php?product=' + productId;
}

function applyFilters() {
    // Get filter values
    const medicineType = document.getElementById('medicineType').value;
    const size = document.getElementById('size').value;
    const price = document.getElementById('price').value;
    const source = document.getElementById('source').value;
    
    // For now, just show an alert with the selected filters
    // In a real implementation, you would filter the products
    alert(`Filters applied:\nMedicine Type: ${medicineType}\nSize: ${size}\nPrice: ${price}\nSource: ${source}`);
    
    // Here you would normally filter the products based on these values
    // For example, you could hide/show products based on the filters
}

function applyInventoryFilters() {
    // Get filter values
    const medicineType = document.getElementById('medicineType').value;
    const size = document.getElementById('size').value;
    const price = document.getElementById('price').value;
    const source = document.getElementById('source').value;
    
    // For now, just show an alert with the selected filters
    // In a real implementation, you would filter the inventory items
    alert(`Inventory filters applied:\nMedicine Type: ${medicineType}\nSize: ${size}\nPrice: ${price}\nSource: ${source}`);
    
    
    // Here you would normally filter the inventory items based on these values
}

function addNewProduct() {
    // For now, just show an alert
    // In a real implementation, you would show a modal form to add a new product
    alert('Add New Product functionality would open a form to add a new product to the inventory.');
}

function editProduct(productId) {
    // For now, just show an alert
    // In a real implementation, you would show a modal form to edit the product
    alert('Edit Product functionality would open a form to edit product ID: ' + productId);
}

function deleteProduct(productId) {
    // For now, just show an alert
    // In a real implementation, you would delete the product from the inventory
    if (confirm('Are you sure you want to delete this product?')) {
        alert('Delete Product functionality would delete product ID: ' + productId);
    }
}

function filterProducts(category) {
    // For now, just show an alert
    // In a real implementation, you would filter the products based on category
    alert('Filtering products by category: ' + category);
    
    // Here you would normally filter the products based on the selected category
    // For example, you could hide/show products based on their category
}

function performSearch(event) {
    event.preventDefault();
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            // For now, just show an alert with the search term
            // In a real implementation, you would filter the products based on the search term
            alert('Search functionality would search for: ' + searchTerm);
            
            // Here you would normally filter the products based on the search term
            // For example, you could redirect to a search results page
            // window.location.href = 'search.php?q=' + encodeURIComponent(searchTerm);
        }
    }
}

function subscribeToNewsletter(event) {
    event.preventDefault();
    const form = event.target;
    const emailInput = form.querySelector('input[type="email"]');
    
    if (emailInput && emailInput.value.trim()) {
        const email = emailInput.value.trim();
        
        // Basic email validation
        if (!isValidEmail(email)) {
            alert('Please enter a valid email address.');
            return;
        }
        
        // For now, just show an alert
        // In a real implementation, you would send the email to your server
        alert('Thank you for subscribing to our newsletter! We have sent a confirmation email to ' + email);
        
        // Reset the form
        form.reset();
    }
}

function isValidEmail(email) {
    // Basic email validation regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
