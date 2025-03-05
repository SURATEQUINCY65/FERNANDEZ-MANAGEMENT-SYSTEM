<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Online Optical Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        /* Modal Styles */
        .modal {
            display: flex;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

       /* Add these styles to your existing <style> section */
.modal-content {
    position: relative;
    background-color: #ffffff;
    margin: 0% auto;
    padding: 0px;
    border-radius: 15px;
    box-shadow: 0 40px 60px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 90%;
}

.close-confirmation {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #666;
}

.close-confirmation:hover {
    color: #000;
}

#confirmQuantity {
    -moz-appearance: textfield;
}

#confirmQuantity::-webkit-outer-spin-button,
#confirmQuantity::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
    </style>
</head>
<body class="font-roboto bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <img src="image/doc4.jpg.png" alt="Site Logo" class="logo" style="width: 79px; height: 79px;">
            <a class="text-4xl font-bold text-gray-900" href="#">OPTICAL SHOP ONLINE</a>
            <div class="space-x-4 flex items-center">
            <div class="space-x-4 flex items-center">
                <a class="nav-link text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="http://localhost/clinic-website-template/index.php">Home</a>
                <a class="nav-link text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="#" id="cartLink">Cart (0)</a>
                <a class="nav-link text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="notify.php" id="notificationLink">Notifications (0)</a>
                <a class="nav-link text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="userlog.php">
                </a>
                <div class="relative">
    <img id="profileButton"
         alt="Avatar" 
         style="width:40px"
         class="cursor-pointer rounded-full"
         onclick="toggleMobileMenu()"
         src="https://cdn.vectorstock.com/i/1000v/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.jpg">
    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
        <div class="px-4 py-2 text-sm text-gray-700 border-b">
            <span id="userFullName">User </span>
        </div>
        <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
        <a href="settings.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
        <a href="checkout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Order History</a>
        <a href="status.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Order status</a>
        <hr class="my-1">
        <a href="userlog.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Sign Out</a>
    </div>
</div>


