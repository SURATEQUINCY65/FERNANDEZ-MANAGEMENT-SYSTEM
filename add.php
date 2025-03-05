<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Add Medical Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            color: black;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: black;
        }

        th {
            background-color: rgb(0, 255, 0);
        }

        td {
            color: rgb(255, 0, 0);
            background-color: rgb(239, 255, 8);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        button {
            cursor: pointer;
            color: black;
        }
        /* Add this to your existing style section */
.modal-open {
    overflow: hidden;
}

#recordModal {
    display: none;
}

#recordModal.active {
    display: flex;
}
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center"> 
            <a class="text-2xl font-bold text-gray-800" href="#">Medical Record</a>
            <div class="space-x-4">
                <a class="text-gray-600 hover:text-gray-800" href="costumer.php" id="cartLink">Customer List</a>
                <a class="text-gray-600 hover:text-gray-800" href="admin.php">Inventory Stocks</a>
                <a class="text-gray-600 hover:text-gray-800" href="appointment_list.php" id="cartLink">Appointment Dashboard (0)</a>
                <a class="text-gray-600 hover:text-gray-800" href="#">Medical Record</a>
                <a class="text-gray-600 hover:text-gray-800" href="login.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4" style="color:black;">Add Medical Record</h1>

        <form id="recordForm" class="mb-6">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" required class="border border-gray-300 rounded px-4 py-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Age</label>
                <input type="number" id="age" name="age" required class="border border-gray-300 rounded px-4 py-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Birth/Date</label>
                <input type="date" id="date" name="date" required class="border border-gray-300 rounded px-4 py-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">PD</label>
                <input type="text" id="pd" name="pd" required class="border border-gray-300 rounded px-4 py-2 w-full">
            </div>

            <h3 class="text-lg font-bold mb-2">Eye Measurements</h3>
            <table class="mb-4">
                <thead>
                    <tr>
                        <th></th>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th>ADD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R</td>
                        <td><input type="text" id="r_sph" name="r_sph" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="r_cyl" name="r_c yl" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="r_axis" name="r_axis" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="r_add" name="r_add" required class="border border-gray-300 rounded px-2 w-full"></td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td><input type="text" id="l_sph" name="l_sph" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="l_cyl" name="l_cyl" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="l_axis" name="l_axis" required class="border border-gray-300 rounded px-2 w-full"></td>
                        <td><input type="text" id="l_add" name="l_add" required class="border border-gray-300 rounded px-2 w-full"></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" onclick="addItem()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                Submit
            </button>
        </form>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">NAME</th>
                    <th class="px-4 py-2">AGE</th>
                    <th class="px-4 py-2">DATE</th>
                    <th class="px-4 py-2">PD</th>
                    <th class="px-4 py-2">SPH</th>
                    <th class="px-4 py-2">CYL</th>
                    <th class="px-4 py-2">AXIS</th>
                    <th class="px-4 py-2">ADD</th>
                    <th class="px-4 py-2">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="recordTableBody">
                <!-- Records will be populated here -->
            </tbody>
        </table>
    </div>
    <!-- Add this before closing body tag -->
