// Main JavaScript file for the McDonald's Kiosk UI

// Cart data
let cart = [];
let selectedUpsellItems = [];

// Current navigation state
let currentCategory = 'food-beverages';
let currentSubCategory = 'burgers';
let currentPage = 'home-page';
let currentPaymentMethod = 'credit-card';

// DOM Elements
document.addEventListener('DOMContentLoaded', () => {
  // Initialize the carousel
  initCarousel();
  
  // Load menu items for default category
  loadMenuItems(currentSubCategory);
  
  // Initialize event listeners
  initEventListeners();
});

function initCarousel() {
  const carouselContainer = document.querySelector('.carousel-container');
  const slides = document.querySelectorAll('.carousel-slide');
  const dots = document.querySelectorAll('.dot');
  let currentSlide = 0;
  
  // Set initial position
  updateCarousel();
  
  // Auto-rotate carousel
  // setInterval(() => {
  //   currentSlide = (currentSlide + 1) % slides.length;
  //   updateCarousel();
  // }, 5000);
  
  // Dot navigation
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      currentSlide = index;
      updateCarousel();
    });
  });
  
  function updateCarousel() {
    carouselContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === currentSlide);
    });
  }
}

function initEventListeners() {
  // Navigation buttons
  document.getElementById('start-order-btn').addEventListener('click', () => navigateTo('selection-page'));
  document.getElementById('dine-in').addEventListener('click', () => navigateTo('menu-page'));
  document.getElementById('take-away').addEventListener('click', () => navigateTo('menu-page'));
  document.getElementById('cancel-selection').addEventListener('click', () => navigateTo('home-page'));
  document.getElementById('back-to-home').addEventListener('click', () => navigateTo('selection-page'));
  document.getElementById('view-cart-btn').addEventListener('click', () => {
    if (cart.length > 0) {
      updateCartPage();
      loadUpsellItems();
      navigateTo('cart-page');
    } else {
      alert('Your cart is empty. Please add items to proceed.');
    }
  });
  document.getElementById('back-to-menu').addEventListener('click', () => navigateTo('menu-page'));
  document.getElementById('checkout-btn').addEventListener('click', () => {
    loadUpsellItems();
    addSelectedUpsellItemsToCart();
     updatePaymentPage();
    navigateTo('payment-page');
  });
  document.getElementById('back-to-cart').addEventListener('click', () => navigateTo('cart-page'));
  document.getElementById('back-to-upsell').addEventListener('click', () => navigateTo('cart-page'));
  document.getElementById('process-payment').addEventListener('click', processPayment);
  document.getElementById('new-order').addEventListener('click', startNewOrder);
  
  // Category navigation
  const mainCategories = document.querySelectorAll('.main-categories li');
  mainCategories.forEach(category => {
    category.addEventListener('click', () => {
      const categoryId = category.getAttribute('data-category');
      
      // Update active category
      mainCategories.forEach(cat => cat.classList.remove('active'));
      category.classList.add('active');
      
      // Show/hide subcategories
      const subcategoryLists = document.querySelectorAll('.sub-categories');
      subcategoryLists.forEach(list => {
        list.style.display = list.getAttribute('data-parent') === categoryId ? 'block' : 'none';
      });
      
      currentCategory = categoryId;
      
      // Select first subcategory by default
      const firstSubcategory = document.querySelector(`.sub-categories[data-parent="${categoryId}"] li`);
      if (firstSubcategory) {
        const subcategoryId = firstSubcategory.getAttribute('data-subcategory');
        selectSubcategory(subcategoryId);
        
        // Update active subcategory
        const subcategories = document.querySelectorAll(`.sub-categories[data-parent="${categoryId}"] li`);
        subcategories.forEach(sub => sub.classList.remove('active'));
        firstSubcategory.classList.add('active');
      }
    });
  });
  
  // Subcategory navigation
  const subcategories = document.querySelectorAll('.sub-categories li');
  subcategories.forEach(subcategory => {
    subcategory.addEventListener('click', () => {
      const parentList = subcategory.parentNode;
      const siblings = parentList.querySelectorAll('li');
      
      // Update active subcategory
      siblings.forEach(sub => sub.classList.remove('active'));
      subcategory.classList.add('active');
      
      const subcategoryId = subcategory.getAttribute('data-subcategory');
      selectSubcategory(subcategoryId);
    });
  });
  
  // Payment method selection
  const paymentOptions = document.querySelectorAll('.payment-option');
  paymentOptions.forEach(option => {
    option.addEventListener('click', () => {
      paymentOptions.forEach(opt => opt.classList.remove('active'));
      option.classList.add('active');
      
      const method = option.getAttribute('data-method');
      currentPaymentMethod = method;
      
      // Show/hide corresponding form
      const forms = document.querySelectorAll('.payment-form-content');
      forms.forEach(form => form.classList.remove('active'));
      document.getElementById(`${method}-form`).classList.add('active');
    });
  });
}

