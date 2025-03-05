<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <a class="text-gray-600 hover:text-gray-800 font-semibold transition duration-200 ml-4 mt-4 inline-block" href="home.php">← back</a>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- User Information and Shipping -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">User Information</h2>
                    <div id="user-info">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>


            <!-- Cart Items and Checkout -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div id="cart-items">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
                
                <button id="place-order" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                    Place Order
                </button>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    // Get checkout data
    const checkoutData = JSON.parse(localStorage.getItem('checkoutItems'));
    if (!checkoutData) {
        window.location.href = 'home.php';
        return;
    }

    // Display order items
    const cartItemsDiv = document.getElementById('cart-items');
    let itemsHTML = '<ul class="space-y-4">';
    
    checkoutData.items.forEach(item => {
        const itemTotal = parseFloat(item.price) * item.quantity;
        itemsHTML += `
            <li class="flex justify-between">
                <div class="flex items-center">
                    <img src="${item.image}" alt="${item.product}" class="w-16 h-16 object-cover mr-4">
                    <span>${item.product} x ${item.quantity}</span>
                </div>
                <span>P${itemTotal.toFixed(2)}</span>
            </li>
        `;
    });

    itemsHTML += `
        <li class="flex justify-between font-bold pt-4 border-t">
            <span>Total:</span>
            <span>P${checkoutData.total.toFixed(2)}</span>
        </li>
    </ul>`;
    
    cartItemsDiv.innerHTML = itemsHTML;

    // Display user information
    const userInfoDiv = document.getElementById('user-info');
    userInfoDiv.innerHTML = `
        <div class="mb-4">
            <p class="text-gray-600">Username</p>
            <p class="font-semibold">${checkoutData.user.username}</p>
        </div>
        <div class="mb-4">
            <p class="text-gray-600">Email</p>
            <p class="font-semibold">${checkoutData.user.email}</p>
        </div>
    `;

   // Update the place-order event listener
document.getElementById('place-order').addEventListener('click', function() {
    // Save order to purchase history
    const purchaseHistory = JSON.parse(localStorage.getItem('purchaseHistory')) || [];
    const customerPurchases = JSON.parse(localStorage.getItem('customerPurchases')) || [];
    
    // Add current date to checkout data
    checkoutData.date = new Date().toISOString().split('T')[0];
    checkoutData.status = 'Order Successful';

    // Update inventory
    const inventory = JSON.parse(localStorage.getItem('inventory')) || {};
    checkoutData.items.forEach(item => {
        if (inventory[item.product]) {
            inventory[item.product].stock -= item.quantity;
            if (inventory[item.product].stock < 0) {
                inventory[item.product].stock = 0;
            }
        }
    });

    // Save updated inventory
    localStorage.setItem('inventory', JSON.stringify(inventory));

    // Save to purchase histories
    purchaseHistory.push(checkoutData);
    customerPurchases.push({
        customer: {
            name: checkoutData.user.username,
            email: checkoutData.user.email
        },
        items: checkoutData.items,
        date: checkoutData.date,
        total: checkoutData.total,
        status: checkoutData.status
    });

    localStorage.setItem('purchaseHistory', JSON.stringify(purchaseHistory));
    localStorage.setItem('customerPurchases', JSON.stringify(customerPurchases));

    // Clear checkout and cart data
    localStorage.removeItem('checkoutItems');
    localStorage.removeItem('cartItems');

    // Show success message and redirect
    alert('Order placed successfully!');
    window.location.href = 'checkout.php';
});
});
    </script>
</body>
</html>