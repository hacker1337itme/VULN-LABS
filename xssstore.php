<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Vulnerable Store</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #212121;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #ff0000; /* Red title color */
            margin-bottom: 20px;
            font-size: 2.5em;
            text-align: center;
        }

        #productForm {
            background-color: #333333;
            padding: 30px; /* Increased padding for more space */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px; /* Limit the max width of the form */
        }

        input[type="text"],
        input[type="number"] {
            padding: 15px; /* Larger padding for input fields */
            border: 2px solid #ff0000; /* Red border */
            border-radius: 5px;
            background-color: #444444; /* Dark background */
            color: #ffffff; /* White text */
            width: 100%; /* Full width of the container */
            margin-bottom: 15px; /* More space between input fields */
            font-size: 1.2em; /* Larger font size for better readability */
            box-sizing: border-box; /* Make sure padding is included in the width */
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #ff7f7f; /* Lighter red on focus */
        }

        button {
            padding: 15px; /* Increased padding for buttons */
            background-color: #ff0000; /* Red background */
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            width: 100%; /* Full width of the container */
            font-size: 1.2em; /* Larger font size for better readability */
            transition: background 0.3s;
        }

        button:hover {
            background-color: #cc0000; /* Darker red on hover */
        }

        table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ff0000; /* Red border */
        }

        th {
            background-color: #ff0000; /* Red header */
            color: #ffffff; /* White text */
        }

        td {
            background-color: #444; /* Dark cell background */
            color: #ffffff; /* White text */
        }

        td button {
            background-color: #000; /* Black for action buttons */
            border: 1px solid #ff0000; /* Red border */
            padding: 10px; /* Slightly adjusted for button */
            width: 45%; /* Maintain width */
            font-size: 1em; /* Consistent font size */
            transition: background 0.3s;
        }

        td button:hover {
            background-color: #555; /* Darker gray on hover */
        }

        @media (max-width: 600px) {
            #productForm {
                width: 100%;
            }

            #productList {
                width: 100%;
            }

            table {
                font-size: 14px; /* Smaller font on mobile */
            }
        }
    </style>
</head>

<body>

    <h1>XSS Vulnerable Store</h1>

    <form id="productForm">
        <input type="text" id="productName" placeholder="Product Name" required>
        <input type="number" id="productPrice" placeholder="Product Price" required>
        <button type="submit">Add Product</button>
    </form>

    <div id="productList"></div>

    <script>
        let products = [];

        document.getElementById('productForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('productName').value;
            const price = document.getElementById('productPrice').value;
            products.push({ name, price });
            renderProducts();

            // Clear the form
            document.getElementById('productForm').reset();
        });

        function renderProducts() {
            const productList = document.getElementById('productList');
            productList.innerHTML = '<table><tr><th>Name</th><th>Price</th><th>Actions</th></tr>';
            products.forEach((product, index) => {
                productList.innerHTML += `
                    <tr>
                        <td>${product.name}</td>
                        <td>${product.price}</td>
                        <td>
                            <button onclick="editProduct(${index})">Edit</button>
                            <button onclick="deleteProduct(${index})">Delete</button>
                        </td>
                    </tr>`;
            });
            productList.innerHTML += '</table>';
        }

        function editProduct(index) {
            const name = prompt("Enter new name:", products[index].name);
            const price = prompt("Enter new price:", products[index].price);

            if (name !== null && price !== null) {
                products[index] = { name, price };
                renderProducts();
            }
        }

        function deleteProduct(index) {
            if (confirm("Are you sure you want to delete this product?")) {
                products.splice(index, 1);
                renderProducts();
            }
        }
    </script>

</body>

</html>
