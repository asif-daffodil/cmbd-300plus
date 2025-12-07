<?php
require_once 'header.php';
$selectQuery = "SELECT * FROM products";
$result = $conn->query($selectQuery);

if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    // remove image file
    $oldImage = $conn->query("SELECT image FROM products WHERE id=$delete_id")->fetch_object()->image;
    if (file_exists('../' . $oldImage)) {
        unlink('../' . $oldImage);
    }
    $deleteQuery = "DELETE FROM products WHERE id=$delete_id";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>
            Swal.fire('Success', 'Product deleted successfully.', 'success').then(() => {
                window.location.href = 'all-products.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Error', 'Failed to delete product.', 'error');
        </script>";
    }
}

if(isset($_POST["edit_product"])){
    $edit_id = $_POST["edit_id"];
    $product_name = validate_data($_POST['product_name']);
    $product_price = validate_data($_POST['product_price']);
    $product_description = validate_data($_POST['product_description']);

    // if request has no file upload, dont change the image
    if(empty($_FILES["product_image"]["name"])) {
        $updateQuery = "UPDATE products SET name='$product_name', price='$product_price', description='$product_description' WHERE id=$edit_id";
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                Swal.fire('Success', 'Product updated successfully.', 'success').then(() => {
                    window.location.href = 'all-products.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire('Error', 'Failed to update product.', 'error');
            </script>";
        }
    } else {
        // Handle file upload
        $target_dir = "../uploads/products/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check === false) {
            echo "<script>
                Swal.fire('Error', 'File is not an image.', 'error');
            </script>";
        } else {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                // remove ../ from the path to store in database
                $target_file = str_replace("../", "./", $target_file);
                // remove old image file
                $oldImage = $conn->query("SELECT image FROM products WHERE id=$edit_id")->fetch_object()->image;
                if (file_exists('../' . $oldImage)) {
                    unlink('../' . $oldImage);
                }
                $updateQuery = "UPDATE products SET name='$product_name', price='$product_price', image='$target_file', description='$product_description' WHERE id=$edit_id";
                if ($conn->query($updateQuery) === TRUE) {
                    echo "<script>
                        Swal.fire('Success', 'Product updated successfully.', 'success').then(() => {
                            window.location.href = 'all-products.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire('Error', 'Failed to update product.', 'error');
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire('Error', 'Sorry, there was an error uploading your file.', 'error');
                </script>";
            }
        }
    }
}
?>
<div class="relative <?= isset($_GET['edit_id']) ? 'bg-[#070b18]' : 'bg-[#fff]' ?> h-full min-h-screen">
    <div class="flex items-start">
        <?php require_once 'sidebar.php'; ?>

        <?php if (!isset($_GET['edit_id']) && !isset($_GET['delete_id'])) {  ?>
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
                                <table id="productsTable" class="min-w-full divide-y divide-gray-200 table-auto">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                                                    <a href="all-products.php?edit_id=<?php echo $row->id; ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                                                    <a href="all-products.php?delete_id=<?php echo $row->id; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
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
        <?php }  ?>

        <?php 
        if (isset($_GET['edit_id'])) { 
            $edit_id = $_GET['edit_id'];
            $query = "SELECT * FROM products WHERE id = $edit_id";
            $editResult = $conn->query($query);
            $editRow = $editResult->fetch_object();
        ?>
            <section class="main-content w-full p-6 max-lg:ml-8">
                <div>
                    <div class="flex items-center flex-wrap gap-6">
                        <h1 class="text-3xl font-semibold text-white">Edit Product Data</h1>
                    </div>
                    <div class="mt-4 max-w-96">
                        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                            <input type="hidden" name="edit_id" value="<?= $editRow->id ?>">
                            <div class="mb-4">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                                <input type="text" id="product-name" name="product_name" required
                                    class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $editRow->name ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="product-price" class="block text-sm font-medium text-gray-300 mb-2">Product Price</label>
                                <input type="number" step="0.01" id="product-price" name="product_price" required
                                    class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= $editRow->price ?>" />
                            </div>
                            <div class="mb-4">
                                
                                <label for="product-image" class="block text-sm font-medium text-gray-300 mb-2">
                                    <img src="../<?= $editRow->image ?>" alt="" class="w-32 h-32 object-cover mb-4 rounded-md border border-gray-300" id="preview-image">
                                    <span class="text-gray-400 text-xs">Click to Change Image</span>
                                </label>
                                <input type="file" id="product-image" name="product_image" accept="image/*"
                                    class="hidden" />
                            </div>
                            <div class="mb-4">
                                <label for="product-description" class="block text-sm font-medium text-gray-300 mb-2">Product Description</label>
                                <textarea id="product-description" name="product_description" rows="4" required
                                    class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $editRow->description ?></textarea>
                            </div>
                            <div>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" name="edit_product">
                                    Update Product
                                </button>
                                <!-- back button -->
                                <button type="button" onclick="window.history.back();"
                                    class="ml-4 px-6 py-2 bg-gray-600 text-white font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Back
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
</div>

<script>
    const productImageInput = document.getElementById('product-image');
    const previewImage = document.getElementById('preview-image');

    productImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<?php
require_once 'footer.php';
?>