<script>
// Add click handler for sign out link
document.querySelector('a[href="userlog.php"]').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent immediate redirect
    
    // Clear all user-related data
    localStorage.removeItem('currentUser');
    localStorage.removeItem('loggedInUser');
    localStorage.removeItem('cartItems');
    localStorage.removeItem('checkoutItems');
    
    // Redirect to login page
    window.location.href = 'userlog.php';
});
</script>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden'); // Toggle the visibility of the mobile menu
}
</script>
        </div>
    </nav>

    <script>
        // Function to update the notification count display
        function updateNotificationCount() {
            const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
            const notificationCount = notifications.length;
            document.getElementById('notificationLink').innerText = `Notifications (${notificationCount})`;
        }

        // Load existing notifications count on page load
        updateNotificationCount();
    </script>

    <!-- Add this right after the navbar -->
    <script>
    // Function to update profile image in navigation
    function updateNavProfileImage() {
        const currentUser = JSON.parse(localStorage.getItem('loggedInUser'));
        if (currentUser && currentUser.profileImage) {
            document.getElementById('profileButton').src = currentUser.profileImage;
        }
    }

    // Listen for profile image updates
    window.addEventListener('profileImageUpdated', function(event) {
        if (event.detail && event.detail.image) {
            document.getElementById('profileButton').src = event.detail.image;
        }
    });

    // Update profile image on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateNavProfileImage();
    });

    // Check for profile image updates periodically
    setInterval(updateNavProfileImage, 1000);
    </script>

    <script>
    // Add this to your existing script
    function updateProfileDisplay() {
        const userData = JSON.parse(localStorage.getItem('loggedInUser'));
        if (userData) {
            // Update profile image
            if (userData.profileImage) {
                document.getElementById('profileButton').src = userData.profileImage;
            }
            
            // Update user name in menu
            if (userData.firstName || userData.lastName) {
                document.getElementById('userFullName').textContent = 
                    `${userData.firstName || ''} ${userData.lastName || ''}`.trim();
            }
        }
    }

    // Update profile when page loads
    document.addEventListener('DOMContentLoaded', updateProfileDisplay);

    // Listen for profile updates
    window.addEventListener('profileUpdated', updateProfileDisplay);

    // Check for updates periodically
    setInterval(updateProfileDisplay, 1000);
    </script>

    <script>
    // Function to update user display in navigation
    function updateUserDisplay() {
        const userData = JSON.parse(localStorage.getItem('loggedInUser'));
        if (userData) {
            // Update profile image
            if (userData.profileImage) {
                document.getElementById('profileButton').src = userData.profileImage;
            }
            
            // Update username display
            const fullName = `${userData.firstName || ''} ${userData.lastName || ''}`.trim();
            document.getElementById('userFullName').textContent = fullName || userData.username;
        }
    }

    // Listen for profile updates
    window.addEventListener('userDataUpdated', updateUserDisplay);
    window.addEventListener('profileImageUpdated', function(e) {
        document.getElementById('profileButton').src = e.detail.image;
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', updateUserDisplay);
    </script>

    <!-- Hero Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Find Your Perfect Eyewear</h1>
                <p class="text-gray-600 mb-6">Browse our wide selection of eyewear and schedule an appointment with our opticians. We are accepting payment by walking only, please visit our clinic.</p>
                <a class="bg-blue-500 text-white px-4 py-2 rounded" href="#">Shop Now</a>
            </div>
            <div class="md:w-1/2 mt-6 md:mt-0">
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of sleek aviator sunglasses" class="w-full mb-4 rounded" src="image/beryllium.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Beryllium</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P1,800</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Beryllium" data-price="P1800" data-image="image/beryllium.jpg">Add to Cart</button>
                </div>
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of modern round glasses" class="w-full mb-4 rounded" src="image/celebrity lenses.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Celebrity Lenses</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P1,800</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Celebrity Lenses" data-price="P1800" data-image="image/celebrity lenses.jpg">Add to Cart</button>
                </div>
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of sleek aviator sunglasses" class="w-full mb-4 rounded" src="image/excellence.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Excellence</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P800</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Excellence" data-price="P800" data-image="image/excellence.jpg">Add to Cart</button>
                </div>
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of stylish cat eye glasses" class="w-full mb-4 rounded" src="image/Hypoallergenic.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Hypoallergenic</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P1,800</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Hypoallergenic" data-price="P159.99" data-image="image/Hypoallergenic.jpg">Add to Cart</button>
                </div>
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of blue light blocking glasses" class="w-full mb-4 rounded" src="image/kenzie.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Kenzie</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P700</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Kenzie" data-price="P700" data-image="image/kenzie.jpg">Add to Cart</button>
                </div>
                <div class="bg-white p-4 rounded shadow-md">
                    <img alt="A pair of sports sunglasses" class="w-full mb-4 rounded" src="image/memory titanium.jpg" />
                    <h3 class="text-xl font-bold text-gray-800">Memory Titanium</h3>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="text-gray-600 mb-4">P1,800</p>
                    <input type="number" min="1" value="1" class="quantity-input border rounded w-16 mb-2" />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded add-to-cart" data-product="Memory Titanium" data-price="P1800" data-image="image/memory titanium.jpg">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

<!-- Modal Structure for Cart -->
<div id="cartModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-cart">&times;</span>
        <h2 class="text-center text-2xl font-bold mb-4">Your Cart</h2>
        <p id="totalItems" class="font-bold text-center mb-2"></p> <!-- Total Items Display -->
        <p id="totalValue" class="font-bold text-center mb-4"></p> <!-- Total Value Display -->
        <ul id="cartItems" class="mb-4 list-disc list-inside"></ul> <!-- List of Cart Items -->
        <div class="flex justify-between">
            <button id="checkout" class="bg-green-500 text-white px-4 py-2 rounded w-1/2 mr-2">Checkout</button>
            <button id="closeCart" class="bg-red-500 text-white px-4 py-2 rounded w-1/2">Close</button>
        </div>
    </div>
</div>
<!-- Add Product Confirmation Modal -->
<div id="addToCartModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-confirmation">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Add to Cart</h2>
        <div class="flex items-center mb-4">
            <img id="confirmProductImage" src="" alt="Product" class="w-24 h-24 object-cover rounded mr-4">
            <div>
                <h3 id="confirmProductName" class="text-xl font-semibold"></h3>
                <p id="confirmProductPrice" class="text-gray-600"></p>
                <div class="flex items-center mt-2">
                    <label class="mr-2">Quantity:</label>
                    <input type="number" id="confirmQuantity" min="1" value="1" 
                           class="border rounded px-2 py-1 w-20">
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-2">
            <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" 
                    onclick="closeConfirmationModal()">Cancel</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" 
                    onclick="confirmAddToCart()">Add to Cart</button>
        </div>
    </div>
</div>

<script>
// Add these functions to your existing script section
let currentProduct = null;

function showConfirmationModal(product, price, image) {
    currentProduct = {
        product: product,
        price: price,
        image: image
    };

    // Update modal content
    document.getElementById('confirmProductImage').src = image;
    document.getElementById('confirmProductName').textContent = product;
    document.getElementById('confirmProductPrice').textContent = `P${price}`;
    document.getElementById('confirmQuantity').value = 1;

    // Show modal
    document.getElementById('addToCartModal').classList.remove('hidden');
}

function closeConfirmationModal() {
    document.getElementById('addToCartModal').classList.add('hidden');
    currentProduct = null;
}

function confirmAddToCart() {
    if (currentProduct) {
        const quantity = parseInt(document.getElementById('confirmQuantity').value);
        if (quantity > 0) {
            addToCart(
                currentProduct.product,
                currentProduct.price,
                currentProduct.image,
                quantity
            );
            closeConfirmationModal();
        }
    }
}

// Update your existing add-to-cart button listeners
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const product = this.getAttribute('data-product');
        const price = this.getAttribute('data-price').replace('P', '');
        const image = this.getAttribute('data-image');
        
        // Show confirmation modal instead of adding directly
        showConfirmationModal(product, price, image);
    });
});

