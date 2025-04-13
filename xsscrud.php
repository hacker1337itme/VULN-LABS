<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management CRUD App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: white;
            background: linear-gradient(60deg, #212121, #f44336);
            animation: backgroundAnimation 10s infinite alternate;
            height: 100vh;
            overflow: hidden;
        }

        @keyframes backgroundAnimation {
            0% { background: linear-gradient(60deg, #212121, #f44336); }
            50% { background: linear-gradient(60deg, #f44336, #212121); }
            100% { background: linear-gradient(60deg, #212121, #f44336); }
        }

        h1, h2 {
            text-align: center;
        }

        input, button {
            margin: 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        
        button {
            background-color: #f44336;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c62828;
        }

        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #444;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #f44336;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<h1>Product Management CRUD Application</h1>

<h2>Add Product</h2>
<div style="text-align: center;">
    <input type="text" id="productName" placeholder="Product Name" />
    <input type="text" id="productDescription" placeholder="Product Description" />
    <input type="number" id="productPrice" placeholder="Product Price" />
    <button onclick="addProduct()">Add Product</button>
</div>

<h2>Product List</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="productList"></tbody>
</table>

<script>
    let products = [];

    function renderProducts() {
        const list = document.getElementById('productList');
        list.innerHTML = '';
        products.forEach((product, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.price.toFixed(2)}</td>
                <td>
                    <button onclick="editProduct(${index})">Edit</button>
                    <button onclick="deleteProduct(${index})">Delete</button>
                </td>
            `;
            list.appendChild(row);
        });
    }

    function addProduct() {
        const name = document.getElementById('productName').value;
        const description = document.getElementById('productDescription').value;
        const price = parseFloat(document.getElementById('productPrice').value);

        if (name && description && !isNaN(price)) {
            const product = { name, description, price };
            products.push(product);
            clearInputFields();
            renderProducts();
        } else {
            alert("Please fill out all fields correctly.");
        }
    }

    function deleteProduct(index) {
        products.splice(index, 1);
        renderProducts();
    }

    function editProduct(index) {
        const product = products[index];
        document.getElementById('productName').value = product.name;
        document.getElementById('productDescription').value = product.description;
        document.getElementById('productPrice').value = product.price;
        products.splice(index, 1); // Remove the product from the list so it can be updated
        renderProducts();
    }

    function clearInputFields() {
        document.getElementById('productName').value = '';
        document.getElementById('productDescription').value = '';
        document.getElementById('productPrice').value = '';
    }
</script>

</body>
</html>
