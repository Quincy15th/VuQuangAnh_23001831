<?php
$products = [
    ["name" => "Iphone 12", "price" => 1000000],
    ["name" => "Samsung Galaxy S21", "price" => 800000],
    ["name" => "Xiaomi Redmi Note 10", "price" => 300000],
    ["name" => "Oppo Reno 6", "price" => 500000],
    ["name" => "Vsmart Aris Pro", "price" => 400000]
];



function calculateTotalPrice($products) {
    $totalPrice = 0;
    foreach ($products as $product) {
        $totalPrice += $product["price"];
    }
    return $totalPrice;
}
function findMaxPriceProduct($products) {
    $maxPriceProduct = $products[0];
    foreach ($products as $product) {
        if ($product["price"] > $maxPriceProduct["price"]) {
            $maxPriceProduct = $product;
        }
    }
    return $maxPriceProduct;
}

function displayTotalPrice($products) {
    $totalPrice = calculateTotalPrice($products);
    echo "Tổng giá trị của tất cả sản phẩm: " . $totalPrice . "<br>";
}
function displayMaxPriceProduct($products) {
    $maxPriceProduct = findMaxPriceProduct($products);
    echo "Sản phẩm có giá cao nhất: " . $maxPriceProduct["name"] . " - Giá: " . $maxPriceProduct["price"] . "<br>";
}


displayTotalPrice($products);
displayMaxPriceProduct($products);

?>
