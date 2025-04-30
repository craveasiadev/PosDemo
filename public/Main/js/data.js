// Menu data
const menuData = {
    categories: [
      {
        id: 'burgers',
        name: 'Burgers',
        image: 'https://images.pexels.com/photos/1639557/pexels-photo-1639557.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
      },
      {
        id: 'chicken',
        name: 'Chicken',
        image: 'https://images.pexels.com/photos/6210747/pexels-photo-6210747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
      },
      {
        id: 'sides',
        name: 'Sides',
        image: 'https://images.pexels.com/photos/1583884/pexels-photo-1583884.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
      },
      {
        id: 'drinks',
        name: 'Drinks',
        image: 'https://images.pexels.com/photos/2531184/pexels-photo-2531184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
      },
      {
        id: 'desserts',
        name: 'Desserts',
        image: 'https://images.pexels.com/photos/291528/pexels-photo-291528.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
      }
    ],
    items: [
      // Burgers
      {
        id: 'classic-burger',
        name: 'Classic Burger',
        category: 'burgers',
        price: 5.99,
        description: 'A juicy beef patty with lettuce, tomato, onions, pickles, and our special sauce on a toasted bun.',
        image: 'https://images.pexels.com/photos/1639557/pexels-photo-1639557.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Patty Type',
            type: 'radio',
            required: true,
            items: [
              { name: 'Beef', price: 0 },
              { name: 'Chicken', price: 0 },
              { name: 'Veggie', price: 0 }
            ]
          },
          {
            name: 'Add Extras',
            type: 'checkbox',
            required: false,
            items: [
              { name: 'Cheese', price: 0.99 },
              { name: 'Bacon', price: 1.49 },
              { name: 'Extra Patty', price: 2.49 }
            ]
          }
        ]
      },
      {
        id: 'deluxe-burger',
        name: 'Deluxe Burger',
        category: 'burgers',
        price: 7.99,
        description: 'Double beef patty with cheddar cheese, bacon, lettuce, tomato, and our signature sauce.',
        image: 'https://images.pexels.com/photos/2282532/pexels-photo-2282532.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Patty Type',
            type: 'radio',
            required: true,
            items: [
              { name: 'Beef', price: 0 },
              { name: 'Chicken', price: 0 },
              { name: 'Veggie', price: 0 }
            ]
          },
          {
            name: 'Add Extras',
            type: 'checkbox',
            required: false,
            items: [
              { name: 'Extra Cheese', price: 0.99 },
              { name: 'Extra Bacon', price: 1.49 },
              { name: 'Avocado', price: 1.99 }
            ]
          }
        ]
      },
      {
        id: 'cheeseburger',
        name: 'Cheeseburger',
        category: 'burgers',
        price: 6.49,
        description: 'Classic beef patty with melted American cheese, pickles, onions, and our tangy sauce.',
        image: 'https://images.pexels.com/photos/3738730/pexels-photo-3738730.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Patty Type',
            type: 'radio',
            required: true,
            items: [
              { name: 'Beef', price: 0 },
              { name: 'Chicken', price: 0 },
              { name: 'Veggie', price: 0 }
            ]
          },
          {
            name: 'Cheese Type',
            type: 'radio',
            required: true,
            items: [
              { name: 'American', price: 0 },
              { name: 'Cheddar', price: 0.49 },
              { name: 'Swiss', price: 0.49 }
            ]
          }
        ]
      },
      
      // Chicken
      {
        id: 'crispy-chicken-sandwich',
        name: 'Crispy Chicken Sandwich',
        category: 'chicken',
        price: 6.99,
        description: 'Crispy breaded chicken breast with lettuce, tomato, and mayo on a toasted bun.',
        image: 'https://images.pexels.com/photos/6210747/pexels-photo-6210747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Spice Level',
            type: 'radio',
            required: true,
            items: [
              { name: 'Regular', price: 0 },
              { name: 'Spicy', price: 0.49 },
              { name: 'Extra Spicy', price: 0.99 }
            ]
          },
          {
            name: 'Add Extras',
            type: 'checkbox',
            required: false,
            items: [
              { name: 'Cheese', price: 0.99 },
              { name: 'Bacon', price: 1.49 },
              { name: 'Avocado', price: 1.99 }
            ]
          }
        ]
      },
      {
        id: 'chicken-nuggets',
        name: 'Chicken Nuggets',
        category: 'chicken',
        price: 4.99,
        description: 'Tender chicken nuggets with your choice of dipping sauce.',
        image: 'https://images.pexels.com/photos/60616/fried-chicken-chicken-fried-crunchy-60616.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Size',
            type: 'radio',
            required: true,
            items: [
              { name: '6 pieces', price: 0 },
              { name: '10 pieces', price: 2.99 },
              { name: '20 pieces', price: 5.99 }
            ]
          },
          {
            name: 'Sauce',
            type: 'radio',
            required: true,
            items: [
              { name: 'BBQ', price: 0 },
              { name: 'Ranch', price: 0 },
              { name: 'Honey Mustard', price: 0 },
              { name: 'Sweet & Sour', price: 0 }
            ]
          }
        ]
      },
      
      // Sides
      {
        id: 'french-fries',
        name: 'French Fries',
        category: 'sides',
        price: 2.99,
        description: 'Crispy golden fries seasoned with sea salt.',
        image: 'https://images.pexels.com/photos/1583884/pexels-photo-1583884.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Size',
            type: 'radio',
            required: true,
            items: [
              { name: 'Small', price: 0 },
              { name: 'Medium', price: 1.00 },
              { name: 'Large', price: 1.50 }
            ]
          },
          {
            name: 'Add Seasoning',
            type: 'radio',
            required: false,
            items: [
              { name: 'Regular Salt', price: 0 },
              { name: 'Cajun', price: 0.50 },
              { name: 'Garlic Parmesan', price: 0.50 }
            ]
          }
        ]
      },
      {
        id: 'onion-rings',
        name: 'Onion Rings',
        category: 'sides',
        price: 3.49,
        description: 'Crispy battered onion rings served with dipping sauce.',
        image: 'https://images.pexels.com/photos/1437232/pexels-photo-1437232.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Size',
            type: 'radio',
            required: true,
            items: [
              { name: 'Small', price: 0 },
              { name: 'Medium', price: 1.00 },
              { name: 'Large', price: 1.50 }
            ]
          },
          {
            name: 'Dipping Sauce',
            type: 'radio',
            required: true,
            items: [
              { name: 'Ranch', price: 0 },
              { name: 'BBQ', price: 0 },
              { name: 'Chipotle Mayo', price: 0 }
            ]
          }
        ]
      },
      
      // Drinks
      {
        id: 'soda',
        name: 'Fountain Drink',
        category: 'drinks',
        price: 1.99,
        description: 'Refreshing fountain drink of your choice.',
        image: 'https://images.pexels.com/photos/2531184/pexels-photo-2531184.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Size',
            type: 'radio',
            required: true,
            items: [
              { name: 'Small', price: 0 },
              { name: 'Medium', price: 0.50 },
              { name: 'Large', price: 1.00 }
            ]
          },
          {
            name: 'Flavor',
            type: 'radio',
            required: true,
            items: [
              { name: 'Cola', price: 0 },
              { name: 'Diet Cola', price: 0 },
              { name: 'Lemon-Lime', price: 0 },
              { name: 'Orange', price: 0 },
              { name: 'Root Beer', price: 0 }
            ]
          }
        ]
      },
      {
        id: 'milkshake',
        name: 'Milkshake',
        category: 'drinks',
        price: 3.99,
        description: 'Creamy milkshake topped with whipped cream.',
        image: 'https://images.pexels.com/photos/3727250/pexels-photo-3727250.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Size',
            type: 'radio',
            required: true,
            items: [
              { name: 'Small', price: 0 },
              { name: 'Medium', price: 1.00 },
              { name: 'Large', price: 1.50 }
            ]
          },
          {
            name: 'Flavor',
            type: 'radio',
            required: true,
            items: [
              { name: 'Chocolate', price: 0 },
              { name: 'Vanilla', price: 0 },
              { name: 'Strawberry', price: 0 },
              { name: 'Cookies & Cream', price: 0.50 }
            ]
          }
        ]
      },
      
      // Desserts
      {
        id: 'ice-cream',
        name: 'Ice Cream Cone',
        category: 'desserts',
        price: 2.49,
        description: 'Soft serve ice cream in a crispy cone.',
        image: 'https://images.pexels.com/photos/1352281/pexels-photo-1352281.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Flavor',
            type: 'radio',
            required: true,
            items: [
              { name: 'Vanilla', price: 0 },
              { name: 'Chocolate', price: 0 },
              { name: 'Twist', price: 0 }
            ]
          },
          {
            name: 'Toppings',
            type: 'checkbox',
            required: false,
            items: [
              { name: 'Sprinkles', price: 0.50 },
              { name: 'Chocolate Dip', price: 0.75 },
              { name: 'Caramel', price: 0.50 }
            ]
          }
        ]
      },
      {
        id: 'apple-pie',
        name: 'Apple Pie',
        category: 'desserts',
        price: 2.99,
        description: 'Warm apple pie with a flaky crust.',
        image: 'https://images.pexels.com/photos/291528/pexels-photo-291528.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        options: [
          {
            name: 'Serving Option',
            type: 'radio',
            required: true,
            items: [
              { name: 'Regular', price: 0 },
              { name: 'À la Mode (with ice cream)', price: 1.49 }
            ]
          }
        ]
      }
    ]
  };