function selectSubcategory(subcategoryId) {
  currentSubCategory = subcategoryId;
  
  // Update category title
  document.getElementById('current-category').textContent = 
    subcategoryId.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
  
  // Load menu items
  loadMenuItems(subcategoryId);
}

function loadMenuItems(subcategoryId) {
  const menuItemsContainer = document.querySelector('.menu-items');
  menuItemsContainer.innerHTML = '';
  
  const items = menuItems[subcategoryId] || [];
  
  if (items.length === 0) {
    menuItemsContainer.innerHTML = `
      <div class="empty-category">
        <p>No items available in this category.</p>
      </div>
    `;
    return;
  }

  let selectedItem = null;
  let selectedQuantity = 1;
  
  items.forEach(item => {
    const itemElement = document.createElement('div');
    itemElement.className = 'menu-item';
    itemElement.innerHTML = `
      <img src="${item.image}" loading="lazy" alt="${item.name}" />
      <div class="menu-item-info add-to-cart" data-id="${item.id}">
        <h3 class="menu-item-name">${item.name}</h3>
        <p class="menu-item-price">RM${item.price.toFixed(2)}</p>
        
       
      </div>
    `;
    
    menuItemsContainer.appendChild(itemElement);
   

    // Add to cart event listener
    const addButton = itemElement.querySelector('.add-to-cart');
    // addButton.addEventListener('click', () => addToCart(item));
    addButton.addEventListener('click', () => openQuantityModal(item));
      
  });
}

function openQuantityModal(item) {
    selectedItem = item;
    selectedQuantity = 1;
    document.getElementById('modal-item-name').textContent = item.name;
    document.getElementById('modal-item-image').src = item.image;
    document.getElementById('modal-item-description').textContent = item.description;
    document.getElementById('selected-qty').textContent = selectedQuantity;
    document.getElementById('quantity-modal').classList.remove('hidden');
  }
  
  // Handle modal buttons
  document.getElementById('increase-qty').addEventListener('click', () => {
    selectedQuantity++;
    document.getElementById('selected-qty').textContent = selectedQuantity;
  });
  
  document.getElementById('decrease-qty').addEventListener('click', () => {
    if (selectedQuantity > 1) {
      selectedQuantity--;
      document.getElementById('selected-qty').textContent = selectedQuantity;
    }
  });
  
  document.getElementById('confirm-add').addEventListener('click', () => {
    for (let i = 0; i < selectedQuantity; i++) {
      addToCart(selectedItem);
    }
    document.getElementById('quantity-modal').classList.add('hidden');
    updateCartTotals();
  });
  
  document.getElementById('cancel-add').addEventListener('click', () => {
    document.getElementById('quantity-modal').classList.add('hidden');
  });
  
  

  function addToCart(item, quantity = 1) {
  // Check if item is already in cart
  const existingItemIndex = cart.findIndex(cartItem => cartItem.id === item.id);
  
  if (existingItemIndex >= 0) {
    cart[existingItemIndex].quantity += quantity;
  } else {
    cart.push({
      ...item,
      quantity: quantity
    });
  }

  
  // Update cart count
  updateCartCount();
  
  // Show brief confirmation
  const confirmation = document.createElement('div');
  confirmation.className = 'add-confirmation';
  confirmation.textContent = `${item.name} added to cart`;
  confirmation.style.cssText = `
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: var(--success);
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    z-index: 1000;
    animation: fadeIn 0.3s, fadeOut 0.3s 1.7s;
  `;
  
  document.body.appendChild(confirmation);
  
  // Remove after animation
  setTimeout(() => {
    document.body.removeChild(confirmation);
  }, 2000);
}

