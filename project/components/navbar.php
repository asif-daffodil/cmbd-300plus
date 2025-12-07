<?php
session_start();
$pageName = basename($_SERVER['PHP_SELF']);
?>
<div class="shadow-lg tracking-wide relative z-50">
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
                (function() {
                    var input = document.getElementById('nav-search');
                    var clearBtn = document.getElementById('clearSearch');

                    function toggleClear() {
                        if (input.value.trim().length) clearBtn.classList.remove('hidden');
                        else clearBtn.classList.add('hidden');
                    }

                    clearBtn.addEventListener('click', function() {
                        input.value = '';
                        input.focus();
                        toggleClear();
                    });
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
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li class="flex text-[15px] max-lg:py-2 px-4">
                            <a href="./sign-in.php" class="px-4 py-2 text-sm text-slate-900 border border-slate-900 bg-transparent  cursor-pointer hover:bg-yellow-500 <?= $pageName == "sign-in.php" || $pageName == "sign-up.php" ? 'bg-yellow-500 font-bold' : '' ?>">Sign In/ Sign up</a>
                        </li>
                    <?php } else { ?>
                        <div class="relative w-max mx-auto">
                            <button type="button" id="dropdownToggle"
                                class="px-4 py-2 flex items-center rounded-lg text-slate-900 text-sm font-medium border border-slate-300 outline-none hover:bg-slate-100 cursor-pointer">
                                <img src="<?= $_SESSION['user']['image'] ?? 'https://readymadeui.com/profile_6.webp' ?>" class="w-7 h-7 mr-3 rounded-full shrink-0 object-cover"></img>
                                <?= $_SESSION['user']['name'] ?? null ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-slate-400 inline ml-3" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                        clip-rule="evenodd" data-original="#000000" />
                                </svg>
                            </button>

                            <ul id="dropdownMenu"
                                class="absolute hidden shadow-lg bg-white py-2 z-[1000] min-w-full w-max rounded-lg max-h-96 overflow-auto right-0">
                                <li
                                    class="dropdown-item">
                                    <a href="./user-profile.php" class="py-2.5 px-5 flex items-center hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-3" viewBox="0 0 512 512">
                                            <path
                                                d="M337.711 241.3a16 16 0 0 0-11.461 3.988c-18.739 16.561-43.688 25.682-70.25 25.682s-51.511-9.121-70.25-25.683a16.007 16.007 0 0 0-11.461-3.988c-78.926 4.274-140.752 63.672-140.752 135.224v107.152C33.537 499.293 46.9 512 63.332 512h385.336c16.429 0 29.8-12.707 29.8-28.325V376.523c-.005-71.552-61.831-130.95-140.757-135.223zM446.463 480H65.537V376.523c0-52.739 45.359-96.888 104.351-102.8C193.75 292.63 224.055 302.97 256 302.97s62.25-10.34 86.112-29.245c58.992 5.91 104.351 50.059 104.351 102.8zM256 234.375a117.188 117.188 0 1 0-117.188-117.187A117.32 117.32 0 0 0 256 234.375zM256 32a85.188 85.188 0 1 1-85.188 85.188A85.284 85.284 0 0 1 256 32z"
                                                data-original="#000000"></path>
                                        </svg>
                                        View profile
                                    </a>
                                </li>
                                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){ ?>
                                <li
                                    class="dropdown-item py-2.5 px-5 hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer">
                                    <a href="./admin" class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-3" viewBox="0 0 512 512">
                                            <path
                                                d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0"
                                                data-original="#000000"></path>
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <?php } ?>
                                <li
                                    class="dropdown-item">
                                    <a href="./Logout.php" class="flex items-center hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer py-2.5 px-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-3" viewBox="0 0 6.35 6.35">
                                            <path
                                                d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                                data-original="#000000"></path>
                                        </svg>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
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
                    class="hover:text-yellow-300 <?= $pageName == "index.php" ? "text-yellow-300" : "text-white" ?> text-[15px] font-normal block">Home</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./about.php'
                    class="hover:text-yellow-300 <?= $pageName == "about.php" ? "text-yellow-300" : "text-white" ?> text-[15px] font-normal block">About</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./shop.php'
                    class="hover:text-yellow-300 <?= $pageName == "shop.php" ? "text-yellow-300" : "text-white" ?> text-[15px] font-normal block">Shop</a></li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href='./contact.php'
                    class="hover:text-yellow-300 <?= $pageName == "contact.php" ? "text-yellow-300" : "text-white" ?> text-[15px] font-normal block">Contact</a></li>
        </ul>
    </div>
</div>
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


    document.addEventListener('DOMContentLoaded', () => {
        let dropdownToggle = document.getElementById('dropdownToggle');
        let dropdownMenu = document.getElementById('dropdownMenu');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('block');
        }

        function hideDropdown() {
            dropdownMenu.classList.add('hidden');
            dropdownMenu.classList.remove('block');
        }

        dropdownToggle.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevents triggering document click
            toggleDropdown();
        });

        // Hide dropdown when <li> is clicked
        dropdownMenu.querySelectorAll('.dropdown-item').forEach((li) => {
            li.addEventListener('click', () => {
                hideDropdown();
            });
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!dropdownMenu.contains(event.target) && event.target !== dropdownToggle) {
                hideDropdown();
            }
        });
    });
</script>