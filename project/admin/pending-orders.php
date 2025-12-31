<?php
require_once 'header.php';

if(isset($_POST['update_order'])) {
    $orderId = (int) $_POST['order_id'];
    $status = $_POST['status'] === 'completed' ? 'Completed' : 'Pending';

    $updateQuery = "UPDATE `order_items` SET `status` = '$status' WHERE `id` = $orderId";
    if($conn->query($updateQuery)) {
        $transactionId = (int) $_POST['transaction_id'];
        $getCusEmailQuery = "SELECT `orders`.`email` AS `customer_email` FROM `orders` WHERE `orders`.`transaction_id` = '$transactionId' LIMIT 1";
        $emailResult = $conn->query($getCusEmailQuery);
        if($emailResult && $emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_object();
            $customerEmail = $emailRow->customer_email; 

            // Send email notification to customer
            $to = $customerEmail;
            $subject = "Order Status Updated";
            $message = "Dear Customer,\n\nYour order with Transaction ID: $transactionId has been updated to '$status'.\n\nThank you for shopping with us!\n\nBest Regards,\nE-commerce Team";
            $headers = "From: no-reply@yourdomain.com";
            mail($to, $subject, $message, $headers);
        }
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Order updated successfully',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = window.location.href;
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed to update order',
                text: 'Please try again later.'
            });
        </script>";
    }
}

$selectQuery = "SELECT `order_items`.*, `products`.`name` AS `product_name`, `products`.`price` AS `price_per_unit`, `products`.`image` AS `product_image`, `orders`.`name` As `customer_name`, `orders`.`phone` AS `customer_contact` FROM `order_items` INNER JOIN `products` ON `order_items`.`product_id` = `products`.`id` INNER JOIN `orders` ON `order_items`.`transaction_id` = `orders`.`transaction_id` WHERE `order_items`.`status` = 'Pending' ORDER BY `order_items`.`id` DESC";
$result = $conn->query($selectQuery);

?>
<div class="relative <?= isset($_GET['edit_id']) ? 'bg-[#070b18]' : 'bg-[#fff]' ?> h-full min-h-screen">
    <div class="flex items-start">
        <?php require_once 'sidebar.php'; ?>
        <section class="main-content w-full p-6 max-lg:ml-8 overflow-x-scroll">
            <div>
                <div class="flex items-center flex-wrap gap-6">
                    <h1 class="text-3xl font-semibold text-gray-800">All Products</h1>
                </div>
                <?php
                if ($result->num_rows > 0) {
                ?>

                    <table id="ordersTable" class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price per unit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            <?php while ($row = $result->fetch_object()) { ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $row->transaction_id; ?></td>
                                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800">
                                        <img src="<?php echo '../' . ltrim($row->product_image, '/'); ?>" alt="<?php echo htmlspecialchars($row->product_name); ?>" class="h-full w-full object-cover">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($row->customer_name); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($row->customer_contact); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row->product_name); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">BDT <?php echo number_format($row->price_per_unit, 2); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $row->quantity; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">BDT <?php echo number_format($row->amount); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <form action="" method="post" class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
                                            <input type="hidden" name="order_id" value="<?php echo (int) $row->id; ?>">
                                            <input type="hidden" name="transaction_id" value="<?php echo htmlspecialchars($row->transaction_id); ?>">

                                            <label class="inline-flex items-center gap-2">
                                                <select
                                                    name="status"
                                                    class="min-w-[150px] rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                                >
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </label>

                                            <button
                                                type="submit"
                                                name="update_order"
                                                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 active:bg-blue-800"
                                            >
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <?php } else { ?>
                    <div class="mt-6">
                        <p class="text-gray-800">No products found.</p>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script>
    let table = new DataTable('#ordersTableordersTable', {
        responsive: true
    });

    $(document).ready(function() {
        $('#productsTable').DataTable();
    });
</script>

<?php
require_once 'footer.php';
?>