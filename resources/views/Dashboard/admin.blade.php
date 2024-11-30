<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <title>Dashboard Toko Buku</title>

    <style>
        /* Background Vintage Style */
        body {
            background: url('{{ asset('images/library.jpeg') }}') rgba(0, 0, 0, 0.3);
            background-blend-mode: multiply;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Merriweather', serif;
            color: #3E2A47;
            margin: 0;
            padding: 0;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: white;
        }

        /* Teks pada navbar di dark mode */
        body.dark-mode .navbar-brand,
        body.dark-mode .nav-link,
        body.dark-mode .dropdown-item {
            color: white;
        }

        /* Teks pada konten di dark mode */
        body.dark-mode .container h1,
        body.dark-mode .container p,
        body.dark-mode .list-group-item {
            color: white;
        }

        /* Search bar teks warna putih */
        body.dark-mode .form-control {
            color: white;
            background-color: #333;
        }

        /* Teks tombol dark mode */
        body.dark-mode #dark-mode-toggle {
            color: white;
        }

        /* Navbar */
        .navbar {
            background-color: transparent; /* Menghapus kotak putih dan memberi transparansi */
            border-bottom: 2px solid #e0e0e0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding-left: 10px; /* Mengurangi jarak kiri navbar */
            padding-right: 10px; /* Mengurangi jarak kanan navbar */
        }

        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-size: 24px;
            font-weight: 700;
            color: #6f4f32; /* Vintage brown color */
            margin-right: 20px; /* Mengurangi jarak antara logo dan item navbar */
        }

        /* Change color of nav items to green */
        .nav-link, .dropdown-item {
            font-size: 16px;
            font-weight: 600;
            color: #28a745; /* Green color */
        }

        .nav-link:hover, .dropdown-item:hover {
            color: #3e2a47; /* Darker shade for hover */
        }

        .navbar-toggler-icon {
            background-color: #6f4f32; /* Vintage brown color */
        }

        .navbar-nav {
            margin-left: 30px; /* Menambah sedikit jarak dari logo */
        }

        /* Search Bar */
        .form-control {
            border-radius: 25px;
            box-shadow: none;
            font-size: 16px;
        }

        .btn-outline-success {
            border-radius: 25px;
            color: #6f4f32;
            border-color: #6f4f32;
        }

        .btn-outline-success:hover {
            background-color: #6f4f32;
            color: white;
        }

        /* Dark Mode Toggle Button */
        #dark-mode-toggle {
            border-radius: 25px;
            background-color: #3e2a47;
            color: white;
            font-weight: 600;
        }

        #dark-mode-toggle:hover {
            background-color: #6f4f32;
        }

        /* Cart Icon and Profile */
        .navbar-nav .nav-item {
            margin-left: 20px;
        }

        /* Main Content Container */
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            /* Remove background to avoid white box */
            background-color: transparent;
        }

        .list-group-item {
            border: 1px solid #e0e0e0;
            background-color: #f9f9f9;
            color: #6f4f32;
        }

        .list-group-item:hover {
            background-color: #e0e0e0;
        }

        /* Back to Top Button */
        #back-to-top {
            background-color: #6f4f32;
            color: white;
            border-radius: 50%;
            border: none;
            width: 50px;
            height: 50px;
            font-size: 18px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
            display: none;
        }

        #back-to-top:hover {
            background-color: #3e2a47;
        }

        /* Margin and Padding Adjustments */
        .navbar, .container {
            margin-left: 15px;
            margin-right: 15px;
        }

        /* Refined Layout */
        .container {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        /* Keep the text color for "Selamat datang" as default */
        .container h1, .container p {
            color: #6f4f32; ;
        }

        /* Search Bar Adjustment */
        .position-relative {
            margin-left: -5px; /* Menarik sedikit search bar ke kiri */
        }
    </style>
</head>
<body class="vh-100 overflow-hidden">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Toko Buku</a>

        <!-- Navbar links and Search -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Mengelola Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mengelola Stok Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Memantau Pesanan</a>
                </li>
            </ul>

            <!-- Search Bar with Suggestions -->
            <div class="position-relative">
                <input class="form-control me-2" id="search-bar" type="search" placeholder="Search" aria-label="Search">
                <ul id="search-suggestions" class="list-group position-absolute" style="z-index: 1000; display: none; width: 100%;">
                    <li class="list-group-item">Book 1</li>
                    <li class="list-group-item">Book 2</li>
                    <li class="list-group-item">Book 3</li>
                </ul>
            </div>

            <!-- User Profile and Notifications -->
            <ul class="navbar-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarProfile">
                        <li><a class="dropdown-item" href="#">My Account</a></li>
                        <li><a class="dropdown-item" href="#">Orders</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-bell-fill"></i> Notifikasi
                    </a>
                </li>
                <li class="nav-item">
                    <button id="dark-mode-toggle" class="btn btn-outline-dark">
                        🌙
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1>Selamat datang di Toko Buku</h1>
        <p>Atur buku dan pemesanan dengan mudah.</p>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" title="Back to top">↑</button>

    <!-- Scripts -->
    <script>
        const searchBar = document.getElementById("search-bar");
        const suggestions = document.getElementById("search-suggestions");

        searchBar.addEventListener("input", function() {
            const query = searchBar.value.trim();

            if (query) {
                suggestions.style.display = "block";
            } else {
                suggestions.style.display = "none";
            }
        });

        document.querySelector("#dark-mode-toggle").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
        });
    </script>
</body>
</html>
