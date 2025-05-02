<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>McDonald's Kiosk UI</title>
    <link rel="stylesheet" href="{{ asset('newMain/css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/home.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/menu.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/cart.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/upsell.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/payment.css')}}" />
    <link rel="stylesheet" href="{{ asset('newMain/css/confirmation.css')}}" />
    <style>
        .fullscreen-btn {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #ffffff;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    
      </style>
      <style>
       .quantity-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.quantity-modal.hidden {
  display: none;
}

.modal-content {
  background: white;
  border-radius: 16px;
  padding: 30px 20px;
  width: 320px;
  text-align: center;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
  animation: fadeInUp 0.3s ease-out;
}

.modal-content img {
  width: 120px;
  height: auto;
  margin-bottom: 15px;
  border-radius: 12px;
}

.quantity-selector {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin: 20px 0;
  font-size: 24px;
  font-weight: bold;
}

.quantity-btn {
  background-color: #f2f2f2;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  font-size: 24px;
  cursor: pointer;
  transition: background 0.2s ease;
}

.quantity-btn:hover {
  background-color: #e0e0e0;
}

.modal-actions {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;
}

.primary-btn, .secondary-btn {
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.primary-btn {
  background-color: #ffcc00;
  color: black;
}

.secondary-btn {
  background-color: #ddd;
  color: #333;
}

@keyframes fadeInUp {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

      </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="app">
      <!-- Home Page -->
      <div id="home-page" class="page active">
        <div class="ad-carousel">
          <div class="carousel-container">
            <div class="carousel-slide">
              <img src="{{ asset('images/car1.jpeg')}}" alt="Delicious Burger Special" />
              <div class="carousel-caption">
                <h2>Try Our New Signature Burger</h2>
                <p>Limited time offer</p>
              </div>
            </div>
            <div class="carousel-slide">
              <img src="{{ asset('images/car2.jpeg')}}" alt="Breakfast Menu" />
              <div class="carousel-caption">
                <h2>Breakfast Menu</h2>
                <p>Available until 10:30 AM</p>
              </div>
            </div>
            <div class="carousel-slide">
              <img src="{{ asset('images/car3.jpeg')}}" alt="Happy Meal" />
              <div class="carousel-caption">
                <h2>Happy Meal with New Toys</h2>
                <p>Make your kids happy</p>
              </div>
            </div>
          </div>
          <div class="carousel-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
          </div>
        </div>
        <div class="start-order-container">
          <button id="start-order-btn" class="primary-btn">Start Order</button>
          
        </div>
        <button id="fullscreen-btn" class="fullscreen-btn">Go Fullscreen</button>
      </div>

      <!-- Menu Page -->
      <div id="menu-page" class="page">
        <header class="menu-header">
          <div class="header-actions">
            <button id="back-to-home" class="icon-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </button>
            <h1> <img src="{{asset('Main/img/logo-qbot.png')}}" alt="FastBite Logo" class=""></h1>
          </div>
          <button id="view-cart-btn" class="cart-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <span id="cart-count">0</span>
          </button>
        </header>
        
        <div class="menu-container">
          <nav class="category-nav">
            <ul class="main-categories">
              <li data-category="food-beverages" class="active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 12h.01"/><path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c-4.97 0-9-4.03-9-9m9 9a9 9 0 0 0 0-18m0 18c-4.97 0-9-4.03-9-9m9-9a9 9 0 0 1 9 9m-9-9c4.97 0 9 4.03 9 9"/></svg>
                F&B
              </li>
              <li data-category="services">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Services
              </li>
              <li data-category="items">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/><circle cx="18.5" cy="15.5" r="2.5"/><path d="M20.27 17.27 22 19"/></svg>
                Items
              </li>
            </ul>
            
            <div class="sub-categories-container">
              <!-- Food & Beverages Subcategories -->
              <ul class="sub-categories" data-parent="food-beverages" style="display: block;">
                <li data-subcategory="burgers" class="active">Burgers</li>
                <li data-subcategory="chicken">Chicken</li>
                <li data-subcategory="sides">Sides</li>
                <li data-subcategory="desserts">Desserts</li>
                <li data-subcategory="beverages">Beverages</li>
                <li data-subcategory="breakfast">Breakfast</li>
              </ul>
              
              <!-- Services Subcategories -->
              <ul class="sub-categories" data-parent="services">
                <li data-subcategory="haircut">Haircut</li>
                <li data-subcategory="delivery">Delivery</li>
                <li data-subcategory="party">Birthday Party</li>
                <li data-subcategory="wifi">Free WiFi</li>
              </ul>
              
              <!-- Items Subcategories -->
              <ul class="sub-categories" data-parent="items">
                <li data-subcategory="happy-meal">Happy Meal</li>
                <li data-subcategory="value-meals">Value Meals</li>
                <li data-subcategory="family-bundles">Family Bundles</li>
                <li data-subcategory="limited-time">Limited Time</li>
              </ul>
            </div>

            <!-- Quantity Modal -->
<div id="quantity-modal" class="quantity-modal hidden">
    <div class="modal-content">
      <h3 id="modal-item-name"></h3>
      <img id="modal-item-image" src="" alt="" />
      <p id="modal-item-description"></p>
      <div class="quantity-selector">
        <button id="decrease-qty" class="quantity-btn">-</button>
        <span id="selected-qty">1</span>
        <button id="increase-qty" class="quantity-btn">+</button>
      </div>
      <div class="modal-actions">
        <button id="confirm-add" class="primary-btn">Add to Cart</button>
        <button id="cancel-add" class="secondary-btn">Cancel</button>
      </div>
    </div>
  </div>
  
          </nav>
          
          <div class="menu-items-container">
            <h2 id="current-category">Burgers</h2>
            <div class="menu-items">
              <!-- Items will be dynamically loaded here -->
            </div>
          </div>
        </div>
      </div>

      <!-- Cart Page -->
      <div id="cart-page" class="page">
        <header class="page-header">
          <div class="header-actions">
            <button id="back-to-menu" class="icon-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </button>
            <h1>Your Order</h1>
          </div>
        </header>
        
        <div class="cart-container">
          <div class="cart-items">
            <!-- Cart items will be dynamically loaded here -->
          </div>
          
          <div class="cart-summary">
            <div class="summary-item">
              <span>Subtotal</span>
              <span id="subtotal">$0.00</span>
            </div>
            <div class="summary-item">
              <span>Tax</span>
              <span id="tax">$0.00</span>
            </div>
            <div class="summary-item total">
              <span>Total</span>
              <span id="total">$0.00</span>
            </div>
            
            <button id="checkout-btn" class="primary-btn">Proceed to Checkout</button>
          </div>
        </div>
      </div>

      <!-- Upsell Page -->
      <div id="upsell-page" class="page">
        <header class="page-header">
          <div class="header-actions">
            <button id="back-to-cart" class="icon-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </button>
            <h1>Would You Like to Add?</h1>
          </div>
        </header>
        
        <div class="upsell-container">
          <div class="upsell-items">
            <!-- Upsell items will be dynamically loaded here -->
          </div>
          
          <div class="upsell-actions">
            <button id="skip-upsell" class="secondary-btn">No Thanks</button>
            <button id="continue-to-payment" class="primary-btn">Continue to Payment</button>
          </div>
        </div>
      </div>

      <!-- Payment Page -->
      <div id="payment-page" class="page">
        <header class="page-header">
          <div class="header-actions">
            <button id="back-to-upsell" class="icon-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </button>
            <h1>Payment</h1>
          </div>
        </header>
        
        <div class="payment-container">
          <div class="payment-summary">
            <h2>Order Summary</h2>
            <div class="summary-item">
              <span>Total</span>
              <span id="payment-total">$0.00</span>
            </div>
          </div>
          
          <div class="payment-methods">
            <h2>Select Payment Method</h2>
            <div class="payment-options">
              <div class="payment-option" data-method="credit-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                <span>Credit/Debit Card</span>
              </div>
              <div class="payment-option" data-method="mobile-payment">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                <span>E-Wallet</span>
              </div>
              {{-- <div class="payment-option" data-method="gift-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/><path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/></svg>
                <span>Gift Card</span>
              </div> --}}
            </div>
          </div>
          
          {{-- <div class="payment-form">
            <!-- Credit Card Form (default) -->
            <form id="credit-card-form" class="payment-form-content active">
              <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="expiry-date">Expiry Date</label>
                  <input type="text" id="expiry-date" placeholder="MM/YY" maxlength="5">
                </div>
                <div class="form-group">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" placeholder="123" maxlength="3">
                </div>
              </div>
              <div class="form-group">
                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" placeholder="John Doe">
              </div>
            </form>
            
            <!-- Mobile Payment Form -->
            <div id="mobile-payment-form" class="payment-form-content">
              <div class="qr-container">
                <p>Scan the QR code with your mobile payment app</p>
                <div class="payment-qr-code">
                  <svg width="200" height="200" viewBox="0 0 200 200">
                    <rect width="200" height="200" fill="#ffffff"/>
                    <path d="M40,40 L40,80 L80,80 L80,40 Z" fill="#000000"/>
                    <path d="M90,40 L90,50 L100,50 L100,40 Z" fill="#000000"/>
                    <path d="M110,40 L110,50 L120,50 L120,70 L130,70 L130,40 Z" fill="#000000"/>
                    <path d="M140,40 L140,80 L160,80 L160,40 Z" fill="#000000"/>
                    <path d="M40,90 L40,100 L50,100 L50,90 Z" fill="#000000"/>
                    <path d="M70,90 L70,110 L90,110 L90,90 Z" fill="#000000"/>
                    <path d="M100,90 L100,100 L120,100 L120,120 L130,120 L130,90 Z" fill="#000000"/>
                    <path d="M140,90 L140,100 L150,100 L150,90 Z" fill="#000000"/>
                    <path d="M40,110 L40,120 L60,120 L60,130 L40,130 L40,160 L80,160 L80,140 L60,140 L60,150 L50,150 L50,140 L70,140 L70,130 L80,130 L80,120 L50,120 L50,110 Z" fill="#000000"/>
                    <path d="M90,120 L90,130 L100,130 L100,120 Z" fill="#000000"/>
                    <path d="M150,110 L150,130 L130,130 L130,140 L150,140 L150,160 L140,160 L140,150 L120,150 L120,160 L110,160 L110,140 L140,140 L140,130 L120,130 L120,110 Z" fill="#000000"/>
                    <path d="M160,110 L160,120 L150,120 L150,130 L160,130 L160,160 L140,160 L140,150 L130,150 L130,160 L90,160 L90,150 L100,150 L100,140 L90,140 L90,150 L80,150 L80,140 L90,140 L90,130 L100,130 L100,140 L110,140 L110,130 L120,130 L120,120 L110,120 L110,110 Z" fill="#000000"/>
                  </svg>
                </div>
              </div>
            </div>
            
            <!-- Gift Card Form -->
            <form id="gift-card-form" class="payment-form-content">
              <div class="form-group">
                <label for="gift-card-number">Gift Card Number</label>
                <input type="text" id="gift-card-number" placeholder="Enter 16-digit number">
              </div>
              <div class="form-group">
                <label for="gift-card-pin">PIN</label>
                <input type="text" id="gift-card-pin" placeholder="Enter 4-digit PIN" maxlength="4">
              </div>
            </form>
          </div> --}}
          
          <button id="process-payment" class="primary-btn">Pay Now</button>
        </div>
      </div>

      <!-- Confirmation Page -->
      <div id="confirmation-page" class="page">
        <div class="confirmation-container">
          <div class="confirmation-header">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <h1>Thank You!</h1>
            <p>Your order has been confirmed</p>
          </div>
          
          <div class="qr-receipt">
            <h2>Scan for E-Receipt</h2>
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
            <p>Order #: <span id="order-number">MD-12345</span></p>
          </div>
          
          <div class="order-details">
            <h2>Order Details</h2>
            <div id="confirmation-items">
              <!-- Order items will be dynamically loaded here -->
            </div>
            <div class="confirmation-total">
              <span>Total</span>
              <span id="confirmation-total-amount">$0.00</span>
            </div>
          </div>
          
          <div class="confirmation-actions">
            <button id="new-order" class="primary-btn">Start New Order</button>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('newMain/js/data.js')}}"></script>
    <script src="{{ asset('newMain/js/main.js')}}"></script>
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