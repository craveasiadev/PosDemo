// Cart functionality
let cart = [];

// Initialize cart
function initializeCart() {
  // Load cart from local storage
  loadCartFromStorage();
  
  // Update cart count
  updateCartCount();
  
  // Set up event listeners
  document.getElementById('cart-btn').addEventListener('click', () => {
    showSection('cart-section');
    renderCartItems();
  });
  
  document.getElementById('back-to-menu').addEventListener('click', () => {
    showSection('menu-section');
  });
  
  document.getElementById('checkout-btn').addEventListener('click', () => {
    showSection('checkout-section');
    renderCheckoutItems();
  });
}

// Update cart count badge
function updateCartCount() {
  const cartCount = document.getElementById('cart-count');
  const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
  
  cartCount.textContent = totalItems;
  
  // Disable checkout button if cart is empty
  const checkoutBtn = document.getElementById('checkout-btn');
  if (checkoutBtn) {
    checkoutBtn.disabled = totalItems === 0;
  }
}

// Render cart items
function renderCartItems() {
  const cartItemsContainer = document.getElementById('cart-items');
  cartItemsContainer.innerHTML = '';
  
  if (cart.length === 0) {
    cartItemsContainer.innerHTML = '<p class="empty-cart">Your cart is empty. Add some items to get started!</p>';
    return;
  }
  
  cart.forEach(item => {
    const cartItem = document.createElement('div');
    cartItem.className = 'cart-item';
    
    // Generate options text
    let optionsText = '';
    for (const group in item.options) {
      const options = item.options[group].map(opt => opt.name).join(', ');
      if (options) {
        optionsText += `${group}: ${options}<br>`;
      }
    }
    
    cartItem.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="cart-item-image">
      <div class="cart-item-details">
        <h3 class="cart-item-name">${item.name}</h3>
        <div class="cart-item-options">${optionsText}</div>
        <div class="cart-item-price">$${(item.totalPrice / item.quantity).toFixed(2)} each</div>
      </div>
      <div class="cart-item-actions">
        <div class="cart-item-quantity">
          <button class="cart-quantity-btn cart-quantity-decrease" data-id="${item.id}">-</button>
          <span>${item.quantity}</span>
          <button class="cart-quantity-btn cart-quantity-increase" data-id="${item.id}">+</button>
        </div>
        <button class="cart-item-remove" data-id="${item.id}">Remove</button>
      </div>
    `;
    
    cartItemsContainer.appendChild(cartItem);
  });
  
  // Add event listeners for cart actions
  document.querySelectorAll('.cart-quantity-decrease').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = parseInt(btn.dataset.id);
      decreaseCartItemQuantity(id);
    });
  });
  
  document.querySelectorAll('.cart-quantity-increase').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = parseInt(btn.dataset.id);
      increaseCartItemQuantity(id);
    });
  });
  
  document.querySelectorAll('.cart-item-remove').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = parseInt(btn.dataset.id);
      removeCartItem(id);
    });
  });
  
  // Update cart summary
  updateCartSummary();
}

// Decrease cart item quantity
function decreaseCartItemQuantity(id) {
  const itemIndex = cart.findIndex(item => item.id === id);
  
  if (itemIndex !== -1) {
    if (cart[itemIndex].quantity > 1) {
      cart[itemIndex].quantity--;
      // Recalculate total price
      const unitPrice = cart[itemIndex].totalPrice / (cart[itemIndex].quantity + 1);
      cart[itemIndex].totalPrice = unitPrice * cart[itemIndex].quantity;
    } else {
      removeCartItem(id);
      return;
    }
    
    updateCartCount();
    saveCartToStorage();
    renderCartItems();
  }
}

// Increase cart item quantity
function increaseCartItemQuantity(id) {
  const itemIndex = cart.findIndex(item => item.id === id);
  
  if (itemIndex !== -1) {
    cart[itemIndex].quantity++;
    // Recalculate total price
    const unitPrice = cart[itemIndex].totalPrice / (cart[itemIndex].quantity - 1);
    cart[itemIndex].totalPrice = unitPrice * cart[itemIndex].quantity;
    
    updateCartCount();
    saveCartToStorage();
    renderCartItems();
  }
}

// Remove cart item
function removeCartItem(id) {
  cart = cart.filter(item => item.id !== id);
  
  updateCartCount();
  saveCartToStorage();
  renderCartItems();
}

// Update cart summary
function updateCartSummary() {
  const subtotal = cart.reduce((total, item) => total + item.totalPrice, 0);
  const tax = subtotal * 0.08; // 8% tax
  const total = subtotal + tax;
  
  document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById('tax-amount').textContent = `$${tax.toFixed(2)}`;
  document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}

// Save cart to local storage
function saveCartToStorage() {
  localStorage.setItem('fastBiteCart', JSON.stringify(cart));
}

// Load cart from local storage
function loadCartFromStorage() {
  const storedCart = localStorage.getItem('fastBiteCart');
  
  if (storedCart) {
    try {
      cart = JSON.parse(storedCart);
    } catch (error) {
      console.error('Error loading cart from storage:', error);
      cart = [];
    }
  }
}