// Add event listener for closing modal with escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeConfirmationModal();
    }
});

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('addToCartModal');
    if (event.target === modal) {
        closeConfirmationModal();
    }
});
</script>

<!-- Modal Structure for Checkout Confirmation -->
<div id="checkoutConfirmationModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-checkout-confirmation">&times;</span>
        <h2 class="text-center text-2xl font-bold mb-4">Confirm Checkout</h2>
        <p class="mb-4">Are you sure you want to check out the items in your cart?</p>
        <div class="flex justify-between">
            <button id="confirmCheckout" class="bg-green-500 text-white px-4 py-2 rounded w-1/2 mr-2">Yes, Checkout</button>
            <button class="close-checkout-confirmation bg-red-500 text-white px-4 py-2 rounded w-1/2">Cancel</button>
        </div>
    </div>
</div>
  <!-- Modal Structure for Checkout Success -->
<div id="checkoutSuccessModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-checkout-success">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Checkout Successful!</h2>
        <p class="mb-6">Thank you for your purchase. Your order has been placed successfully.</p>
        <div class="flex justify-center">
            <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600" onclick="closeCheckoutSuccessModal()">Close</button>
        </div>
    </div>
</div>
<script>
   // Update the confirm checkout handler
document.getElementById('confirmCheckout').addEventListener('click', function() {
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    
    if (!loggedInUser) {
        alert('Please log in first');
        window.location.href = 'userlog.php';
        return;
    }

    // Store cart items for checkout page
    localStorage.setItem('checkoutItems', JSON.stringify({
        items: cartItems,
        total: calculateTotal(cartItems),
        date: new Date().toISOString(),
        user: loggedInUser,
        status: 'Pending'
    }));

    // Redirect to checkout page
    window.location.href = 'checkout.php';
});

