<?php
require_once 'header.php';
if (!isset($_GET['id'])) {
  echo "<script>window.location.href = 'index.php';</script>";
  exit();
}
$id = $_GET['id'];
$getProductInfo = $conn->query("SELECT * FROM products WHERE `id` = $id");

if ($getProductInfo && $getProductInfo->num_rows !== 1) {
  echo "<script>window.location.href = 'index.php';</script>";
  exit();
}

$product = $getProductInfo->fetch_object();
?>
<div class="bg-white">
  <div class="p-4 lg:max-w-7xl max-w-4xl mx-auto">
    <div class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12 shadow-[0_2px_10px_-3px_rgba(169,170,172,0.8)] p-6 rounded-sm">
      <div class="lg:col-span-3 w-full lg:sticky top-0 text-center">

        <div class="px-4 py-10 rounded-sm shadow-md relative">
          <img src="https://readymadeui.com/images/laptop5.webp" alt="Product" class="w-4/5 aspect-[251/171] rounded-sm object-cover mx-auto" />
          <button type="button" class="absolute top-4 right-4 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="#ccc" class="mr-1 hover:fill-[#333]" viewBox="0 0 64 64">
              <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>
            </svg>
          </button>
        </div>
      </div>

      <div class="lg:col-span-2">
        <h3 class="text-xl font-semibold text-slate-900"><?= $product->name ?></h3>
        <div class="flex items-center space-x-1 mt-2">
          <svg class="w-4 h-4 fill-blue-600" viewBox="0 0 14 13" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
          </svg>
          <svg class="w-4 h-4 fill-blue-600" viewBox="0 0 14 13" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
          </svg>
          <svg class="w-4 h-4 fill-blue-600" viewBox="0 0 14 13" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
          </svg>
          <svg class="w-4 h-4 fill-blue-600" viewBox="0 0 14 13" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
          </svg>
          <svg class="w-4 h-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
          </svg>
          <h4 class="text-slate-500 text-base !ml-3">50 Reviews</h4>
        </div>

        <p class="text-sm text-slate-500 mt-4"><?= $product->description ?></p>

        <div class="flex flex-wrap gap-4 mt-8">
          <p class="text-slate-900 text-2xl font-semibold">BDT <?= $product->price ?></p>
          <p class="text-slate-500 text-base"><strike>BDT <?= $product->price + 5000 ?></strike> <span class="text-xs ml-1">(Tax included)</span></p>
        </div>

        <!-- quantity/amount -->
        <div class="flex items-center mt-4">
          <label for="quantity" class="text-sm text-slate-500 mr-2">Quantity:</label>
          <input type="number" id="quantity" name="quantity" min="1" value="1" class="border border-slate-300 rounded-sm px-2 py-1 w-16" id="quantity" />
        </div>

        <div class="flex gap-4 mt-12 max-w-md">
          <button type="button" class="w-full px-4 py-2.5 cursor-pointer outline-none border border-blue-600 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-sm">Buy now</button>
          <button type="button" class="w-full px-4 py-2.5 cursor-pointer outline-none border border-blue-600 bg-transparent hover:bg-slate-50 text-slate-900 text-sm font-medium rounded-sm" id="addToCartBtn">Add to cart</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const addToCartBtn = document.getElementById('addToCartBtn');
  addToCartBtn.addEventListener('click', () => {
    const quantity = document.getElementById('quantity').value;
    const url = `./add-to-cart.php?id=<?php echo urlencode($product->id); ?>&quantity=${quantity}`;
    window.location.href = url;
  });
</script>
<script>
  <?php if (isset($_GET['addtocart']) && $_GET['addtocart'] === 'true') { ?>
    Swal.fire({
      icon: 'success',
      title: 'Added to Cart',
      text: 'The product has been added to your cart successfully.',
      timer: 2000,
      showConfirmButton: false
    }).then(() => {
      const url = new URL(window.location);
      url.searchParams.delete('addtocart');
      location.href = url.toString();
    });
  <?php } ?>
</script>
<?php
require_once 'footer.php';
?>