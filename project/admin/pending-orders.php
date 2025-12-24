<?php
require_once 'header.php';
$selectQuery = "SELECT * FROM orders WHERE status = 'Pending' ORDER BY id DESC";
$result = $conn->query($selectQuery);

?>
<div class="relative <?= isset($_GET['edit_id']) ? 'bg-[#070b18]' : 'bg-[#fff]' ?> h-full min-h-screen">
    <div class="flex items-start">
        <?php require_once 'sidebar.php'; ?>
        <section class="main-content w-full p-6 max-lg:ml-8">
            <div>
                <div class="flex items-center flex-wrap gap-6">
                    <h1 class="text-3xl font-semibold text-gray-800">All Products</h1>
                </div>
                <?php
                if ($result->num_rows > 0) {
                ?>
                    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table id="ordersTable" class="min-w-full divide-y divide-gray-200 table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satus</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    <?php while ($row = $result->fetch_object()) { ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $row->id; ?></td>
                                            <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800"><?php echo htmlspecialchars($row->name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo '$' . number_format((float)$row->price, 2); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-16 w-16 bg-gray-100 rounded-md overflow-hidden flex-shrink-0 border border-gray-200">
                                                        <img src="<?php echo '../' . ltrim($row->image, '/'); ?>" alt="<?php echo htmlspecialchars($row->name); ?>" class="h-full w-full object-cover">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                <form action="" method="post">
                                                    <input type="hidden" name="order_id" value="<?php echo $row->id; ?>">
                                                    <select name="status" id="">
                                                        <option value="pending" selected>Pending</option>
                                                        <option value="completed">Completed</option>
                                                    </select>
                                                    <button type="submit" class="text-blue-600 hover:text-blue-800">Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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