// Menu functionality
let selectedCategory = 'burgers';
let currentItem = null;
let modalQuantity = 1;
let selectedOptions = {};

// Initialize menu
function initializeMenu() {
  renderCategories();
  renderMenuItems(selectedCategory);
  
  // Set up event listeners for the modal
  const modal = document.getElementById('customization-modal');
  const closeModal = document.querySelector('.close-modal');
  
  closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
  });
  
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
  
  // Quantity controls
  document.getElementById('quantity-decrease').addEventListener('click', () => {
    if (modalQuantity > 1) {
      modalQuantity--;
      updateModalQuantity();
    }
  });
  
  document.getElementById('quantity-increase').addEventListener('click', () => {
    modalQuantity++;
    updateModalQuantity();
  });
  
  // Add to cart button
  document.getElementById('add-to-cart-btn').addEventListener('click', addToCart);
}

// Render categories
function renderCategories() {
  const categoryList = document.getElementById('category-list');
  categoryList.innerHTML = '';
  
  menuData.categories.forEach(category => {
    const categoryItem = document.createElement('li');
    categoryItem.className = `category-item ${category.id === selectedCategory ? 'active' : ''}`;
    categoryItem.dataset.categoryId = category.id;
    categoryItem.textContent = category.name;
    
    categoryItem.addEventListener('click', () => {
      selectedCategory = category.id;
      
      // Update active class
      document.querySelectorAll('.category-item').forEach(item => {
        item.classList.remove('active');
      });
      categoryItem.classList.add('active');
      
      // Render menu items for the selected category
      renderMenuItems(selectedCategory);
    });
    
    categoryList.appendChild(categoryItem);
  });
}

