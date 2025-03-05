<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Inventory Stocks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width textarea */
        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: rgb(255, 0, 0);
            resize: none;
            min-height: 200px;
        }

        /* When the textarea gets focus, do something */
        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center"> 
            <a class="text-2xl font-bold text-gray-800" href="#">Medical Record</a>
            <div class="space-x-4">
                <a class="text-gray-600 hover:text-gray-800" href="costumer.php" id="cartLink">COSTUMER ORDER STATUS</a>
                <a class="text-gray-600 hover:text-gray-800" href="admin.php">Inventory Stocks</a>
                <a class="text-gray-600 hover:text-gray-800" href="appointment_list.php" id="cartLink">Appointment Dashboard</a>
                <a class="text-gray-600 hover:text-gray-800" href="add.php">Medical Record</a>
                <a class="text-gray-600 hover:text-gray-800" href="login.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Inventory Stocks Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Inventory Stocks</h2>
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Item</th>
                            <th class="px-4 py-2 text-left text-gray-600">Stock</th>
                            <th class="px-4 py-2 text-left text-gray-600">Price</th>
                            <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventory-table-body">
                        <!-- Inventory items will be populated here -->
                    </tbody>
                </table>
            </div>
            <!-- Add Product Button -->
            <button class="bg-blue-500 text-white px-4 py-2 rounded mt-6" id="add-product-button">Add Product</button>

            <!-- Add Product Modal -->
            <div id="addProductModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal" style="cursor:pointer; float:right;">&times;</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Add Product</h3>
                    <form id="add-product-form">
                        <div class="mb-4">
                            <label class="block text-gray-700">Product Name</label>
                            <input type="text" id="product-name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Stock</label>
                            <input type="number" id="product-stock" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Price</label>
                            <input type="text" id="product-price" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" id="submit-button">Add Product</button>
                    </form>
                </div>
            </div>

            <script>
                // Load inventory from local storage or initialize with default values
                const defaultInventory = {
                    "Aviator Sunglasses": { stock: 50, price: "$149.99" },
                    "Round Glasses": { stock: 30, price: "$129.99" },
                    "Protective Sunglasses": { stock: 20, price: "$149.99" }
                };

                const inventory = JSON.parse(localStorage.getItem('inventory')) || defaultInventory;

               // Update the updateInventoryDisplay function
function updateInventoryDisplay() {
    const inventoryTableBody = document.getElementById('inventory-table-body');
    inventoryTableBody.innerHTML = ''; // Clear existing rows

    const inventory = JSON.parse(localStorage.getItem('inventory')) || {};

    for (const [productName, productDetails] of Object.entries(inventory)) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="border px-4 py-2">${productName}</td>
            <td class="border px-4 py-2">${productDetails.stock}</td>
            <td class="border px-4 py-2">${productDetails.price}</td>
            <td class="border px-4 py-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded mr-2" 
                    onclick="updateStock('${productName}')">Update Stock</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded" 
                   
            </td>
        `;
        inventoryTableBody.appendChild(row);
    }
}

// Add function to update stock
function updateStock(productName) {
    const newStock = prompt('Enter new stock quantity:');
    if (newStock !== null && !isNaN(newStock)) {
        const inventory = JSON.parse(localStorage.getItem('inventory')) || {};
        if (inventory[productName]) {
            inventory[productName].stock = parseInt(newStock);
            localStorage.setItem('inventory', JSON.stringify(inventory));
            updateInventoryDisplay();
        }
    }
}

                // Add or update product
                document.getElementById('add-product-form').addEventListener('submit', function(event) {
                    event.preventDefault();

                    const productName = document.getElementById('product-name').value;
                    const productStock = parseInt(document.getElementById('product-stock').value);
                    const productPrice = document.getElementById('product-price').value;

                    // Add product to inventory
                    inventory[productName] = { stock: productStock, price: productPrice };

                    // Save updated inventory to local storage
                    localStorage.setItem('inventory', JSON.stringify(inventory));

                    // Update the display
                    updateInventoryDisplay();

                    // Clear the form
                    document.getElementById('add-product-form').reset();
                    closeModal(); // Close the modal
                });

                // Delete product
                function deleteProduct(productName) {
                    delete inventory[productName];
                    localStorage.setItem('inventory', JSON.stringify(inventory));
                    updateInventoryDisplay();
                }

                // Show modal
                document.getElementById('add-product-button').addEventListener('click', function() {
                    document.getElementById('addProductModal').style.display = 'block';
                });

                // Close modal
                document.querySelector('.close-modal').addEventListener('click', function() {
                    closeModal();
                });

                function closeModal() {
                    document.getElementById('addProductModal').style.display = 'none';
                }

                // Call this function after loading the page
                updateInventoryDisplay();  
                
                // Function to deduct stock from inventory
function deductStockFromInventory() {
    let inventory = JSON.parse(localStorage.getItem('inventory')) || {};
    cartItems.forEach(item => {
        if (inventory[item.product]) {
            inventory[item.product].stock -= item.quantity; // Deduct the quantity from stock
            if (inventory[item.product].stock < 0) {
                inventory[item.product].stock = 0; // Prevent negative stock
            }
        }
    });
    localStorage.setItem('inventory', JSON.stringify(inventory)); // Update inventory in local storage
}
            </script>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2023 Admin Inventory. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>