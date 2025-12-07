<?php
require_once 'header.php';

if (isset($_POST['add_product'])) {
    $product_name = validate_data($_POST['product_name']);
    $product_price = validate_data($_POST['product_price']);
    $product_description = validate_data($_POST['product_description']);

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
            // Insert product into database
            $sql = "INSERT INTO products (name, price, image, description) VALUES ('$product_name', '$product_price', '$target_file', '$product_description')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    Swal.fire('Success', 'Product added successfully.', 'success');
                </script>";
            } else {
                echo "<script>
                    Swal.fire('Error', 'Failed to add product.', 'error');
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire('Error', 'Sorry, there was an error uploading your file.', 'error');
            </script>";
        }
    }
}
?>
<div class="relative bg-[#070b18] h-full min-h-screen">
    <div class="flex items-start">
        <?php require_once 'sidebar.php'; ?>

        <section class="main-content w-full p-6 max-lg:ml-8">
            <div>
                <div class="flex items-center flex-wrap gap-6">
                    <h1 class="text-3xl font-semibold text-white">Add New Product</h1>
                </div>
                <div class="mt-4 max-w-96">
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="mb-4">
                            <label for="product-name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                            <input type="text" id="product-name" name="product_name" required
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div class="mb-4">
                            <label for="product-price" class="block text-sm font-medium text-gray-300 mb-2">Product Price</label>
                            <input type="number" step="0.01" id="product-price" name="product_price" required
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div class="mb-4">
                            <label for="product-image" class="block text-sm font-medium text-gray-300 mb-2">Product Image</label>
                            <input type="file" id="product-image" name="product_image" accept="image/*" required
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div class="mb-4">
                            <label for="product-description" class="block text-sm font-medium text-gray-300 mb-2">Product Description</label>
                            <textarea id="product-description" name="product_description" rows="4" required
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" name="add_product">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
require_once 'footer.php';
?>