<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Fast Food Ordering Kiosk</title>
  <link rel="stylesheet" href="{{ asset('Main/css/reset.css')}}">
  <link rel="stylesheet" href="{{ asset('Main/css/styles.css')}}">
  <link rel="stylesheet" href="{{ asset('Main/css/menu.css')}}">
  <link rel="stylesheet" href="{{ asset('Main/css/cart.css')}}">
  <link rel="stylesheet" href="{{ asset('Main/css/checkout.css')}}">
  <link rel="stylesheet" href="{{ asset('Main/css/animations.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .fullscreen-btn {
  padding: 10px 20px;
  font-size: 16px;
  background-color: #F8F9FA;
  color: #F8F9FA;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


  </style>
</head>
<body>
  <div class="app-container">
    <!-- Header -->
    <header class="header">
      <div class="logo">
        <img src="{{asset('Main/img/logo-qbot.png')}}" alt="FastBite Logo" class="">
        <button id="fullscreen-btn" class="fullscreen-btn">Go Fullscreen</button>
      </div>
      <nav class="nav">
        <button id="cart-btn" class="cart-btn">
          <span class="cart-icon">🛒</span>
          <span id="cart-count" class="cart-count">0</span>
        </button>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Menu Section -->
      <section id="menu-section" class="menu-section active-section">
        <div class="menu-container">
          <!-- Menu Items will be loaded here -->
          <div class="categories">
            <h2>F&B</h2>
            <ul id="category-list" class="category-list">
              <!-- Categories will be loaded here -->
            </ul>
          </div>
          <div id="menu-items" class="menu-items"></div>
          
          <!-- Categories Navigation -->
          
        </div>
      </section>

      <!-- Cart Section -->
      <section id="cart-section" class="cart-section">
        <div class="section-header">
          <h2>Your Order</h2>
          <button id="back-to-menu" class="back-btn">← Back to Menu</button>
        </div>
        <div id="cart-items" class="cart-items">
          <!-- Cart items will be loaded here -->
        </div>
        <div class="cart-summary">
          <div class="subtotal">
            <span>Subtotal:</span>
            <span id="subtotal-amount">RM0.00</span>
          </div>
          <div class="tax">
            <span>Tax (8%):</span>
            <span id="tax-amount">RM0.00</span>
          </div>
          <div class="total">
            <span>Total:</span>
            <span id="total-amount">RM0.00</span>
          </div>
          <button id="checkout-btn" class="primary-btn">Proceed to Checkout</button>
        </div>
      </section>

      <!-- Checkout Section -->
      <section id="checkout-section" class="checkout-section">
        <div class="section-header">
          <h2>Checkout</h2>
          <button id="back-to-cart" class="back-btn">← Back to Cart</button>
        </div>
        <div class="checkout-container">
          <div class="payment-options">
            <h3>Select Payment Method</h3>
            <div class="payment-methods">
              <div class="payment-method">
                <input type="radio" id="credit-card" name="payment" checked>
                <label for="credit-card">Credit Card</label>
              </div>
              <div class="payment-method">
                <input type="radio" id="debit-card" name="payment">
                <label for="debit-card">Debit Card</label>
              </div>
              <div class="payment-method">
                <input type="radio" id="cash" name="payment">
                <label for="cash">Cash</label>
              </div>
            </div>
          </div>
          <div class="checkout-summary">
            <h3>Order Summary</h3>
            <div id="checkout-items" class="checkout-items">
              <!-- Checkout items will be loaded here -->
            </div>
            <div class="checkout-total">
              <span>Total:</span>
              <span id="checkout-total-amount">RM0.00</span>
            </div>
          </div>
          <button id="confirm-order-btn" class="primary-btn">Confirm Order</button>
        </div>
      </section>

      <!-- Confirmation Section -->
      <section id="confirmation-section" class="confirmation-section">
        <div class="confirmation-container">
          <div class="confirmation-header">
            <h2>Order Confirmed!</h2>
            <h4>Scan for E-Receipt</h4>
            <div class="receipt-qr-code">
              <svg width="200" height="200" viewBox="0 0 200 200">
                <rect width="200" height="200" fill="#ffffff"/>
                <path d="M40,40 L40,80 L80,80 L80,40 Z" fill="#000000"/>
                <path d="M50,50 L50,70 L70,70 L70,50 Z" fill="#ffffff"/>
                <path d="M120,40 L120,80 L160,80 L160,40 Z" fill="#000000"/>
                <path d="M130,50 L130,70 L150,70 L150,50 Z" fill="#ffffff"/>
                <path d="M40,120 L40,160 L80,160 L80,120 Z" fill="#000000"/>
                <path d="M50,130 L50,150 L70,150 L70,130 Z" fill="#ffffff"/>
                <path d="M90,40 L90,50 L100,50 L100,60 L110,60 L110,70 L90,70 L90,90 L100,90 L100,100 L90,100 L90,110 L100,110 L100,120 L110,120 L110,110 L120,110 L120,100 L110,100 L110,90 L120,90 L120,100 L130,100 L130,110 L140,110 L140,120 L150,120 L150,110 L160,110 L160,90 L150,90 L150,100 L140,100 L140,90 L130,90 L130,80 L110,80 L110,40 Z" fill="#000000"/>
                <path d="M120,120 L120,130 L110,130 L110,150 L100,150 L100,160 L120,160 L120,150 L130,150 L130,160 L150,160 L150,150 L160,150 L160,130 L150,130 L150,140 L140,140 L140,130 L130,130 L130,120 Z" fill="#000000"/>
                <path d="M90,120 L90,130 L100,130 L100,140 L90,140 L90,150 L80,150 L80,120 Z" fill="#000000"/>
              </svg>
            </div>
            <div class="order-number">
              <span>Order #</span>
              <span id="order-number">12345</span>
            </div>
          </div>
          <div class="confirmation-message">
            <p>Thank you for your order. Your food will be ready shortly.</p>
          </div>
          <div class="confirmation-summary">
            <h3>Order Summary</h3>
            <div id="confirmation-items" class="confirmation-items">
              <!-- Confirmation items will be loaded here -->
            </div>
            <div class="confirmation-total">
              <span>Total:</span>
              <span id="confirmation-total-amount">$0.00</span>
            </div>
          </div>
          <button id="new-order-btn" class="primary-btn">Start New Order</button>
        </div>
      </section>
    </main>

    <!-- Modal for item customization -->
    <div id="customization-modal" class="modal">
      <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3 id="modal-item-name">Item Name</h3>
        <p id="modal-item-description">Item Description</p>
        <div id="modal-item-options" class="modal-options">
          <!-- Customization options will be loaded here -->
        </div>
        <div class="modal-quantity">
          <span>Quantity:</span>
          <div class="quantity-controls">
            <button id="quantity-decrease" class="quantity-btn">-</button>
            <span id="quantity-value">1</span>
            <button id="quantity-increase" class="quantity-btn">+</button>
          </div>
        </div>
        <div class="modal-total">
          <span>Total:</span>
          <span id="modal-item-price">$0.00</span>
        </div>
        <button id="add-to-cart-btn" class="primary-btn">Add to Cart</button>
      </div>
    </div>
  </div>

  <script src="{{asset('Main/js/data.js')}}"></script>
  <script src="{{asset('Main/js/menu.js')}}"></script>
  <script src="{{asset('Main/js/cart.js')}}"></script>
  <script src="{{asset('Main/js/checkout.js')}}"></script>
  <script src="{{asset('Main/js/app.js')}}"></script>
  <script>
    document.getElementById('fullscreen-btn').addEventListener('click', function () {
  if (!document.fullscreenElement &&  // Check if not in fullscreen mode
    !document.mozFullScreenElement && // For Firefox
    !document.webkitFullscreenElement && // For Safari
    !document.msFullscreenElement) { // For Internet Explorer/Edge
    
    // Request fullscreen
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) { // Firefox
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) { // Safari
      document.documentElement.webkitRequestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
      document.documentElement.msRequestFullscreen();
    }

    // Change button text if needed (optional)
    this.textContent = 'Exit Fullscreen';
  } else {
    // Exit fullscreen
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { // Firefox
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) { // Safari
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { // IE/Edge
      document.msExitFullscreen();
    }

    // Change button text if needed (optional)
    this.textContent = 'Go Fullscreen';
  }
});

  </script>
</body>
</html>