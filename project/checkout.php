<?php
require_once 'header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['success'])) {
    if($_GET['success'] == 'true') {
        echo "<script>Swal.fire({ title: 'Payment Successful', text: 'Your payment was successful. Thank you for your purchase!', icon: 'success', showConfirmButton: false, timer: 3000 }).then(() => { window.location.href = './'; });</script>";
        // Clear the cart after successful payment
        unset($_SESSION['cart']);
    } else {
        echo "<script>Swal.fire({ title: 'Payment Failed', text: 'There was an issue with your payment. Please try again.', icon: 'error', showConfirmButton: false, timer: 3000 }).then(() => { window.location.href = 'cart.php'; });</script>";
    }
}else{
    if (empty($_SESSION['cart'])) {
        echo "<script>Swal.fire({ title: 'Cart is Empty', text: 'Your cart is empty. Please add items to proceed to checkout.', icon: 'info', showConfirmButton: false, timer: 2000 }).then(() => { window.location.href = 'cart.php'; });</script>";
    }
}

?>
<div class="container mx-auto p-4 lg:max-w-7xl max-w-4xl">
    <h2 class="text-2xl font-semibold text-slate-900 mb-4">Checkout</h2>
    <div class="grid md:grid-cols-2 gap-6">
        <form action="./payment/checkout_hosted.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                <input type="text" id="name" name="customer_name" required class="w-full border border-slate-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                <input type="email" id="email" name="customer_email" required class="w-full border border-slate-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500">
            </div>
            <div class="mb-4">
                <label for="mobile" class="block text-sm font-medium text-slate-700 mb-1">Mobile Number</label>
                <input type="text" id="mobile" name="customer_mobile" required class="w-full border border-slate-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-slate-700 mb-1">Shipping Address</label>
                <textarea id="address" name="address" required class="w-full border border-slate-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500"></textarea>
            </div>
            <input type="hidden" name="amount" value="<?php 
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $id => $item) {
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                }
                echo $grandTotal;
            ?>">
            <!-- cart_items -->
             <?php  
                // sku" => "REF0001", "product" => "DHK TO BRS AC A1", "quantity" => "1", "amount" => "200.00"
                $cart_items = [];
                foreach ($_SESSION['cart'] as $id => $item) {
                    $cart_items[] = [
                        'sku' => $id,
                        'product' => $item['name'],
                        'quantity' => $item['quantity'],
                        'amount' => $item['price']
                    ];
                }
             ?>
            <input type="hidden" name="cart_items" value="<?php echo htmlspecialchars(json_encode($cart_items)); ?>">
            <button type="submit" class="bg-slate-600 text-white px-4 py-2 rounded-md hover:bg-slate-700">Place Order</button>
        </form>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-slate-900 mb-4">Order Summary</h3>
            <table class="w-full divide-y divide-slate-200 mb-4">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $id => $item) {
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900"><?php echo htmlspecialchars($item['name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-slate-900"><?= $item['quantity'] ?></p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-slate-900">BDT <?= $total ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
                <p class="text-lg font-bold text-slate-900">Grand Total: BDT <?= $grandTotal ?></p>
            </div>

        </div>
    </div>
    <img src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-01.png" alt="" class="mt-4 w-full">
</div>
<?php
require_once 'footer.php';
?>