// Render menu items for a category
function renderMenuItems(categoryId) {
  const menuItemsContainer = document.getElementById('menu-items');
  menuItemsContainer.innerHTML = '';
  
  const filteredItems = menuData.items.filter(item => item.category === categoryId);
  
  filteredItems.forEach(item => {
    const menuItem = document.createElement('div');
    menuItem.className = 'menu-item';
    menuItem.dataset.itemId = item.id;
    
    menuItem.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="menu-item-image">
      <div class="menu-item-content">
        <div class="menu-item-header">
          <h3 class="menu-item-name">${item.name}</h3>
          <span class="menu-item-price">$${item.price.toFixed(2)}</span>
        </div>
        <p class="menu-item-description">${item.description}</p>
        <div class="menu-item-action">
          <button class="primary-btn">Add to Order</button>
        </div>
      </div>
    `;
    
    menuItem.querySelector('.primary-btn').addEventListener('click', () => {
      openItemModal(item);
    });
    
    menuItemsContainer.appendChild(menuItem);
  });
}

// Open item customization modal
function openItemModal(item) {
  currentItem = item;
  selectedOptions = {};
  modalQuantity = 1;
  
  const modal = document.getElementById('customization-modal');
  const modalItemName = document.getElementById('modal-item-name');
  const modalItemDescription = document.getElementById('modal-item-description');
  const modalItemOptions = document.getElementById('modal-item-options');
  const modalItemPrice = document.getElementById('modal-item-price');
  
  modalItemName.textContent = item.name;
  modalItemDescription.textContent = item.description;
  
  // Render options
  modalItemOptions.innerHTML = '';
  
  if (item.options && item.options.length > 0) {
    item.options.forEach(optionGroup => {
      const groupDiv = document.createElement('div');
      groupDiv.className = 'option-group';
      
      groupDiv.innerHTML = `
        <h4 class="option-group-title">${optionGroup.name}</h4>
        <div class="option-items"></div>
      `;
      
      const optionItems = groupDiv.querySelector('.option-items');
      
      optionGroup.items.forEach(option => {
        const optionItem = document.createElement('div');
        optionItem.className = 'option-item';
        
        // Create unique ID for the input
        const inputId = `option-${optionGroup.name.toLowerCase().replace(/\s+/g, '-')}-${option.name.toLowerCase().replace(/\s+/g, '-')}`;
        
        optionItem.innerHTML = `
          <input type="${optionGroup.type}" id="${inputId}" name="${optionGroup.name.toLowerCase().replace(/\s+/g, '-')}" value="${option.name}" ${optionGroup.type === 'radio' && optionGroup.items.indexOf(option) === 0 ? 'checked' : ''}>
          <label for="${inputId}">${option.name}</label>
          ${option.price > 0 ? `<span class="option-price">+$${option.price.toFixed(2)}</span>` : ''}
        `;
        
        // Set initial selected options for radio buttons
        if (optionGroup.type === 'radio' && optionGroup.items.indexOf(option) === 0) {
          if (!selectedOptions[optionGroup.name]) {
            selectedOptions[optionGroup.name] = [];
          }
          selectedOptions[optionGroup.name] = [option];
        }
        
        const input = optionItem.querySelector('input');
        
        input.addEventListener('change', () => {
          if (optionGroup.type === 'radio') {
            selectedOptions[optionGroup.name] = [option];
          } else {
            if (!selectedOptions[optionGroup.name]) {
              selectedOptions[optionGroup.name] = [];
            }
            
            if (input.checked) {
              selectedOptions[optionGroup.name].push(option);
            } else {
              selectedOptions[optionGroup.name] = selectedOptions[optionGroup.name].filter(opt => opt.name !== option.name);
            }
          }
          
          updateModalPrice();
        });
        
        optionItems.appendChild(optionItem);
      });
      
      modalItemOptions.appendChild(groupDiv);
    });
  }
  
  // Set initial quantity
  document.getElementById('quantity-value').textContent = modalQuantity;
  
  // Calculate and display item price
  updateModalPrice();
  
  // Show modal
  modal.style.display = 'flex';
}

// Update modal quantity
function updateModalQuantity() {
  document.getElementById('quantity-value').textContent = modalQuantity;
  updateModalPrice();
}

// Update modal item price
function updateModalPrice() {
  if (!currentItem) return;
  
  let totalPrice = currentItem.price;
  
  // Add option prices
  for (const group in selectedOptions) {
    selectedOptions[group].forEach(option => {
      if (option.price) {
        totalPrice += option.price;
      }
    });
  }
  
  // Multiply by quantity
  totalPrice *= modalQuantity;
  
  document.getElementById('modal-item-price').textContent = `$${totalPrice.toFixed(2)}`;
}

// Add current item to cart
function addToCart() {
  if (!currentItem) return;
  
  // Create cart item
  const cartItem = {
    id: Date.now(), // Use timestamp as unique ID
    itemId: currentItem.id,
    name: currentItem.name,
    price: currentItem.price,
    image: currentItem.image,
    quantity: modalQuantity,
    options: JSON.parse(JSON.stringify(selectedOptions)), // Deep clone
    totalPrice: parseFloat(document.getElementById('modal-item-price').textContent.replace('$', ''))
  };
  
  // Add to cart
  cart.push(cartItem);
  
  // Update cart count and storage
  updateCartCount();
  saveCartToStorage();
  
  // Close modal
  document.getElementById('customization-modal').style.display = 'none';
  
  // Show notification
  showNotification(`${currentItem.name} added to cart!`);
}

// Show notification
function showNotification(message) {
  // Create notification element if it doesn't exist
  let notification = document.querySelector('.notification');
  
  if (!notification) {
    notification = document.createElement('div');
    notification.className = 'notification';
    document.body.appendChild(notification);
  }
  
  // Set message and show
  notification.textContent = message;
  notification.style.display = 'block';
  notification.style.opacity = '1';
  
  // Hide after 2 seconds
  setTimeout(() => {
    notification.style.opacity = '0';
    setTimeout(() => {
      notification.style.display = 'none';
    }, 300);
  }, 2000);
}