// Helper function to calculate total
function calculateTotal(items) {
    return items.reduce((acc, item) => {
        const price = parseFloat(item.price.toString().replace(/[^0-9.]/g, ''));
        return acc + (price * item.quantity);
    }, 0);
}

// Update cart display function
function displayCart() {
    const cartList = document.getElementById('cartItems');
    cartList.innerHTML = '';
    
    if (cartItems.length === 0) {
        cartList.innerHTML = '<p class="text-center py-4">Your cart is empty</p>';
        document.getElementById('checkout').disabled = true;
        document.getElementById('checkout').classList.add('opacity-50', 'cursor-not-allowed');
        return;
    }

    document.getElementById('checkout').disabled = false;
    document.getElementById('checkout').classList.remove('opacity-50', 'cursor-not-allowed');
    
    let total = 0;
    cartItems.forEach((item, index) => {
        const li = document.createElement('div');
        li.className = 'flex justify-between items-center p-2 border-b';
        const itemTotal = parseFloat(item.price) * item.quantity;
        total += itemTotal;
        
        li.innerHTML = `
            <div class="flex items-center">
                <img src="${item.image}" alt="${item.product}" class="w-16 h-16 object-cover mr-4">
                <div>
                    <h3 class="font-bold">${item.product}</h3>
                    <p>P${item.price} x ${item.quantity} = P${itemTotal.toFixed(2)}</p>
                </div>
            </div>
            <button class="delete-item bg-red-500 text-white px-2 py-1 rounded" 
                    onclick="removeFromCart(${index})">
                Remove
            </button>
        `;
        cartList.appendChild(li);
    });

    // Update total display
    document.getElementById('totalValue').innerText = `Total: P${total.toFixed(2)}`;
}

</script>

<script>
let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

function updateCartCount() {
    const cartCount = cartItems.reduce((acc, item) => acc + item.quantity, 0);
    const totalValue = cartItems.reduce((acc, item) => acc + (parseFloat(item.price) * item.quantity), 0);
    document.getElementById('cartLink').innerText = `Cart (${cartCount})`;
    document.getElementById('totalItems').innerText = `Total Items: ${cartCount}`;
    document.getElementById('totalValue').innerText = `Total Value: P${totalValue.toFixed(2)}`;
}

function addToCart(product, price, image, quantity) {
    const existingItem = cartItems.find(item => item.product === product);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cartItems.push({
            product,
            price: parseFloat(price),
            image,
            quantity
        });
    }
    
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateCartCount();
    showConfirmationModal(product, price, quantity, image);
}

// Update Add to Cart button listeners
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const product = this.getAttribute('data-product');
        const price = this.getAttribute('data-price').replace('P', '');
        const image = this.getAttribute('data-image');
        const quantity = parseInt(this.previousElementSibling.value);
        
        addToCart(product, price, image, quantity);
    });
});

// Update cart display
function displayCart() {
    const cartList = document.getElementById('cartItems');
    cartList.innerHTML = '';
    
    cartItems.forEach((item, index) => {
        const li = document.createElement('div');
        li.className = 'flex justify-between items-center p-2 border-b';
        li.innerHTML = `
            <div class="flex items-center">
                <img src="${item.image}" alt="${item.product}" class="w-16 h-16 object-cover mr-4">
                <div>
                    <h3 class="font-bold">${item.product}</h3>
                    <p>P${item.price} x ${item.quantity}</p>
                </div>
            </div>
            <button class="delete-item bg-red-500 text-white px-2 py-1 rounded" 
                    onclick="removeFromCart(${index})">
                Remove
            </button>
        `;
        cartList.appendChild(li);
    });
}

