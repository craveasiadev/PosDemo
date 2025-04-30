// Checkout functionality
let orderId = null;

// Initialize checkout
function initializeCheckout() {
  // Set up event listeners
  document.getElementById('back-to-cart').addEventListener('click', () => {
    showSection('cart-section');
  });
  
  document.getElementById('confirm-order-btn').addEventListener('click', confirmOrder);
  document.getElementById('new-order-btn').addEventListener('click', startNewOrder);
}

// Render checkout items
function renderCheckoutItems() {
  const checkoutItemsContainer = document.getElementById('checkout-items');
  checkoutItemsContainer.innerHTML = '';
  
  cart.forEach(item => {
    const checkoutItem = document.createElement('div');
    checkoutItem.className = 'checkout-item';
    
    checkoutItem.innerHTML = `
      <div class="checkout-item-name">
        <span class="checkout-item-quantity">${item.quantity}x</span>
        <span>${item.name}</span>
      </div>
      <div class="checkout-item-price">RM${item.totalPrice.toFixed(2)}</div>
    `;
    
    checkoutItemsContainer.appendChild(checkoutItem);
  });
  
  // Update checkout total
  const total = cart.reduce((total, item) => total + item.totalPrice, 0) * 1.08; // Including 8% tax
  document.getElementById('checkout-total-amount').textContent = `RM${total.toFixed(2)}`;
}

// Confirm order
function confirmOrder() {
  if (cart.length === 0) return;

  const paymentMethod = document.querySelector('input[name="payment"]:checked')?.id || 'cash';

  // Get the CSRF token from the meta tag in the Blade view
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch('/orders', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken  // Add CSRF token to headers
    },
    body: JSON.stringify({
      payment_method: paymentMethod,
      items: cart
    })
  })
  .then(response => response.json())
  .then(data => {
    orderId = data.order_number;
    document.getElementById('order-number').textContent = orderId;
    showConfirmation();
  })
  .catch(error => {
    console.error("Error:", error);
  });
}


function showConfirmation() {
  const confirmationItemsContainer = document.getElementById('confirmation-items');
  confirmationItemsContainer.innerHTML = '';

  cart.forEach(item => {
    const confirmationItem = document.createElement('div');
    confirmationItem.className = 'confirmation-item';
    confirmationItem.innerHTML = `
      <div class="confirmation-item-name">
        <span class="confirmation-item-quantity">${item.quantity}x</span>
        <span>${item.name}</span>
      </div>
      <div class="confirmation-item-price">RM${item.totalPrice.toFixed(2)}</div>
    `;
    confirmationItemsContainer.appendChild(confirmationItem);
  });

  const total = cart.reduce((sum, i) => sum + i.totalPrice, 0) * 1.08;
  document.getElementById('confirmation-total-amount').textContent = `RM${total.toFixed(2)}`;

  cart = [];
  updateCartCount();
  saveCartToStorage();
  showSection('confirmation-section');
}


// Start new order
function startNewOrder() {
  showSection('menu-section');
}