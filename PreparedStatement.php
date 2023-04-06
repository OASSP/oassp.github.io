<?php

try {
// Connect to a database named "mysql", with the password "root"
$connection = new PDO('mysql:dbname=mysql', 'root');

// Execute a request on the connection, which will create
// a table "products" with two columns, "name" and "price"
$connection->exec('CREATE TABLE IF NOT EXISTS products (name VARCHAR(40), price INT)');

// Prepare a query to insert multiple products into the table
$statement = $connection->prepare('INSERT INTO products VALUES (?, ?)');
$products  = [
['bike', 10900],
['shoes', 7400],
['phone', 29500],
];

// Iterate through the products in the "products" array, and
// execute the prepared statement for each product
foreach ($products as $product) {
$statement->execute($product);
}

// Prepare a new statement with a named parameter
$statement = $connection->prepare('SELECT * FROM products WHERE name = :name');
$statement->execute([
':name' => 'shoes',
]);

// Use array destructuring to assign the product name and its price
// to corresponding variables
[ $product, $price ] = $statement->fetch();

// Display the result to the user
echo "The price of the product {$product} is \${$price}.";

// Close the cursor so `fetch` can eventually be used again
$statement->closeCursor();
} catch (\Exception $e) {
echo 'An error has occurred: ' . $e->getMessage();
}
