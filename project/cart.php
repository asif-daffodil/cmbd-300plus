<?php  
    require_once 'header.php';
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if (isset($_GET['remid'])) {
        $remid = intval($_GET['remid']);
        if (isset($_SESSION['cart'][$remid])) {
            unset($_SESSION['cart'][$remid]);
        }
        echo "<script>Swal.fire({ title: 'Item removed', text: 'The item has been removed from your cart.', icon: 'success', showConfirmButton: false, timer: 1500 }).then(() => { window.location.href = 'cart.php'; });</script>";
    }
?>

<?php if(empty($_SESSION['cart'])){ ?>
    <div class="bg-white p-4 lg:max-w-7xl max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold text-slate-900">Your Cart is Empty</h2>
        <p class="text-sm text-slate-500 mt-2">Add items to your cart to see them here.</p>
    </div>
<?php } else { ?>
    <table class="min-w-full divide-y divide-slate-200 mb-3 border-b">
        <thead class="bg-slate-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Product</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Price</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Quantity</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Total</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            <?php 
                $grandTotal = 0;
                foreach($_SESSION['cart'] as $id => $item) { 
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
            ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16">
                            <img class="h-16 w-16 object-contain" src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-slate-900"><?php echo htmlspecialchars($item['name']); ?></div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-sm text-slate-900">BDT <?= $item['price'] ?></p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-sm text-slate-900"><?= $item['quantity'] ?></p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-sm text-slate-900">BDT <?= $total ?></p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button class="text-sm text-red-600 hover:underline" onclick="removeFromCart(<?= $id ?>)">Remove</button>
                </td>
            </tr>
            <?php } ?>
            <!-- total price -->
            <tr>
                <td colspan="3" class="px-6 py-4 whitespace-nowrap">
                    <p class="text-slate-900 font-semibold text-3xl text-center">Total</p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                    <p class="text-slate-900 font-bold">BDT <?= $grandTotal ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- checkout button -->
    <div class="flex justify-center mb-5">
        <a href="checkout.php" class="bg-blue-600 text-white px-4 py-2 rounded-md">Proceed to Checkout</a>
    </div>
<?php } ?>

<script>
    function removeFromCart(id) {
        const url = `./cart.php?remid=${id}`;
        window.location.href = url;
    }
</script>

<?php
    require_once 'footer.php';
?>