<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Queue Display</title>
    <link rel="stylesheet" href="{{ asset('QDS/css/variables.css')}}">
    <link rel="stylesheet" href="{{ asset('QDS/css/animations.css')}}">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    <link rel="stylesheet" href="{{ asset('QDS/css/responsive.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@400;500;600&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="app-container">
      <header class="header">
        <h1>Order Status</h1>
        <p class="subtitle">Track your order in real-time</p>
      </header>

      <main class="queue-container">
        <section class="queue-column preparing">
          <h2 class="column-title">
            <span class="status-icon preparing-icon"></span>
            Preparing
          </h2>
          <div class="order-list" id="preparingList">
            <!-- Orders in preparing status will be dynamically inserted here -->
          </div>
        </section>

        <section class="queue-column ready">
          <h2 class="column-title">
            <span class="status-icon ready-icon"></span>
            Ready for Collection
          </h2>
          <div class="order-list" id="readyList">
            <!-- Orders in ready status will be dynamically inserted here -->
          </div>
        </section>
      </main>

      <div class="notification preparing-notification">
        <div class="notification-content">
          <span class="notification-icon"></span>
          <p>Order #A126 is now being prepared</p>
        </div>
      </div>

      <div class="notification ready-notification">
        <div class="notification-content">
          <span class="notification-icon"></span>
          <p>Order #A122 is ready for collection</p>
        </div>
      </div>
    </div>

    <script>
      const preparingList = document.getElementById("preparingList");
      const readyList = document.getElementById("readyList");

      async function fetchOrders() {
        const res = await fetch("/orders/fetch"); // Fetching orders from the backend
        const orders = await res.json();
        return orders;
      }

      function renderOrders() {
        fetchOrders().then(orders => {
          // Clear previous order lists
          preparingList.innerHTML = '';
          readyList.innerHTML = '';

          orders.forEach(order => {
            const orderCard = createOrderCard(order);
            if (order.status === "preparing") {
              preparingList.appendChild(orderCard);
            } else if (order.status === "ready") {
              readyList.appendChild(orderCard);
            }
          });
        });
      }

      function createOrderCard(order) {
        const card = document.createElement("div");
        card.className = "order-card";
        card.setAttribute("data-order-id", order.order_number);

        const orderItems = order.items.map(item => `
          <li class="item">
            <div class="item-header">
              <span class="item-name">${item.name}</span>
              <span class="item-quantity">x${item.quantity}</span>
            </div>
          </li>
        `).join("");

        card.innerHTML = `
          <div class="order-header">
            <span class="order-number">Order #${order.order_number}</span>
            <span class="order-time">${calculateElapsed(order.created_at)}</span>
          </div>
          <div class="order-progress">
            <div class="progress-bar"><div class="progress-fill" style="width: 50%"></div></div>
          </div>
          <div class="order-details">
            <ul class="item-list">${orderItems}</ul>
            <span class="order-status">${order.status}</span>
          </div>
          <div class="order-actions">
            ${order.status === "preparing" ? `<button onclick="updateStatus(${order.id}, 'ready')">Mark Ready</button>` : ""}
          </div>
        `;
        
        return card;
      }

      function calculateElapsed(time) {
        const now = new Date();
        const orderTime = new Date(time);
        const elapsedMinutes = Math.floor((now - orderTime) / 60000); // Get minutes difference
        return `${elapsedMinutes}m ago`;
      }

      async function updateStatus(id, newStatus) {
        await fetch(`/orders/${id}/status`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
          },
          body: JSON.stringify({ status: newStatus })
        });
        renderOrders();  // Re-render the order list after status update
      }

      async function startPolling() {
        setInterval(renderOrders, 5000); // Poll every 5 seconds
      }

      // Start polling when the page is loaded
      startPolling();
    </script>
  </body>
</html>
