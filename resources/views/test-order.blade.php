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
</head>
<body>
  <div class="app-container">
    <!-- Header -->
    <header class="header">
      <div class="logo">
        <img src="https://images.pexels.com/photos/1633578/pexels-photo-1633578.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="FastBite Logo" class="logo-img">
        <h1>FastBite</h1>
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
          <div id="menu-items" class="menu-items"></div>
          
          <!-- Categories Navigation -->
          <div class="categories">
            <h2>Categories</h2>
            <ul id="category-list" class="category-list">
              <!-- Categories will be loaded here -->
            </ul>
          </div>
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
            <span id="subtotal-amount">$0.00</span>
          </div>
          <div class="tax">
            <span>Tax (8%):</span>
            <span id="tax-amount">$0.00</span>
          </div>
          <div class="total">
            <span>Total:</span>
            <span id="total-amount">$0.00</span>
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
              <span id="checkout-total-amount">$0.00</span>
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
</body>
</html>