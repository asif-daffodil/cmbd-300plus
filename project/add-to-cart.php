<?php  
session_start();
if (!isset($_GET['id'])) {
    echo "<script>history.back();</script>";
    exit();
}
$id = intval($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "project-309");

if (!$conn) {
    echo "<script>history.back();</script>";
    exit();
}

$getData = $conn->query("SELECT * FROM products WHERE id = $id");

if($getData && $getData->num_rows !== 1) {
    echo "<script>history.back();</script>";
    exit();
}

$product = $getData->fetch_object();
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;
if ($quantity < 1) {
    $quantity = 1;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'][$product->id] = [
        'name' => $product->name,
        'price' => $product->price,
        'image' => $product->image,
        'quantity' => $quantity
    ];
    // js history back with query param to show added to cart message
    echo "<script>
    (function(){
        var ref = document.referrer;
        if (ref) {
            var sep = ref.indexOf('?') === -1 ? '?' : '&';
            window.location = ref + sep + 'addtocart=true';s
        } else {
            window.history.back();
        }
    })();
    </script>";
    exit();
}

if(isset($_SESSION['cart'])) {
    if(array_key_exists($product->id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product->id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => $quantity
        ];
    }
    // js history back with query param to show added to cart message
    echo "<script>
    (function(){
        var ref = document.referrer;
        if (ref) {
            var sep = ref.indexOf('?') === -1 ? '?' : '&';
            window.location = ref + sep + 'addtocart=true';
        } else {
            window.history.back();
        }
    })();
    </script>";
    exit();
}

?>