<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore')</title>
    <style>
        :root {
            --primary-color: #F97316; /* Orange */
            --secondary-color: #FFFFFF; /* White */
            --text-color: #1F2937;
            --footer-bg: #111827;
            --footer-text: #D1D5DB;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            background-color: #F3F4F6;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: var(--secondary-color);
        }

        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .nav-links li {
            margin-left: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--secondary-color);
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        /* Featured Book */
        .featured-book {
            background-color: var(--secondary-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .featured-book h2 {
            margin-top: 0;
            color: var(--primary-color);
        }

        /* Cards */
        .card {
            background-color: var(--secondary-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Footer */
        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer .container {
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
            }

            .nav-links {
                margin-top: 1rem;
            }

            .nav-links li {
                margin: 0 0.75rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <header class="header">
        <div class="container">
            <a href="/" class="logo">BookStore</a>
            <nav>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/books">Books</a></li>
                    <li><a href="/categories">Categories</a></li>
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @php
                $featuredBook = $randomBook ?? \App\Models\Book::inRandomOrder()->first();
            @endphp

            @if($featuredBook)
                <section class="featured-book">
                    <h2>Featured Book</h2>
                    <div class="book-details">
                        <h3>{{ $featuredBook->title }}</h3>
                        <p><strong>Author:</strong> {{ $featuredBook->author }}</p>
                        <p>{{ Str::limit($featuredBook->description, 150) }}</p>
                        <a href="/books/{{ $featuredBook->id }}">Read more...</a>
                    </div>
                </section>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
