// Mock data for the kiosk application
const categories = {
    'food-beverages': {
      name: 'Food & Beverages',
      subcategories: {
        'burgers': { name: 'Burgers' },
        'sides': { name: 'Sides & Snacks' },
        'beverages': { name: 'Beverages' },
      }
    },
    'services': {
      name: 'Services',
      subcategories: {
        'mccafe': { name: 'McCafé' },
        'delivery': { name: 'Delivery' },
        'wifi': { name: 'Free WiFi' }
      }
    },
    'items': {
      name: 'Items',
      subcategories: {
        'family-bundles': { name: 'Family Bundles' },
        'limited-time': { name: 'Limited Time' }
      }
    }
  };
  
  // Menu items data
  const menuItems = {
    'burgers': [
  {
    id: 'big-mac',
    name: 'Big Mac',
    price: 5.99,
    description: 'Iconic burger with special sauce, lettuce, cheese, pickles, onions on a sesame seed bun.',
    image: '/images/bigmacs.jpg'
  },
  {
    id: 'quarter-pounder',
    name: 'Quarter Pounder',
    price: 6.49,
    description: 'Fresh beef patty, onions, pickles, ketchup, and mustard on a sesame seed bun.',
    image: '/images/hamburger.jpg'
  },
  {
    id: 'cheeseburger',
    name: 'Cheeseburger',
    price: 3.99,
    description: 'Classic beef patty with cheese, onions, pickles, ketchup, and mustard.',
    image: '/images/chees.jpg'
  },
  {
    id: 'double-cheeseburger',
    name: 'Double Cheeseburger',
    price: 4.99,
    description: 'Two beef patties with melted cheese, pickles, onions, ketchup, and mustard.',
    image: '/images/chees.jpg'
  },
  {
    id: 'bacon-quarter-pounder',
    name: 'Bacon Quarter Pounder',
    price: 6.99,
    description: 'Quarter pound beef patty with crispy bacon, cheese, and condiments on a toasted bun.',
    image: '/images/bigmacs.jpg'
  },
  {
    id: 'spicy-chicken-burger',
    name: 'Spicy Chicken Burger',
    price: 5.49,
    description: 'Crispy chicken fillet with spicy sauce, lettuce, and pickles on a toasted bun.',
    image: '/images/spicychicken.jpg'
  },
  {
    id: 'veggie-delight',
    name: 'Veggie Delight',
    price: 4.49,
    description: 'Grilled plant-based patty with lettuce, tomato, onions, and vegan mayo.',
    image: '/images/veggieburger.jpg'
  },
  {
    id: 'fish-fillet-burger',
    name: 'Fish Fillet Burger',
    price: 5.29,
    description: 'Crispy fish fillet with tartar sauce and lettuce on a steamed bun.',
    image: '/images/bigmacs.jpg'
  },
  {
    id: 'mushroom-swiss-burger',
    name: 'Mushroom Swiss Burger',
    price: 6.29,
    description: 'Juicy beef patty with sautéed mushrooms and Swiss cheese.',
    image: '/images/bigmacs.jpg'
  },
  
],
    'sides': [
      {
        id: 'french-fries',
        name: 'French Fries',
        price: 2.49,
        description: 'Golden, crispy fries with just the right amount of salt.',
        image: '/images/frees.jpg'
      },
      {
        id: 'apple-slices',
        name: 'Apple Slices',
        price: 1.99,
        description: 'Fresh, crisp apple slices - a healthier option.',
        image: '/images/applee.jpg'
      }
    ],
    'beverages': [
      {
        id: 'coke',
        name: 'Coca-Cola',
        price: 1.99,
        description: 'Refreshing Coca-Cola served with ice.',
        image: '/images/colaa.jpg'
      },
      {
        id: 'shake',
        name: 'Milkshake',
        price: 3.29,
        description: 'Creamy milkshake in chocolate, vanilla, or strawberry.',
        image: '/images/milky.jpg'
      }
    ],
    'family-bundles': [
      {
        id: 'family-bundle-1',
        name: 'Family Bundle',
        price: 22.99,
        description: '2 Big Macs, 2 Cheeseburgers, 4 small fries, and 4 small drinks.',
        image: '/images/hamburger.jpg'
      }
    ],
    'limited-time': [
      {
        id: 'signature-burger',
        name: 'Signature Burger',
        price: 7.99,
        description: 'Limited time specialty burger with premium ingredients.',
        image: '/images/hamburger.jpg'
      }
    ],
    'haircut': [
      {
        id: 'Normal Cut',
        name: 'Normal Cut',
        price: 3.99,
        description: 'Normal usual cut',
        image: '/images/haircut.jpg'
      },
      {
        id: 'Relaxing',
        name: 'Relaxing',
        price: 2.99,
        description: 'Relaxing cut',
        image: '/images/relaxing.jpg'
      }
    ],
    'delivery': [
      {
        id: 'delivery-info',
        name: 'Delivery Service',
        price: 0,
        description: 'Information about our delivery service options.',
        image: 'https://images.pexels.com/photos/7363099/pexels-photo-7363099.jpeg'
      }
    ],
    'wifi': [
      {
        id: 'wifi-info',
        name: 'Free WiFi',
        price: 0,
        description: 'Information about our free WiFi service.',
        image: 'https://images.pexels.com/photos/4050291/pexels-photo-4050291.jpeg'
      }
    ]
  };
  
  // Upsell items
  const upsellItems = [
    {
      id: 'upsell-fries',
      name: 'Upgrade to Large Fries',
      price: 1.50,
      image: '/images/frees.jpg'
    },
    {
      id: 'upsell-drink',
      name: 'Upgrade to Large Drink',
      price: 1.00,
      image: '/images/colaa.jpg'
    },
    // {
    //   id: 'upsell-apple-pie',
    //   name: 'Add Apple Pie',
    //   price: 1.99,
    //   image: '/images/applee.jpg'
    // },
    {
      id: 'upsell-ice-cream',
      name: 'Add Soft Serve',
      price: 1.49,
      image: '/images/milky.jpg'
    }
  ];