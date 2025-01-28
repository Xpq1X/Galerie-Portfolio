<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        a {
            color: #ff0000;
        }

        a:hover {
            color: #ff5555;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gray-900 p-4 text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Welcome to the Gallery</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-white">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Gallery Section -->
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-3xl font-semibold mb-4 text-center">Gallery</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach (['image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg'] as $image)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('images/'.$image) }}" alt="Gallery Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-white">Image {{ $loop->index + 1 }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
