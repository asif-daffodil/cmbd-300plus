<?php  
    $pageName = basename($_SERVER['PHP_SELF']);
?>
<header class="shadow-lg tracking-wide relative z-50">
    <section
        class="flex items-center relative py-3 lg:px-10 px-4 border-gray-200 border-b bg-white lg:min-h-[70px] max-lg:min-h-[60px]">
        <a href="javascript:void(0)" class="shrink-0 max-sm:hidden"><img
                src="https://readymadeui.com/readymadeui.svg" alt="logo" class="sm:w-[150px] w-32" />
        </a>
        <a href="javascript:void(0)" class="hidden max-sm:block"><img src="https://readymadeui.com/readymadeui-short.svg" alt="logo" class="w-12" />
        </a>

        <div class="flex flex-wrap w-full items-center">
            <form action="" method="get" class="flex items-center lg:ml-10 max-md:mt-4 max-lg:ml-4 w-full max-w-xl">
                <label for="nav-search" class="sr-only">Search</label>
                <div class="relative flex-1">
                    <i class="fas fa-search text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" aria-hidden="true"></i>

                    <input id="nav-search" name="q" type="search" placeholder="Search ptoduct..." autocomplete="off"
                           class="w-full pl-10 pr-36 h-10 rounded-full bg-gray-100 border border-gray-200 focus:bg-white focus:shadow-md focus:border-yellow-300 transition duration-150 text-sm outline-none" />

                    <button id="clearSearch" type="button" title="Clear" class="hidden absolute right-28 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>

                    <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 bg-yellow-300 hover:bg-yellow-500 text-black px-4 py-1.5 rounded-full text-sm shadow cursor-pointer">
                        Search
                    </button>
                </div>
            </form>

            <script>
                (function(){
                    var input = document.getElementById('nav-search');
                    var clearBtn = document.getElementById('clearSearch');

                    function toggleClear(){
                        if (input.value.trim().length) clearBtn.classList.remove('hidden');
                        else clearBtn.classList.add('hidden');
                    }

                    clearBtn.addEventListener('click', function(){ input.value = ''; input.focus(); toggleClear(); });
                    input.addEventListener('input', toggleClear);
                    // init
                    toggleClear();
                })();
            </script>
            <div class="ml-auto">

                <ul class="flex items-center">
                    <li class="max-lg:py-2 px-4 cursor-pointer">
                        <span class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline" viewBox="0 0 512 512">
                                <path
                                    d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                                    data-original="#000000"></path>
                            </svg>
                            <span
                                class="absolute left-auto -ml-1 -top-2 rounded-full bg-red-500 px-1 py-0 text-xs text-white">3</span>
                        </span>
                    </li>
                    <li class="flex text-[15px] max-lg:py-2 px-4">
                        <button
                            class="px-4 py-2 text-sm font-medium text-slate-900 border border-slate-900 bg-transparent cursor-pointer">Sign
                            In</button>
                    </li>
                    <li id="toggleOpen" class="lg:hidden">
                        <button class="cursor-pointer">
                            <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div id="collapseMenu"
        class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50">
        <button id="toggleClose" class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000"></path>
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000"></path>
            </svg>
        </button>

        <ul
            class="lg:flex lg:flex-wrap lg:items-center lg:justify-center px-10 py-3 bg-[#333] min-h-[46px] gap-4 max-lg:space-y-4 max-lg:fixed max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-lg max-lg:overflow-auto z-50 overflow-auto">
            <li class="mb-6 hidden max-lg:block">
                <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui-white.svg" alt="logo" class="w-36" />
                </a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./'
                    class="hover:text-yellow-300 <?= $pageName == "index.php" ? "text-yellow-300":"text-white" ?> text-[15px] font-normal block">Home</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./about.php'
                    class="hover:text-yellow-300 <?= $pageName == "about.php" ? "text-yellow-300":"text-white" ?> text-[15px] font-normal block">About</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./shop.php'
                    class="hover:text-yellow-300 <?= $pageName == "shop.php" ? "text-yellow-300":"text-white" ?> text-[15px] font-normal block">Shop</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./contact.php'
                    class="hover:text-yellow-300 <?= $pageName == "contact.php" ? "text-yellow-300":"text-white" ?> text-[15px] font-normal block">Contact</a></li>
        </ul>
    </div>
</header>
<script>
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
        if (collapseMenu.style.display === 'block') {
            collapseMenu.style.display = 'none';
        } else {
            collapseMenu.style.display = 'block';
        }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);
</script>