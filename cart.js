// Cart functionality
let cart = [];

function increaseQty(productId) {
    const qtyElement = document.getElementById(`qty-${productId}`);
    let currentQty = parseInt(qtyElement.textContent);
    qtyElement.textContent = currentQty + 1;
}

function decreaseQty(productId) {
    const qtyElement = document.getElementById(`qty-${productId}`);
    let currentQty = parseInt(qtyElement.textContent);
    if (currentQty > 0) {
        qtyElement.textContent = currentQty - 1;
    }
}

function addToCart(productId, productName, productPrice) {
    const qtyElement = document.getElementById(`qty-${productId}`);
    const quantity = parseInt(qtyElement.textContent);
    
    if (quantity === 0) {
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
            price: productPrice,
            quantity: quantity
        });
    }
    
    // Reset quantity display
    qtyElement.textContent = '0';
    
    alert(`${productName} added to cart!`);
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartItemsContainer = document.getElementById('cartItems');
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="text-muted">Your cart is empty</p>';
        return;
    }
    
    let cartHTML = '';
    let total = 0;
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHTML += `
            <div class="cart-item">
                <img src="https://via.placeholder.com/80x80/f0f0f0/666666?text=Product" alt="${item.name}">
                <div class="flex-grow-1">
                    <h6>${item.name}</h6>
                    <p class="mb-0">Packed Bags</p>
                    <p class="mb-0">Quantity: ${item.quantity}</p>
                    <p class="fw-bold mb-0">₱${itemTotal.toFixed(2)}</p>
                </div>
                <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
    });
    
    cartHTML += `
        <div class="mt-3 pt-3 border-top">
            <div class="d-flex justify-content-between">
                <h5>Total:</h5>
                <h5>₱${total.toFixed(2)}</h5>
            </div>
        </div>
    `;
    
    cartItemsContainer.innerHTML = cartHTML;
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartDisplay();
    
    if (cart.length === 0) {
        hideCheckout();
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
            hideCheckout();
            
            // Reset form
            checkoutForm.reset();
        });
    }
    
    // Add View Cart button functionality
    addViewCartButton();
});

function addViewCartButton() {
    // Create floating cart button
    const cartButton = document.createElement('button');
    cartButton.className = 'btn btn-dark rounded-circle position-fixed';
    cartButton.style.cssText = 'bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000; box-shadow: 0 4px 8px rgba(0,0,0,0.2);';
    cartButton.innerHTML = '<i class="bi bi-cart3" style="font-size: 24px;"></i><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">0</span>';
    cartButton.onclick = showCheckout;
    
    document.body.appendChild(cartButton);
    
    // Update cart count
    setInterval(function() {
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
        }
    }, 500);
}