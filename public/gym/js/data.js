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
    id: 'day-pass',
    name: 'Day Pass (Non-Members)',
    price: 10.00,
    description: 'Daily Pass Entry',
    image: '/images/fitness6.png'
  },
  {
    id: 'membership',
    name: 'Membership Register (UNlimited Package)',
    price: 175.00,
    description: 'Apply for membership and get benefits',
    image: '/images/fitness1.png'
  },
  {
    id: 'trainer',
    name: 'Trainer Andrew (Book a Session)',
    price: 80.00,
    description: 'This trainer is a trained professional with certified fitness trainer certificate',
    image: '/images/fitness5.png'
  },
  {
    id: 'yoga',
    name: 'Basic Yoga Class (Book a Session)',
    price: 45.00,
    description: 'Yoga class session with certified trained trainer from famous fitness center',
    image: '/images/fitness4.png'
  },
  {
    id: 'combat',
    name: 'Body Combat Class (Book a Session)',
    price: 75.00,
    description: 'Extreme and hyped combat class to defend yourself',
    image: '/images/fitness2.png'
  },
  {
    id: 'hitt',
    name: 'HITT Class (Book a Session)',
    price: 35.00,
    description: 'This class is to train your weightlifting and muscle development',
    image: '/images/fitness3.png'
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
      id: 'trainer',
      name: 'Trainer Andrew (Book a Session)',
      price: 80.00,
      description: 'This trainer is a trained professional with certified fitness trainer certificate',
      image: '/images/fitness5.png'
    },
    {
    id: 'yoga',
    name: 'Basic Yoga Class (Book a Session)',
    price: 45.00,
    description: 'Yoga class session with certified trained trainer from famous fitness center',
    image: '/images/fitness4.png'
  },
  {
    id: 'combat',
    name: 'Body Combat Class (Book a Session)',
    price: 75.00,
    description: 'Extreme and hyped combat class to defend yourself',
    image: '/images/fitness2.png'
  },
  ];