<div id="recordModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Medical Record Details</h2>
            <button onclick="closeModal()" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="modalContent" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-bold mb-2">Patient Information</h3>
                    <p><span class="font-semibold">Name:</span> <span id="modal-name"></span></p>
                    <p><span class="font-semibold">Age:</span> <span id="modal-age"></span></p>
                    <p><span class="font-semibold">Birth/Date:</span> <span id="modal-date"></span></p>
                    <p><span class="font-semibold">PD:</span> <span id="modal-pd"></span></p>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Eye Measurements</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold">Right Eye</h4>
                            <p>SPH: <span id="modal-r-sph"></span></p>
                            <p>CYL: <span id="modal-r-cyl"></span></p>
                            <p>AXIS: <span id="modal-r-axis"></span></p>
                            <p>ADD: <span id="modal-r-add"></span></p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Left Eye</h4>
                            <p>SPH: <span id="modal-l-sph"></span></p>
                            <p>CYL: <span id="modal-l-cyl"></span></p>
                            <p>AXIS: <span id="modal-l-axis"></span></p>
                            <p>ADD: <span id="modal-l-add"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Load existing records from localStorage
        window.onload = function() {
            loadRecords();
        };

        function loadRecords() {
            const records = JSON.parse(localStorage.getItem('medicalRecords')) || [];
            records.forEach(record => {
                addRowToTable(record);
            });
        }

        function addItem() {
            if (!validateForm()) {
                alert("Please fill in all required fields.");
                return;
            }

            const record = {
                name: document.getElementById("name").value,
                age: document.getElementById("age").value,
                date: document.getElementById("date").value,
                pd: document.getElementById("pd").value,
                r_sph: document.getElementById("r_sph").value,
                r_cyl: document.getElementById("r_cyl").value,
                r_axis: document.getElementById("r_axis").value,
                r_add: document.getElementById("r_add").value,
                l_sph: document.getElementById("l_sph").value,
                l_cyl: document.getElementById("l_cyl").value,
                l_axis: document.getElementById("l_axis").value,
                l_add: document.getElementById("l_add").value
            };

            addRowToTable(record);
            saveRecord(record);
            document.getElementById("recordForm").reset();
        }

        function validateForm() {
            const inputs = document.querySelectorAll('#recordForm input[required]');
            return Array.from(inputs).every(input => input.value.trim() !== '');
        }

       // Update the addRowToTable function to include the View button
function addRowToTable(record) {
    const tableBody = document.getElementById("recordTableBody");
    const row = tableBody.insertRow();

    row.insertCell(0).innerHTML = record.name;
    row.insertCell(1).innerHTML = record.age;
    row.insertCell(2).innerHTML = record.date;
    row.insertCell(3).innerHTML = record.pd;
    row.insertCell(4).innerHTML = record.r_sph;
    row.insertCell(5).innerHTML = record.r_cyl;
    row.insertCell(6).innerHTML = record.r_axis;
    row.insertCell(7).innerHTML = record.r_add;
    row.insertCell(8).innerHTML = `<div class="action-buttons">
        <button onclick="editItem(this)" class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded mr-2">
            Edit
        </button>
        <button onclick="viewRecord(this)" class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded">
            View
        </button>
    </div>`;
}

// Add these new functions for modal handling
function viewRecord(button) {
    const row = button.parentNode.parentNode.parentNode;
    const records = JSON.parse(localStorage.getItem('medicalRecords')) || [];
    const record = records.find(r => r.name === row.cells[0].innerHTML);

    if (record) {
        // Update modal content
        document.getElementById('modal-name').textContent = record.name;
        document.getElementById('modal-age').textContent = record.age;
        document.getElementById('modal-date').textContent = record.date;
        document.getElementById('modal-pd').textContent = record.pd;
        
        // Right eye
        document.getElementById('modal-r-sph').textContent = record.r_sph;
        document.getElementById('modal-r-cyl').textContent = record.r_cyl;
        document.getElementById('modal-r-axis').textContent = record.r_axis;
        document.getElementById('modal-r-add').textContent = record.r_add;
        
        // Left eye
        document.getElementById('modal-l-sph').textContent = record.l_sph;
        document.getElementById('modal-l-cyl').textContent = record.l_cyl;
        document.getElementById('modal-l-axis').textContent = record.l_axis;
        document.getElementById('modal-l-add').textContent = record.l_add;

        // Show modal
        document.getElementById('recordModal').classList.add('active');
        document.body.classList.add('modal-open');
    }
}

function closeModal() {
    document.getElementById('recordModal').classList.remove('active');
    document.body.classList.remove('modal-open');
}

// Add event listener to close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('recordModal');
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
});
    </script>
</body>
</html>