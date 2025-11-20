<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #E85D17;
            --secondary-orange: #FF6B35;
            --white: #FFFFFF;
            --light-gray: #F5F5F5;
            --text-dark: #333333;
            --text-gray: #666666;
            --border-gray: #E0E0E0;
            --discount-red: #E74C3C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Helvetica Neue', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--primary-orange);
            color: var(--white);
            padding: 0.5rem 0;
            font-size: 0.85rem;
        }

        .top-bar .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }

        .top-bar a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .top-bar a:hover {
            opacity: 0.8;
        }

        /* Main Header */
        .header {
            background-color: var(--white);
            padding: 1.5rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
            color: var(--primary-orange);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary-orange);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* Search Bar */
        .search-bar {
            flex: 1;
            max-width: 600px;
        }

        .search-form {
            display: flex;
            border: 2px solid var(--border-gray);
            border-radius: 4px;
            overflow: hidden;
        }

        .search-form input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            outline: none;
            font-size: 0.95rem;
        }

        .search-form button {
            background-color: var(--primary-orange);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: var(--secondary-orange);
        }

        /* Header Icons */
        .header-icons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .header-icons a {
            color: var(--text-dark);
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .header-icons a:hover {
            color: var(--primary-orange);
        }

        /* Navigation Menu */
        .nav-menu {
            background-color: var(--white);
            border-top: 1px solid var(--border-gray);
            padding: 0;
        }

        .nav-menu .container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .menu-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            padding: 1rem 0;
            display: block;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary-orange);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-button {
            background: none;
            border: none;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .user-button:hover {
            color: var(--primary-orange);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--white);
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            border-radius: 4px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a, .dropdown-content button {
            color: var(--text-dark);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover, .dropdown-content button:hover {
            background-color: var(--light-gray);
        }

        .dropdown-content form {
            margin: 0;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.5rem;
            color: var(--text-dark);
            margin: 0;
        }

        .section-header a {
            color: var(--primary-orange);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .section-header a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background-color: #2C2C2C;
            color: #CCCCCC;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }

        .footer .container {
            text-align: center;
        }

        .footer p {
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #CCCCCC;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                gap: 1rem;
            }

            .search-bar {
                width: 100%;
                max-width: 100%;
            }

            .nav-links {
                flex-direction: column;
                gap: 0;
            }

            .top-bar .container {
                flex-wrap: wrap;
                gap: 0.5rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <a href="#">Bookstore Network</a>
            <span>|</span>
            <a href="#">Reader Card</a>
            <span>|</span>
            <a href="#">Cultural Agenda</a>
            <span>|</span>
            <a href="#">Blog</a>
        </div>
    </div>

    <!-- Main Header -->
    <header class="header">
        <div class="container">
            <a href="/" class="logo">
                <div class="logo-icon">B</div>
                <span>BOOKSTORE</span>
            </a>

            <div class="search-bar">
                <form action="{{ route('books.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Search for books, authors..." value="{{ request('search') }}">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="header-icons">
                @auth
                    <div class="user-dropdown">
                        <button class="user-button" onclick="toggleDropdown(event)">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-content" id="userDropdown">
                            <a href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
                            <a href="{{ route('sales.index') }}">My Purchases</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" title="Login">
                        <i class="fas fa-user"></i>
                    </a>
                @endauth
                <a href="#" title="Wishlist">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="#" title="Cart">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="nav-menu">
        <div class="container">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
                <span>Menu</span>
            </button>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/books">New Releases</a></li>
                <li><a href="/categories">Categories</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Help</a>
            </div>
            <p>&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
    
    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.user-button')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown && dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        }
    </script>
</body>
</html>
