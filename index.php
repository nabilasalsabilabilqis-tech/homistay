<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>homistay - Reservasi Penginapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="site-navbar">

        <div class="logo">
            homistay
        </div>

        <nav class="nav-menu">
            <a href="index.php">Beranda</a>
            <a href="#kamar">Kamar</a>
            <a href="#tentang">Tentang</a>
            <a href="#kontak">Kontak</a>
        </nav>

    </header>


    <!-- BANNER UTAMA -->
    <section class="hero">

        <div class="hero-content">

            <h1>
                Temukan Penginapan
                Nyaman Untuk Anda
            </h1>

            <p>
                Nikmati pengalaman menginap yang
                menyenangkan dengan fasilitas terbaik
                dan proses reservasi yang mudah.
            </p>

            <a href="#kamar"
             class="btn">
                Jelajahi Kamar
            </a>

        </div>

    </section>


    <!-- PENCARIAN -->
    <section class="search-box">

        <h3>Cari Penginapan Anda</h3>

        <div class="search-form">

            <input type="date" id="checkin">

            <input type="date" id="checkout">

            <input type="number"
                   min="1"
                   placeholder="Jumlah tamu">

            <a href="#kamar" 
            class="btn">
                Cari Kamar
            </a>

        </div>

    </section>


    <!-- DAFTAR KAMAR -->
    <section class="rooms" id="kamar">

        <div class="section-title">

            <h2>Kamar Unggulan</h2>

            <p>
                Pilihan kamar terbaik untuk kenyamanan Anda
            </p>

        </div>


        <div class="room-container">


            <div class="room-card">

                <img src="assets/deluxe.jpg"
                     alt="Kamar Deluxe">

                <div class="room-info">

                    <h3>Deluxe Room</h3>

                    <p>
                        Kamar nyaman dengan fasilitas
                        lengkap dan suasana tenang.
                    </p>

                    <div class="price">
                        Rp550.000 / malam
                    </div>

                    <br>
                    <a href="detail.php?
                    kamar=Deluxe%20Room" 
                    class="btn">
                        lihat Detail
                    </a>
                        
                </div>

            </div>


            <div class="room-card">

                <img src="assets/suite.jpg"
                     alt="Kamar Suite">

                <div class="room-info">

                    <h3>Suite Room</h3>

                    <p>
                        Kamar luas dengan desain
                        elegan dan fasilitas premium.
                    </p>

                    <div class="price">
                        Rp750.000 / malam
                    </div>

                    <br>

                    <a href="detail.php?
                    kamar=Suite%20Room" 
                    class="btn">
                        lihat Detail
                    </a>

                </div>

            </div>


            <div class="room-card">

                <img src="assets/standar room.jpg"
                     alt="Kamar Standard">

                <div class="room-info">

                    <h3>Standard Room</h3>

                    <p>
                        Pilihan kamar ekonomis
                        dengan fasilitas nyaman.
                    </p>

                    <div class="price">
                        Rp200.000 / malam
                    </div>

                    <br>
                    <a href="detail.php?
                    kamar=Standard%20Room" 
                    class="btn">
                        lihat Detail
                    </a>

                </div>

            </div>


        </div>

    </section>


    <!-- TENTANG -->
    <section class="about" id="tentang">

        <h2>Tentang homistay</h2>

        <p>
            homistay merupakan website reservasi
            penginapan yang membantu pelanggan
            menemukan kamar, melihat fasilitas,
            mengetahui harga, dan melakukan
            pemesanan dengan mudah.
        </p>

    </section>


    <!-- FOOTER -->
    <footer class="footer" id="kontak">

        <p>
            © 2026 homistay.
            Website Reservasi Penginapan.
        </p>

    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>