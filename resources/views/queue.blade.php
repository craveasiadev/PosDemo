<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Queue Display</title>
    {{-- Original CSS links --}}
    <link rel="stylesheet" href="{{ asset('QDS/css/main.css')}}">

    {{-- New global styles for modern layout --}}
    <link rel="stylesheet" href="{{ asset('css/modern-queue-display.css') }}"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="fullscreen-body">
     <header class="header modern-header fullscreen-header">
        <img src="{{asset('images/qlogo.png')}}" alt="Business Logo" class="modern-logo centered-logo"> 
    </header>

    <main class="main-content-area fullscreen-main-content">
        <div class="queue-section fullscreen-queue-section">
            <section class="queue-column preparing-column">
                <h2 class="column-title red-title">
                    <span class="status-icon preparing-icon"></span>
                    Preparing
                </h2>
                <div class="order-list numbers-list" id="preparingList">
                    </div>
            </section>

            <section class="queue-column ready-column">
                <h2 class="column-title green-title">
                    <span class="status-icon ready-icon"></span>
                    Please Collect
                </h2>
                <div class="order-list numbers-list" id="readyList">
                    </div>
            </section>
        </div>

        <div class="ad-section fullscreen-ad-section">
            <video id="ad-video" autoplay muted loop>
                <source src="{{ asset('images/qds-mcd.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </main>

    {{-- These notification divs will likely need custom styling based on your QDS/css/animations.css --}}
    

    {{-- The JavaScript will now dynamically create simple number boxes for the queue. --}}
    {{-- Ensure this script is placed after your main layout CSS for correct overrides/styling --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {
    const preparingList = document.getElementById("preparingList");
    const readyList = document.getElementById("readyList");

    async function fetchOrders() {
        const res = await fetch("/orders/fetch"); // Fetching orders from the backend
        const orders = await res.json();
        return orders;
    }

    function renderOrders() {
        fetchOrders().then(orders => {
            // Filter orders for preparing and ready statuses
            const preparingOrders = orders.filter(order => order.status === "preparing");
            const readyOrders = orders.filter(order => order.status === "ready");

            // Clear previous order lists
            preparingList.innerHTML = '';
            readyList.innerHTML = '';

            // Render preparing orders (now just their number)
            preparingOrders.forEach(order => {
                const orderCard = createOrderNumberCard(order, 'preparing-status');
                preparingList.appendChild(orderCard);
            });

            // Render ready orders (now just their number)
            readyOrders.forEach(order => {
                const orderCard = createOrderNumberCard(order, 'ready-status');
                readyList.appendChild(orderCard);
            });
        });
    }

    // New function to create the simplified order number card
    function createOrderNumberCard(order, statusClass) {
        const card = document.createElement("div");
        card.className = `order-card ${statusClass}`; // Add status class for styling
        card.setAttribute("data-order-id", order.order_number);
        card.textContent = order.order_number; // Only display the order number

        // You can add an animation class here if you have one defined in animations.css, e.g.:
        // card.classList.add('new-order-animation');

        return card;
    }

    // Keep your existing calculateElapsed function if you still use it elsewhere
    // Although for the simplified number display, it's not directly rendered.
    function calculateElapsed(time) {
        const now = new Date();
        const orderTime = new Date(time);
        const elapsedMinutes = Math.floor((now - orderTime) / 60000); // Difference in minutes

        if (elapsedMinutes < 60) {
            return `${elapsedMinutes}m ago`;
        } else {
            const hours = Math.floor(elapsedMinutes / 60);
            return `${hours} hour${hours > 1 ? 's' : ''} ago`;
        }
    }

    // Keep your existing updateStatus function, it's backend related
    async function updateStatus(id, newStatus) {
        await fetch(`/orders/${id}/status`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content // Assuming you have a CSRF meta tag
            },
            body: JSON.stringify({ status: newStatus })
        });
        renderOrders();  // Re-render the order list after status update
    }

    // Start polling when the page is loaded
    async function startPolling() {
        // Initial render
        renderOrders();
        // Poll every 4 seconds (as per your original script)
        setInterval(renderOrders, 4000); 
    }

    // Start polling when the page is loaded
    startPolling();
});
    </script>
    {{-- If you have other scripts, include them here as needed. --}}
</body>
</html>