function updateCartCount() {
  const cartCount = document.getElementById('cart-count');
  const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
  cartCount.textContent = totalItems;
}

function updateCartPage() {
  const cartItemsContainer = document.querySelector('.cart-items');
  cartItemsContainer.innerHTML = '';
  
  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `
      <div class="empty-cart">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
        <h3>Your cart is empty</h3>
        <p>Add items to get started</p>
        <button class="secondary-btn" id="empty-cart-continue-shopping">Continue Shopping</button>
      </div>
    `;
    
    document.getElementById('empty-cart-continue-shopping').addEventListener('click', () => {
      navigateTo('menu-page');
    });
    
    return;
  }
  
  // Add each item to cart view
  cart.forEach(item => {
    const cartItem = document.createElement('div');
    cartItem.className = 'cart-item';
    cartItem.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="cart-item-image" />
      <div class="cart-item-details">
        <h3 class="cart-item-name">${item.name}</h3>
        <p class="cart-item-price">RM${item.price.toFixed(2)}</p>
      </div>
      <div class="cart-item-actions">
        <div class="quantity-control">
          <button class="quantity-btn decrease" data-id="${item.id}">-</button>
          <span class="quantity">${item.quantity}</span>
          <button class="quantity-btn increase" data-id="${item.id}">+</button>
        </div>
        <button class="remove-item" data-id="${item.id}">Remove</button>
      </div>
    `;
    
    cartItemsContainer.appendChild(cartItem);
    
    // Quantity buttons
    cartItem.querySelector('.decrease').addEventListener('click', () => {
      updateItemQuantity(item.id, -1);
    });
    
    cartItem.querySelector('.increase').addEventListener('click', () => {
      updateItemQuantity(item.id, 1);
    });
    
    // Remove button
    cartItem.querySelector('.remove-item').addEventListener('click', () => {
      removeCartItem(item.id);
    });
  });
  
  // Update totals
  updateCartTotals();
}

function updateItemQuantity(itemId, change) {
  const itemIndex = cart.findIndex(item => item.id === itemId);
  
  if (itemIndex >= 0) {
    cart[itemIndex].quantity += change;
    
    // Remove if quantity reaches 0
    if (cart[itemIndex].quantity <= 0) {
      removeCartItem(itemId);
    } else {
      // Update UI
      updateCartPage();
      updateCartCount();
    }
  }
}

function removeCartItem(itemId) {
  cart = cart.filter(item => item.id !== itemId);
  updateCartPage();
  updateCartCount();
}

function updateCartTotals() {
  const subtotal = calculateSubtotal();
  const tax = subtotal * 0.08; // Assuming 8% tax
  const total = subtotal + tax;
  
  document.getElementById('subtotal').textContent = `RM${subtotal.toFixed(2)}`;
  document.getElementById('tax').textContent = `RM${tax.toFixed(2)}`;
  document.getElementById('total').textContent = `RM${total.toFixed(2)}`;

  const cartAmountDiv = document.querySelector('.cart-amount');
  if (cartAmountDiv) {
    cartAmountDiv.textContent = `RM${subtotal.toFixed(2)}`;
  }
}

function calculateSubtotal() {
  return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
}

function loadUpsellItems() {
  const upsellItemsContainer = document.querySelector('.upsell-items');
  upsellItemsContainer.innerHTML = '';
  
  selectedUpsellItems = []; // Reset selected upsell items
  
  upsellItems.forEach(item => {
    const upsellItem = document.createElement('div');
    upsellItem.className = 'upsell-item';
    upsellItem.setAttribute('data-id', item.id);
    upsellItem.innerHTML = `
      <div class="upsell-item-checkbox">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <img src="${item.image}" loading="lazy" alt="${item.name}" />
      <div class="upsell-item-info">
        <h3 class="upsell-item-name">${item.name}</h3>
        <p class="upsell-item-price">+RM${item.price.toFixed(2)}</p>
      </div>
    `;
    
    upsellItemsContainer.appendChild(upsellItem);
    
    // Toggle selection
    upsellItem.addEventListener('click', () => {
      upsellItem.classList.toggle('selected');
      
      const itemId = upsellItem.getAttribute('data-id');
      const isSelected = upsellItem.classList.contains('selected');
      
      if (isSelected) {
        selectedUpsellItems.push(upsellItems.find(u => u.id === itemId));
      } else {
        selectedUpsellItems = selectedUpsellItems.filter(u => u.id !== itemId);
      }
    });
  });
}

function addSelectedUpsellItemsToCart() {
  selectedUpsellItems.forEach(item => {
    addToCart(item);
  });
}

function updatePaymentPage() {
  const total = calculateSubtotal() + (calculateSubtotal() * 0.08);
  document.getElementById('payment-total').textContent = `RM${total.toFixed(2)}`;
}

function processPayment() {
    // In a real application, this would handle payment processing
    // For this demo, we'll just simulate a successful payment
    
    // Collect order data
    const orderData = {
      payment_method: currentPaymentMethod,
      items: cart.map(item => ({
        name: item.name,
        quantity: item.quantity,
        totalPrice: item.price * item.quantity,
        options: [], // Add any options here if available
      }))
    };
  
    // Show loading state
    const payButton = document.getElementById('process-payment');
    const originalText = payButton.textContent;
    payButton.textContent = 'Processing...';
    payButton.disabled = true;
    
    // Get CSRF token directly
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Send the request with fetch
    fetch('/orders', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken, // Add CSRF token here
      },
      body: JSON.stringify(orderData),
    })
    .then(response => response.json())
    .then(data => {
      console.log('Order placed:', data);
      // Call updateConfirmationPage with the order number
      updateConfirmationPage(data.order_number);
  
  // Navigate to confirmation page after order is placed
  navigateTo('confirmation-page');
      
      // Optionally, reset the button state after success
      payButton.textContent = originalText;
      payButton.disabled = false;
    })
    .catch(error => {
      console.error('Error:', error);
      
      // Optionally, reset the button state after error
      payButton.textContent = originalText;
      payButton.disabled = false;
    });
}



  function updateConfirmationPage(orderNumber) {
    const confirmationItemsContainer = document.getElementById('confirmation-items');
    confirmationItemsContainer.innerHTML = '';
    
    cart.forEach(item => {
      const confirmationItem = document.createElement('div');
      confirmationItem.className = 'confirmation-item';
      confirmationItem.innerHTML = `  
        <span class="confirmation-item-name">${item.quantity}x ${item.name}</span>
        <span class="confirmation-item-price">RM${(item.price * item.quantity).toFixed(2)}</span>
      `;
      
      confirmationItemsContainer.appendChild(confirmationItem);
    });
    
    // Update order number from the API response
    document.getElementById('order-number').textContent = orderNumber;
    
    // Update total
    const total = calculateSubtotal() + (calculateSubtotal() * 0.08);
    document.getElementById('confirmation-total-amount').textContent = `RM${total.toFixed(2)}`;
  }
  
function startNewOrder() {
  // Reset cart and state
  cart = [];
  selectedUpsellItems = [];
  currentCategory = 'food-beverages';
  currentSubCategory = 'burgers';
  
  // Reset UI
  updateCartCount();
  
  // Reset category selection
  const mainCategories = document.querySelectorAll('.main-categories li');
  mainCategories.forEach(cat => cat.classList.remove('active'));
  document.querySelector('[data-category="food-beverages"]').classList.add('active');
  
  // Reset subcategory selection
  const subcategoryLists = document.querySelectorAll('.sub-categories');
  subcategoryLists.forEach(list => {
    list.style.display = list.getAttribute('data-parent') === 'food-beverages' ? 'block' : 'none';
  });
  
  const subcategories = document.querySelectorAll('.sub-categories[data-parent="food-beverages"] li');
  subcategories.forEach(sub => sub.classList.remove('active'));
  document.querySelector('[data-subcategory="burgers"]').classList.add('active');
  
  // Load menu items
  loadMenuItems('burgers');
  
  // Navigate to home
  navigateTo('home-page');
}

function navigateTo(pageId) {
  // Hide current page
  document.getElementById(currentPage).classList.remove('active');
  
  // Show new page
  document.getElementById(pageId).classList.add('active');
  
  // Update current page
  currentPage = pageId;
}

// Add this to style (for confirmation animation)
const style = document.createElement('style');
style.textContent = `
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
  }
`;
document.head.appendChild(style);