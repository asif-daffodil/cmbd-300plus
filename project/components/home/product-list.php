<?php
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
$pageNo = $_GET['page'] ?? 1;
$totalProduct = $result->num_rows;
$productPerPage = 8;
$totalPage = ceil($totalProduct / $productPerPage);
$startPoint = ($pageNo - 1) * $productPerPage;
$result = $conn->query("SELECT * FROM products LIMIT $startPoint, $productPerPage");
?>
<div class="p-4 mx-auto lg:max-w-6xl md:max-w-4xl">
  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 sm:mb-8">Featured Products</h2>
  <?php if ($result && $result->num_rows > 0) { ?>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
      <?php while ($row = $result->fetch_object()) { ?>
        <div class="bg-white flex flex-col rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-200 relative">
          <!-- Image / Quick view overlay -->
          <a href="javascript:void(0)" class="block relative group">
            <div class="w-full bg-gray-50 flex items-center justify-center">
              <img src="<?php echo $row->image; ?>" alt="<?php echo $row->name; ?>"
                class="w-full max-h-44 object-contain transition-transform duration-300 group-hover:scale-105" />
            </div>

            <div class="absolute inset-0 flex items-end justify-center p-3 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
              <div class="bg-black/60 text-white text-xs rounded-md px-3 py-1 backdrop-blur-sm pointer-events-auto">
                Quick view
              </div>
            </div>
          </a>

          <!-- Content -->
          <div class="p-4 flex-1 flex flex-col">
            <div class="grid grid-cols-2 gap-2 items-start">
              <h5 class="text-sm sm:text-base font-semibold text-slate-900 line-clamp-2 mb-2"><?php echo htmlspecialchars($row->name); ?></h5>
              <!-- Rating (static visually appealing) -->
              <div class="flex items-center text-yellow-400 ml-auto">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.636 1.122 6.545z" />
                </svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.636 1.122 6.545z" />
                </svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.636 1.122 6.545z" />
                </svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.636 1.122 6.545z" />
                </svg>
                <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.636 1.122 6.545z" />
                </svg>
              </div>
            </div>

            <div class="flex items-center gap-2">
              <!-- Price -->
              <div class="text-lg sm:text-xl font-bold text-emerald-600">BDT <?php echo number_format($row->price, 2); ?></div>
            </div>

            <!-- Actions (View details removed) -->
            <div class="mt-4">
              <a href="./add-to-cart.php?id=<?php echo urlencode($row->id); ?>" type="button"
                class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-white rounded-md bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition">
                Add to cart
              </a>

              <a href="./product-details.php?id=<?php echo urlencode($row->id); ?>"
                class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 rounded-md hover:bg-slate-200 transition">
                View details
              </a>
            </div>
          </div>

          <!-- Footer small actions -->
          <div class="p-3 border-t border-slate-100 flex items-center gap-2">
            <button title="Add to wishlist" class="ml-auto text-pink-500 hover:text-pink-600">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 21s-7-4.35-9-7.5C0 9 4 5 7.5 7.5 9 9 12 12 12 12s3-3 4.5-4.5C20 5 24 9 21 13.5 19 16.65 12 21 12 21z" />
              </svg>
            </button>
            <span class="text-xs text-slate-400">Ships in 1–3 days</span>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="flex justify-between items-center mt-4">
      <?php if ($pageNo > 1) { ?>
        <a href="?page=<?php echo $pageNo - 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
      <?php } else { ?>
        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed">Previous</span>
      <?php } ?>

      <span class="text-sm text-gray-700">Page <?php echo $pageNo; ?> of <?php echo $totalPage; ?></span>

      <?php if ($pageNo < $totalPage) { ?>
        <a href="?page=<?php echo $pageNo + 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next</a>
      <?php } else { ?>
        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed">Next</span>
      <?php } ?>
    </div>
  <?php } else { ?>
    <div class="p-4">
      <p class="text-sm text-slate-600">No products found.</p>
    </div>
  <?php } ?>
</div>