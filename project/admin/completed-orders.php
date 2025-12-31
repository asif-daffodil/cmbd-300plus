<?php
require_once 'header.php';

$selectQuery = "SELECT `order_items`.*, `products`.`name` AS `product_name`, `products`.`price` AS `price_per_unit`, `products`.`image` AS `product_image`, `orders`.`name` As `customer_name`, `orders`.`phone` AS `customer_contact` FROM `order_items` INNER JOIN `products` ON `order_items`.`product_id` = `products`.`id` INNER JOIN `orders` ON `order_items`.`transaction_id` = `orders`.`transaction_id` WHERE `order_items`.`status` = 'Completed' ORDER BY `order_items`.`id` DESC";
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