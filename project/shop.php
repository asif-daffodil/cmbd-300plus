  <?php
    require_once 'header.php';
    ?>
  <div class="flex">
      <div class="w-full max-w-[300px] shrink-0 shadow-md px-6 sm:px-8 min-h-screen py-6">
          <div class="flex items-center border-b border-gray-300 pb-2 mb-6">
              <h3 class="text-slate-900 text-lg font-semibold">Filter</h3>
              <button type="button" class="text-sm text-red-500 font-semibold ml-auto cursor-pointer">Clear all</button>
          </div>
          <div>
              <h6 class="text-slate-900 text-sm font-semibold">Brand</h6>
              <div class="flex px-3 py-1.5 rounded-md border border-gray-300 bg-gray-100 overflow-hidden mt-2">
                  <input type="email" placeholder="Search brand"
                      class="w-full bg-transparent outline-none text-gray-900 text-sm" />
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="w-3 fill-gray-600">
                      <path
                          d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                      </path>
                  </svg>
              </div>
              <ul class="mt-6 space-y-4">
                  <li class="flex items-center gap-3">
                      <input id="zara" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="zara" class="text-slate-600 font-medium text-sm cursor-pointer">Zara</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="hm" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="hm" class="text-slate-600 font-medium text-sm cursor-pointer">H&M</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="uniqlo" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="uniqlo" class="text-slate-600 font-medium text-sm cursor-pointer">Uniqlo</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="levis" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="levis" class="text-slate-600 font-medium text-sm cursor-pointer">Levi’s</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="nike" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="nike" class="text-slate-600 font-medium text-sm cursor-pointer">Nike</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="adidas" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="adidas" class="text-slate-600 font-medium text-sm cursor-pointer">Adidas</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="puma" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="puma" class="text-slate-600 font-medium text-sm cursor-pointer">Puma</label>
                  </li>
                  <li class="flex items-center gap-3">
                      <input id="tommy" type="checkbox"
                          class="w-4 h-4 cursor-pointer" />
                      <label for="tommy" class="text-slate-600 font-medium text-sm cursor-pointer">Tommy Hilfiger</label>
                  </li>
              </ul>
          </div>

          <hr class="my-6 border-gray-300" />

          <div>
              <h6 class="text-slate-900 text-sm font-semibold">Size</h6>
              <div class="flex flex-wrap gap-3 mt-4">
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XS</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">S</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">M</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">L</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XL</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XXL</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XXXL</button>
                  <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">4XL</button>
              </div>
          </div>

          <hr class="my-6 border-gray-300" />

          <div>
              <h6 class="text-slate-900 text-sm font-semibold">Price</h6>
              <div class="relative mt-6">
                  <div class="h-1.5 bg-gray-300 relative">
                      <div id="activeTrack" class="absolute h-1.5 bg-pink-500 rounded-full w-9/12"></div>
                  </div>
                  <input
                      type="range"
                      id="minRange"
                      min="0"
                      max="1000"
                      value="0"
                      class="absolute top-0 w-full h-1.5 bg-transparent appearance-none cursor-pointer 
                    [&::-webkit-slider-thumb]:appearance-none 
                    [&::-webkit-slider-thumb]:w-5 
                    [&::-webkit-slider-thumb]:h-5 
                    [&::-webkit-slider-thumb]:bg-pink-500 
                    [&::-webkit-slider-thumb]:rounded-full 
                    [&::-webkit-slider-thumb]:border-2 
                    [&::-webkit-slider-thumb]:border-white 
                    [&::-webkit-slider-thumb]:shadow-md 
                    [&::-webkit-slider-thumb]:cursor-pointer
                    [&::-moz-range-thumb]:w-5 
                    [&::-moz-range-thumb]:h-5 
                    [&::-moz-range-thumb]:bg-pink-500 
                    [&::-moz-range-thumb]:rounded-full 
                    [&::-moz-range-thumb]:border-2 
                    [&::-moz-range-thumb]:border-white 
                    [&::-moz-range-thumb]:shadow-md 
                    [&::-moz-range-thumb]:cursor-pointer
                    [&::-moz-range-thumb]:border-none" />

                  <input
                      type="range"
                      id="maxRange"
                      min="0"
                      max="1000"
                      value="750"
                      class="absolute top-0 w-full h-1.5 bg-transparent appearance-none cursor-pointer 
                    [&::-webkit-slider-thumb]:appearance-none 
                    [&::-webkit-slider-thumb]:w-5 
                    [&::-webkit-slider-thumb]:h-5 
                    [&::-webkit-slider-thumb]:bg-pink-500 
                    [&::-webkit-slider-thumb]:rounded-full 
                    [&::-webkit-slider-thumb]:border-2 
                    [&::-webkit-slider-thumb]:border-white 
                    [&::-webkit-slider-thumb]:shadow-md 
                    [&::-webkit-slider-thumb]:cursor-pointer
                    [&::-moz-range-thumb]:w-5 
                    [&::-moz-range-thumb]:h-5 
                    [&::-moz-range-thumb]:bg-pink-500 
                    [&::-moz-range-thumb]:rounded-full 
                    [&::-moz-range-thumb]:border-2 
                    [&::-moz-range-thumb]:border-white 
                    [&::-moz-range-thumb]:shadow-md 
                    [&::-moz-range-thumb]:cursor-pointer
                    [&::-moz-range-thumb]:border-none" />

                  <div class="flex justify-between text-slate-600 font-medium text-sm mt-4">
                      <span id="minPrice">$750</span>
                      <span id="maxPrice">$1000</span>
                  </div>
              </div>
          </div>

          <hr class="my-6 border-gray-300" />
      </div>

      <div class="w-full p-6">
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
              <div class="bg-gray-100 w-full h-48 rounded-md"></div>
          </div>
      </div>
  </div>
<?php  
    require_once 'footer.php';
?>