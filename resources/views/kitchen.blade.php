<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kitchen Display System</title>
    <link rel="stylesheet" href="{{ asset('KDS/css/reset.css')}}">
    <link rel="stylesheet" href="{{ asset('KDS/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('KDS/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('KDS/css/animation.css')}}">
    <link rel="stylesheet" href="{{ asset('KDS/css/responsive.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="header-content">
        <img src="{{asset('images/qlogo.png')}}" alt="FastBite Logo" class="" width="100">
        <h1>Kitchen Display</h1>
        
      </div>
    </header>

    <main>
      <div class="order-grid" id="orderGrid">
        

       
      </div>
    </main>

    <script>
        const orderGrid = document.getElementById("orderGrid");
        let lastOrders = [];
        
        async function fetchOrders() {
          const res = await fetch("/orders/fetch"); // Fetching orders from the database
          const orders = await res.json();
          return orders;
        }
        
        function ordersChanged(newOrders) {
          return JSON.stringify(newOrders) !== JSON.stringify(lastOrders);
        }
        
        function renderOrders(orders) {
  orderGrid.innerHTML = "";

  orders.forEach(order => {
    const orderTime = new Date(order.created_at);
  const now = new Date();
  const hoursElapsed = (now - orderTime) / (1000 * 60 * 60); // in hours

  if (hoursElapsed > 4) {
    // Send request to delete old order
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/orders/${order.id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'application/json'
      }
    });

    return; // Skip rendering
  }
    const itemsHTML = order.items.map(item => `
      <li class="item">
        <div class="item-header">
          <span class="item-name">${item.name}</span>
          <span class="item-quantity">x${item.quantity}</span>
        </div>
        ${item.modifiers?.length ? `<ul class="modifiers">${item.modifiers.map(mod => `<li>${mod}</li>`).join("")}</ul>` : ""}
        ${item.instructions ? `<div class="special-instructions"><p>${item.instructions}</p></div>` : ""}
      </li>
    `).join("");

    // Safeguard against undefined payment_method
    const paymentMethod = order.payment_method ? order.payment_method.toLowerCase() : 'unknown';

    const card = document.createElement("div");
    card.className = `order-card ${order.status}-order`;
    card.innerHTML = `
      <div class="order-header">
        <div class="order-info">
          <h2>Order #${order.order_number}</h2>
          <span class="order-type ${paymentMethod}">${paymentMethod}</span>
        </div>
        <div class="order-meta">
          <div class="order-time">
           <span class="time">${formatDate(order.created_at)}</span>
            <span class="elapsed">${calculateElapsed(order.created_at)}</span>
          </div>
          ${order.priority ? `<div class="priority ${order.priority.toLowerCase()}">${order.priority} Priority</div>` : ""}
        </div>
      </div>
      <div class="order-progress">
        <div class="progress-bar"><div class="progress-fill" style="width: 0%"></div></div>
        <span class="status-label">${order.status}</span>
      </div>
      <div class="order-details">
        <ul class="item-list">${itemsHTML}</ul>
      </div>
      <div class="order-actions">
        ${order.status === "new" ? `<button onclick="updateStatus(${order.id}, 'preparing')">Start Preparing</button>` : ""}
        ${order.status === "preparing" ? `<button onclick="updateStatus(${order.id}, 'ready')">Mark Ready</button>` : ""}
      </div>
    `;
    orderGrid.appendChild(card);
  });

  lastOrders = orders;
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-GB', {
    day: '2-digit',
    month: 'short',
    year: 'numeric'
  });
}

        
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

        
        async function updateStatus(id, newStatus) {
  await fetch(`/orders/${id}/status`, {
    method: "PUT",  // Change POST to PUT
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": '{{ csrf_token() }}' // Ensure CSRF token is passed
    },
    body: JSON.stringify({ status: newStatus })
  });
  // No need to reload manually – polling will refresh it
}

        
        async function startPolling() {
          setInterval(async () => {
            try {
              const orders = await fetchOrders();
              if (ordersChanged(orders)) {
                renderOrders(orders);
              }
            } catch (e) {
              console.error("Failed to fetch orders:", e);
            }
          }, 1000); // Poll every 2 seconds
        }
        
        startPolling();
        </script>
        
  </body>
</html>