function removeFromCart(index) {
    cartItems.splice(index, 1);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateCartCount();
    displayCart();
}

// Cart link click handler
document.getElementById('cartLink').addEventListener('click', function(e) {
    e.preventDefault();
    displayCart();
    document.getElementById('cartModal').classList.remove('hidden');
});

// Checkout process
document.getElementById('checkout').addEventListener('click', function() {
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    
    if (!loggedInUser) {
        alert('Please log in to proceed with checkout');
        window.location.href = 'userlog.php';
        return;
    }
    
    if (cartItems.length === 0) {
        alert('Your cart is empty');
        return;
    }
    
    document.getElementById('checkoutConfirmationModal').classList.remove('hidden');
});

// Update the confirm checkout handler
document.getElementById('confirmCheckout').addEventListener('click', function() {
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    
    if (!loggedInUser) {
        alert('Please log in first');
        window.location.href = 'userlog.php';
        return;
    }

    const purchase = {
        items: cartItems,
        date: new Date().toISOString(),
        total: cartItems.reduce((acc, item) => acc + (parseFloat(item.price.replace('P', '')) * item.quantity), 0),
        user: loggedInUser.username,
        status: 'Pending'
    };
    
    // Save purchase history
    const purchaseHistory = JSON.parse(localStorage.getItem('purchaseHistory')) || [];
    purchaseHistory.push(purchase);
    localStorage.setItem('purchaseHistory', JSON.stringify(purchaseHistory));
    
    // Clear cart
    localStorage.removeItem('cartItems');
    cartItems = [];
    updateCartCount();
    
    // Redirect to checkout page
    window.location.href = 'checkout.php';
});

// Initialize cart count on page load
updateCartCount();
</script>
   <!-- Appointment Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb- 6">Schedule an Appointment</h2>
        <form id="appointment-form" class="bg-gray-100 p-6 rounded shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700" for="name">Name</label>
                <input class="w-full px-4 py-2 border rounded" id="name" name="name" required type="text"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="email">Email</label>
                <input class="w-full px-4 py-2 border rounded" id="email" name="email" required type="email"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="date">Preferred Date</label>
                <input class="w-full px-4 py-2 border rounded" id="date" name="date" required type="date"/>
                <span id="dateError" class="text-red-500 hidden">You cannot select a past date or Sunday.</span>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const dateInput = document.getElementById('date');
                    
                    // Set minimum date to today
                    const today = new Date().toISOString().split('T')[0];
                    dateInput.setAttribute('min', today);
                    
                    // Disable Sundays and check for existing appointments
                    dateInput.addEventListener('input', function(e) {
                        const selectedDate = new Date(this.value);
                        const day = selectedDate.getDay();
                        
                        // Check if selected day is Sunday (0)
                        if (day === 0) {
                            document.getElementById('dateError').textContent = 'Appointments are not available on Sundays';
                            document.getElementById('dateError').classList.remove('hidden');
                            this.value = '';
                            return;
                        }
                        
                        document.getElementById('dateError').classList.add('hidden');
                    });
                });

                // Function to check if appointment exists
                function isAppointmentAvailable(date, time) {
                    const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
                    return !appointments.some(apt => 
                        apt.date === date && apt.time === time
                    );
                }

                // Modify the time select event listener
                document.getElementById('time').addEventListener('change', function() {
                    const selectedTime = this.value;
                    const selectedDate = document.getElementById('date').value;
                    const errorMessage = document.getElementById('error-message');

                    if (!isAppointmentAvailable(selectedDate, selectedTime)) {
                        errorMessage.textContent = 'This time slot is already booked. Please select another time.';
                        errorMessage.classList.remove('hidden');
                        this.value = ''; // Reset the time selection
                    } else {
                        errorMessage.classList.add('hidden');
                    }
                });

                // Modify the form submission handler
                document.getElementById('appointment-form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    const selectedDate = document.getElementById('date').value;
                    const selectedTime = document.getElementById('time').value;
                    
                    if (!isAppointmentAvailable(selectedDate, selectedTime)) {
                        alert('This appointment slot is no longer available. Please select a different time.');
                        return;
                    }

                    // Rest of your existing form submission code
                    // ...existing code...
                });
            </script>
            <div class="mb-4">
                <label class="block text-gray-700" for="time">Preferred Time</label>
                <select id="time" name="time" class="w-full px-4 py-2 border rounded" required>
                    <option value="">Select a time</option>
                    <option value="10:30">10:30 AM</option>
                    <option value="10:45">10:45 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="11:20">11:20 PM</option>
                    <option value="13:30">01:30 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                </select>
                <span id="error-message" class="text-red-500 hidden">This time is already scheduled. Please choose another time.</span>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Schedule Appointment</button>
        </form>
    </div>
