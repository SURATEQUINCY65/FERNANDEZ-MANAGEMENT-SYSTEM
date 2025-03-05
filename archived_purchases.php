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
            <a class="text-2xl font-bold text-gray-800" href="#">Admin Dashboard</a>
            <div class="space-x-4">
                <a class="text-gray-600 hover:text-gray-800" href="costumer.php">Customer List</a>
                <a class="text-gray-600 hover:text-gray-800" href="admin.php">Inventory Stocks</a>
                <a class="text-gray-600 hover:text-gray-800" href="appointment_list.php">Appointment List</a>
                <a class="text-gray-600 hover:text-gray-800" href="add.php">Add Product</a>
            </div>
        </div>
    </nav>

    <!-- Customer Purchase History Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <a class="text-gray-600 hover:text-gray-800 font-semibold transition duration-200" href="costumer.php">← back</a>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Archived</h2>
            <input type="text" id="searchBar" placeholder="Search by product name..." class="border rounded px-4 py-2 mb-4 w-full"/>
          
                  
                    <tbody id="purchaseHistoryBody">
                        <!-- Purchase history will be populated here -->
                    </tbody>
                </table>
            </div>
            <script>
                // Load purchase history from local storage
                const customerPurchases = JSON.parse(localStorage.getItem('customerPurchases')) || [];
                const purchaseHistoryBody = document.getElementById('purchaseHistoryBody');

                function renderPurchaseHistory(filteredPurchases) {
                    purchaseHistoryBody.innerHTML = ''; // Clear existing rows
                    filteredPurchases.forEach((purchase, index) => {
                        const items = purchase.items.map(item => `${item.product} - ${item.price}`).join(', ');
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="border px-4 py-2">${purchase.customer.name || 'N/A'}</td>
                            <td class="border px-4 py-2">${purchase.customer.email || 'N/A'}</td>
                            <td class="border px-4 py-2">${items}</td>
                            <td class="border px-4 py-2">${purchase.date}</td>
                            <td class="border px-4 py-2 text-green-600">Order Successful</td>
                            <td class="border px-4 py-2">
                                <button class="bg-yellow-500 text-white px-2 py-1 rounded" onclick="archivePurchase(${index})">Archive</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deletePurchase(${index})">Delete</button>
                            </td>
                        `;
                        purchaseHistoryBody.appendChild(row);
                    });
                }

                // Search functionality
                document.getElementById('searchBar').addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const filteredPurchases = customerPurchases.filter(purchase => 
                        purchase.items.some(item => item.product.toLowerCase().includes(searchTerm))
                    );
                    renderPurchaseHistory(filteredPurchases);
                });

                // Archive purchase
                function archivePurchase(index) {
                    const archivedPurchases = JSON.parse(localStorage.getItem('archivedPurchases')) || [];
                    archivedPurchases.push(customerPurchases[index]); // Add the purchase to the archive
                    localStorage.setItem('archivedPurchases', JSON.stringify(archivedPurchases)); // Update local storage
                    deletePurchase(index); // Delete the purchase from the main history
                }

                // Delete purchase
                function deletePurchase(index) {
                    customerPurchases.splice(index, 1); // Remove the purchase from the array
                    localStorage.setItem('customerPurchases', JSON.stringify(customerPurchases)); // Update local storage
                    renderPurchaseHistory(customerPurchases); // Re-render the purchase history
                }

                // Initial render
                renderPurchaseHistory(customerPurchases);
            </script>
        </div>
    </section>

    <!-- Archived Purchases Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Archived Purchases</h2>
            <div class="bg-white p-6 rounded shadow-md">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left text-gray-600">Email</th>
                            <th class="px-4 py-2 text-left text-gray-600">Items</th>
                            <th class="px-4 py-2 text-left text-gray-600">Date</th>
                            <th class="px-4 py-2 text-left text-gray-600">Status</th>
                            <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="archivedPurchasesBody">
                        <!-- Archived purchases will be populated here -->
                    </tbody>
                </table>
            </div>
            <script>
                // Load archived purchases from local storage
                const archivedPurchases = JSON.parse(localStorage.getItem('archivedPurchases')) || [];
                const archivedPurchasesBody = document.getElementById('archivedPurchasesBody');

                function renderArchivedPurchases() {
                    archivedPurchasesBody.innerHTML = ''; // Clear existing rows
                    archivedPurchases.forEach((purchase, index) => {
                        const items = purchase.items.map(item => `${item.product} - ${item.price}`).join(', ');
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="border px-4 py-2">${purchase.customer.name || 'N/A'}</td>
                            <td class="border px-4 py-2">${purchase.customer.email || 'N/A'}</td>
                            <td class="border px-4 py-2">${items}</td>
                            <td class="border px-4 py-2">${purchase.date}</td>
                            <td class="border px-4 py-2 text-gray-600">Archived</td>
                            <td class="border px-4 py-2">
                                <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteArchivedPurchase(${index})">Delete</button>
                            </td>
                        `;
                        archivedPurchasesBody.appendChild(row);
                    });
                }

                // Delete archived purchase
                function deleteArchivedPurchase(index) {
                    archivedPurchases.splice(index, 1); // Remove the purchase from the archived array
                    localStorage.setItem('archivedPurchases', JSON.stringify(archivedPurchases)); // Update local storage
                    renderArchivedPurchases(); // Re-render the archived purchases
                }

                // Initial render for archived purchases
                renderArchivedPurchases();
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