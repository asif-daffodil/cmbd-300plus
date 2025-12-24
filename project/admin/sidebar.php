<?php
    $isProductsOpen = false;
    $isOrdersOpen = false;
    if (isset($_SERVER['REQUEST_URI'])) {
        $currentUrl = $_SERVER['REQUEST_URI'];
        if (strpos($currentUrl, 'product') !== false) {
            $isProductsOpen = true;
        }
        if (strpos($currentUrl, 'order') !== false) {
            $isOrdersOpen = true;
        }
    }
?>

<nav id="sidebar" class="lg:w-[270px] max-lg:fixed transition-all duration-500 shrink-0 z-[100]">
            <div id="sidebar-collapse-menu"
                class="bg-[#081028] shadow-lg h-screen fixed top-0 left-0 overflow-auto overflow-x-hidden z-[99] lg:w-[270px] max-lg:w-0 max-lg:invisible transition-all duration-500">
                <div class="bg-[#081028] flex items-center gap-4 pt-6 pb-2 px-4 sticky top-0 min-h-[64px] z-[100]">
                    <a href="./" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 140" class="w-8 h-8">
                            <path fill="#017bfe"
                                d="M70.5 84.5c-.2373-1.291.096-2.291 1-3 21.8405.3271 32.341-10.3395 31.5-32-2.5-10.5-9-17-19.5-19.5-24.6667-.3333-49.3333-.6667-74-1-.77972-1.073-.61305-2.2396.5-3.5C16.1349 18.364 22.6349 11.5307 29.5 5l6-3c19-.66667 38-.66667 57 0 32.848 7.87547 47.348 28.7088 43.5 62.5-1.027 4.1079-2.36 8.1079-4 12-5.389 7.4915-11.222 14.4915-17.5 21 7.198 12.561 14.532 25.061 22 37.5-.145.772-.478 1.439-1 2-9.333.667-18.667.667-28 0l-6-3c-10.5578-16.384-20.8911-32.884-31-49.5Z" />
                            <path fill="#ffffff"
                                d="M71.5 81.5c-.904.709-1.2373 1.709-1 3-6.5003-1.3148-13.0003-1.3148-19.5 0-2.9442 16.274-5.6109 32.608-8 49-.5 1.167-1.3333 2-2.5 2.5-8.5921 2.14-17.0921 1.973-25.5-.5 1.6773-17.058 3.6773-34.058 6-51-6.0758-.9764-12.24243-1.3097-18.5-1-.15668-1.3734.00999-2.7068.5-4 10.3693-10.7008 20.3693-21.7008 30-33 2.754-3.2621 5.9206-5.9288 9.5-8 1.5293.0288 2.696.6955 3.5 2 8.3287 13.8168 16.8287 27.4835 25.5 41Z" />
                        </svg>
                        <p class="text-base font-semibold text-gray-300 tracking-wide">Dashboard</p>
                    </a>

                    <button id="close-sidebar" class="ml-auto cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M.13 17.05a1.41 1.41 0 0 1 1.41-1.41H10a1.41 1.41 0 1 1 0 2.82H1.54a1.41 1.41 0 0 1-1.41-1.41zm0-14.1a1.41 1.41 0 0 1 1.41-1.41h16.92a1.41 1.41 0 1 1 0 2.82H1.54A1.41 1.41 0 0 1 .13 2.95zm0 7.05a1.41 1.41 0 0 1 1.41-1.41h16.92a1.41 1.41 0 1 1 0 2.82H1.54A1.41 1.41 0 0 1 .13 10z"
                                clip-rule="evenodd" data-original="#000000" />
                        </svg>
                    </button>
                </div>

                <div class="py-4 px-4">
                    <ul class="space-y-2 mt-6">
                        <li>
                            <a href="./"
                                class="text-gray-300 text-sm font-medium flex items-center cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2.5 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z"
                                        data-original="#000000" />
                                    <path
                                        d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z"
                                        data-original="#000000" />
                                </svg>
                                <span class="overflow-hidden text-ellipsis whitespace-nowrap">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)"
                                class="text-gray-300 text-sm font-medium flex items-center cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2.5 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4H6c-2.206 0-4-1.794-4-4V6c0-2.206 1.794-4 4-4zm0-2H6a6 6 0 0 0-6 6v12a6 6 0 0 0 6 6h12a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6z"
                                        data-original="#000000" />
                                    <path d="M12 18a1 1 0 0 1-1-1V7a1 1 0 0 1 2 0v10a1 1 0 0 1-1 1z" data-original="#000000" />
                                    <path d="M6 12a1 1 0 0 1 1-1h10a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1z" data-original="#000000" />
                                </svg>
                                <span class="overflow-hidden text-ellipsis whitespace-nowrap">Products</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="arrowIcon w-2.5 h-2.5 fill-current <?php echo $isProductsOpen ? 'rotate-0' : '-rotate-90' ?> ml-auto transition-all duration-500"
                                    viewBox="0 0 451.847 451.847">
                                    <path
                                        d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                        data-original="#000000" />
                                </svg>
                            </a>
                            <ul class="sub-menu <?= $isProductsOpen ? 'max-h-[500px]' : 'max-h-0' ?> overflow-hidden transition-[max-height] duration-500 ease-in-out ml-8">
                                <li>
                                    <a href="./all-products.php"
                                        class="text-gray-300 text-sm font-medium block cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2 transition-all duration-300">
                                        <span>All Products</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="./add-new-product.php"
                                        class="text-gray-300 text-sm font-medium block cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2 transition-all duration-300">
                                        <span>Add new Products</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0)"
                                class="text-gray-300 text-sm font-medium flex items-center cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2.5 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                    viewBox="0 0 510 510">
                                    <g fill-opacity=".9">
                                        <path
                                            d="M255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                            data-original="#000000" />
                                        <path d="M267.75 127.5H229.5v153l132.6 81.6 20.4-33.15-114.75-68.85z" data-original="#000000" />
                                    </g>
                                </svg>
                                <span class="overflow-hidden text-ellipsis whitespace-nowrap">Orders</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="arrowIcon w-2.5 h-2.5 fill-current -rotate-90 ml-auto transition-all duration-500"
                                    viewBox="0 0 451.847 451.847">
                                    <path
                                        d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                        data-original="#000000" />
                                </svg>
                            </a>
                            <ul class="sub-menu max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out ml-8">
                                <li>
                                    <a href="./pending-orders.php"
                                        class="text-gray-300 text-sm font-medium block cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2 transition-all duration-300">
                                        <span>Pending</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="./completed-orders.php"
                                        class="text-gray-300 text-sm font-medium block cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2 transition-all duration-300">
                                        <span>Completed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <hr class="border-gray-600 my-6" />

                    <div>
                        <ul class="space-y-2">
                            <li>
                                <a href="javascript:void(0)"
                                    class="text-gray-300 text-sm font-medium flex items-center cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2.5 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                        viewBox="0 0 214.27 214.27">
                                        <path
                                            d="M196.926 55.171c-.11-5.785-.215-11.25-.215-16.537a7.5 7.5 0 0 0-7.5-7.5c-32.075 0-56.496-9.218-76.852-29.01a7.498 7.498 0 0 0-10.457 0c-20.354 19.792-44.771 29.01-76.844 29.01a7.5 7.5 0 0 0-7.5 7.5c0 5.288-.104 10.755-.215 16.541-1.028 53.836-2.436 127.567 87.331 158.682a7.495 7.495 0 0 0 4.912 0c89.774-31.116 88.368-104.849 87.34-158.686zm-89.795 143.641c-76.987-27.967-75.823-89.232-74.79-143.351.062-3.248.122-6.396.164-9.482 30.04-1.268 54.062-10.371 74.626-28.285 20.566 17.914 44.592 27.018 74.634 28.285.042 3.085.102 6.231.164 9.477 1.032 54.121 2.195 115.388-74.798 143.356z"
                                            data-original="#000000" />
                                        <path
                                            d="m132.958 81.082-36.199 36.197-15.447-15.447a7.501 7.501 0 0 0-10.606 10.607l20.75 20.75a7.477 7.477 0 0 0 5.303 2.196 7.477 7.477 0 0 0 5.303-2.196l41.501-41.5a7.498 7.498 0 0 0 .001-10.606 7.5 7.5 0 0 0-10.606-.001z"
                                            data-original="#000000" />
                                    </svg>
                                    <span>Security</span>
                                </a>
                            </li>
                            <li>
                                <a href="../"
                                    class="text-gray-300 text-sm font-medium flex items-center cursor-pointer hover:bg-[#0b1739] rounded-md px-3 py-2.5 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                        viewBox="0 0 64 64">
                                        <path
                                            d="M61.4 29.9h-6.542a9.377 9.377 0 0 0-18.28 0H2.6a2.1 2.1 0 0 0 0 4.2h33.978a9.377 9.377 0 0 0 18.28 0H61.4a2.1 2.1 0 0 0 0-4.2Zm-15.687 7.287A5.187 5.187 0 1 1 50.9 32a5.187 5.187 0 0 1-5.187 5.187ZM2.6 13.1h5.691a9.377 9.377 0 0 0 18.28 0H61.4a2.1 2.1 0 0 0 0-4.2H26.571a9.377 9.377 0 0 0-18.28 0H2.6a2.1 2.1 0 0 0 0 4.2Zm14.837-7.287A5.187 5.187 0 0 1 22.613 11a5.187 5.187 0 0 1-10.364 0 5.187 5.187 0 0 1 5.187-5.187ZM61.4 50.9H35.895a9.377 9.377 0 0 0-18.28 0H2.6a2.1 2.1 0 0 0 0 4.2h15.015a9.377 9.377 0 0 0 18.28 0H61.4a2.1 2.1 0 0 0 0-4.2Zm-34.65 7.287A5.187 5.187 0 1 1 31.937 53a5.187 5.187 0 0 1-5.187 5.187Z"
                                            data-name="Layer 47" data-original="#000000" />
                                    </svg>
                                    <span>Website</span>
                                </a>
                            </li>
                        </ul>

                        <div class="mt-6 flex items-center cursor-pointer">
                            <img src='../<?= $_SESSION['user']['image'] ?? "https://readymadeui.com/profile.webp" ?>'
                                class="w-9 h-9 rounded-full border-2 border-gray-600 shrink-0" />
                            <div class="ml-4">
                                <p class="text-sm text-gray-300 whitespace-nowrap"><?= $_SESSION['user']['name'] ?></p>
                                <p class="text-xs text-gray-400 whitespace-nowrap">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <button id="open-sidebar" class="ml-auto fixed top-[30px] left-[18px] cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M.13 17.05a1.41 1.41 0 0 1 1.41-1.41H10a1.41 1.41 0 1 1 0 2.82H1.54a1.41 1.41 0 0 1-1.41-1.41zm0-14.1a1.41 1.41 0 0 1 1.41-1.41h16.92a1.41 1.41 0 1 1 0 2.82H1.54A1.41 1.41 0 0 1 .13 2.95zm0 7.05a1.41 1.41 0 0 1 1.41-1.41h16.92a1.41 1.41 0 1 1 0 2.82H1.54A1.41 1.41 0 0 1 .13 10z"
                    clip-rule="evenodd" data-original="#000000" />
            </svg>
        </button>