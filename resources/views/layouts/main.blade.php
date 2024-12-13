<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-light antialiased">
    <header class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
        <div id="header-left" class="flex items-center">
            <div class="text-gray-800 font-semibold">
                <span class="text-yellow-500 text-xl">&lt;YELO&gt;</span> Code
            </div>
            <div class="top-menu ml-10">
                <ul class="flex space-x-4">
                    <li>
                        <a class="flex space-x-2 items-center hover:text-yellow-900 text-sm text-yellow-500"
                            href="http://127.0.0.1:8000">
                            Home
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                            href="http://127.0.0.1:8000/blog">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                            href="http://127.0.0.1:8000/blog">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                            href="http://127.0.0.1:8000/blog">
                            Contact Us
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                            href="http://127.0.0.1:8000/blog">
                            Terms
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="header-right" class="flex items-center md:space-x-6">
            <div class="flex space-x-5">
                <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                    href="http://127.0.0.1:8000/login">
                    Login
                </a>
                <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
                    href="http://127.0.0.1:8000/register">
                    Register
                </a>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
        <a class="text-gray-500 hover:text-yellow-500" href="">About Us</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Help</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Login</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Explore</a>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>