</section>

    <!-- Modal Structure for Appointment Submission Success -->
<div id="appointmentModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-appointment">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Appointment Submitted Successfully!</h2>
        <p class="mb-6">Your appointment has been scheduled.</p>
        <div class="flex justify-center">
            <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600" 
                    onclick="closeAppointmentModal()">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    // Handle form submission
    document.getElementById('appointment-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;

        // Create an appointment object
        const appointment = {
            name: name,
            email: email,
            date: date,
            time: time,
            status: 'Pending'
        };

        // Get existing appointments from local storage
        const appointments = JSON.parse(localStorage.getItem('appointments')) || [];

        // Add the new appointment to the list
        appointments.push(appointment);

        // Save the updated appointments list back to local storage
        localStorage.setItem('appointments', JSON.stringify(appointments));

        // Create a notification object
        const notification = {
            message: `New appointment scheduled for ${name} on ${date} at ${time}.`,
            date: new Date().toLocaleString()
        };

        // Get existing notifications from local storage
        const notifications = JSON.parse(localStorage.getItem('notifications')) || [];

        // Add the new notification to the list
        notifications.push(notification);

        // Save the updated notifications list back to local storage
        localStorage.setItem('notifications', JSON.stringify(notifications));

        // Clear the form fields
        document.getElementById('appointment-form').reset();

        // Show the appointment submission success modal
        document.getElementById('appointmentModal').classList.remove('hidden');
    });

     // Close cart modal
      document.getElementById('closeCart').addEventListener('click', function() {
       document.getElementById('cartModal').classList.add('hidden');
 });

    // Example of already scheduled times
    const scheduledTimes = ["09:00", "10:00"]; // Replace with actual scheduled times

    document.getElementById('time').addEventListener('change', function() {
        const selectedTime = this.value;
        const errorMessage = document.getElementById('error-message');

        if (scheduledTimes.includes(selectedTime)) {
            errorMessage.classList.remove('hidden');
            this.setCustomValidity('This time is already scheduled. Please choose another time.');
        } else {
            errorMessage.classList.add('hidden');
            this.setCustomValidity(''); // Clear the custom validity message
        }
    });

    // Add this to your existing script
    function closeAppointmentModal() {
        document.getElementById('appointmentModal').classList.add('hidden');
    }

    // Update the appointment submission handler
    document.getElementById('appointment-form').addEventListener('submit', function(event) {
        // ...existing appointment submission code...

        // Show the modal
        document.getElementById('appointmentModal').classList.remove('hidden');

        // Add click handler for the close icon
        document.querySelector('.close-appointment').addEventListener('click', closeAppointmentModal);
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('appointmentModal');
        if (event.target === modal) {
            closeAppointmentModal();
        }
    });

    // Add keyboard support for closing
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAppointmentModal();
        }
    });
</script>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto px-4 text-center">
        <p></p>
    </div>
</footer>
            <p></p>
        </div>
    </footer>
</body>
</html>