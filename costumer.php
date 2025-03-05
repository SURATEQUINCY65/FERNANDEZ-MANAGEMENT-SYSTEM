<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Customer Purchase History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center"> 
            <a class="text-2xl font-bold text-gray-800" href="#"></a>
            
        </div>
    </nav>
   <!-- Customer Purchase History Section -->
<section div class="py-12">
        <div class="container mx-auto px-4">
        <a class="text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="admin.php">← back</a>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">COSTUMER ORDER STATUS</h2>
            <input type="text" id="searchBar" placeholder="Search by product name..." class="border rounded px-4 py-2 mb-4 w-full"/>
            <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="window.location.href='archived_purchases.php'">View Archived Purchases</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded mb-4" onclick="archiveSelected()">Archive Selected</button>
            <div class="bg-white p-6 rounded shadow-md">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Select</th>
                            <th class="px-4 py-2 text-left text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left text-gray-600">Email</th>
                            <th class="px-4 py-2 text-left text-gray-600">Items</th>
                            <th class="px-4 py-2 text-left text-gray-600">Total Value</th> <!-- New Column -->
                            <th class="px-4 py-2 text-left text-gray-600">Date</th>
                            <th class="px-4 py-2 text-left text-gray-600">Status</th>
                            <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseHistoryBody">
                        <!-- Purchase history will be populated here -->
                    </tbody>
                </table>
            </div>
            <script>

              // Update the renderPurchaseHistory function
function renderPurchaseHistory(filteredPurchases) {
    const purchaseHistoryBody = document.getElementById('purchaseHistoryBody');
    purchaseHistoryBody.innerHTML = '';

    filteredPurchases.forEach((purchase, index) => {
        const items = purchase.items.map(item => 
            `${item.product} (${item.quantity}x) - P${parseFloat(item.price).toFixed(2)}`
        ).join('<br>');

        const totalValue = purchase.total ? purchase.total.toFixed(2) : 
            purchase.items.reduce((acc, item) => acc + (parseFloat(item.price) * item.quantity), 0).toFixed(2);

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="border px-4 py-2">
                <input type="checkbox" class="purchase-checkbox" data-index="${index}">
            </td>
            <td class="border px-4 py-2">${purchase.customer.name}</td>
            <td class="border px-4 py-2">${purchase.customer.email}</td>
            <td class="border px-4 py-2">${items}</td>
            <td class="border px-4 py-2">P${totalValue}</td>
            <td class="border px-4 py-2">${purchase.date}</td>
            <td class="border px-4 py-2 text-green-600">${purchase.status}</td>
            <td class="border px-4 py-2">
                <button class="bg-red-500 text-white px-2 py-1 rounded" 
                    onclick="confirmDeletePurchase(${index})">Delete</button>
            </td>
        `;
        purchaseHistoryBody.appendChild(row);
    });
}

// Initialize the page with existing purchase history
const customerPurchases = JSON.parse(localStorage.getItem('customerPurchases')) || [];
renderPurchaseHistory(customerPurchases);
            </script>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>© 2025 Optical Shop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>