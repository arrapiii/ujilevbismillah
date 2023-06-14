<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="./css/style-landing.css">
    <script defer src="./js/script-landing.js"></script>
</head>
<body>
    <header class="header animate__animated animate__fadeInDown">
        <div class="header__content-wrapper" >
            <a href="#" class="header__logo" id="header__logo">
                <img src="./img/logotb.png" alt="" style="height: 6vw;">
            </a>

            <button class="menu-btn header__menu-btn" aria-label="toggle menu button" aria-pressed="true">
                <span class="menu-btn__bar menu-btn__bar--1" aria-hidden="true"></span>
                <span class="menu-btn__bar menu-btn__bar--2" aria-hidden="true"></span>
                <span class="menu-btn__bar menu-btn__bar--3" aria-hidden="true"></span>
            </button>

            <nav class="header__nav">
                <ul class="header__nav__list">

                    <li class="header__nav__list__item"><a class="header__nav__link" href="#abouts">About</a></li>
                    <li class="header__nav__list__item"><a class="header__nav__link" href="#faqs">FAQs</a></li>
                    <li class="header__nav__list__item"><a class="header__nav__link" href="#contacts">Contact</a></li>
                    <li class="header__nav__list__item"><a class="header__nav__link" href="#supports">Support</a></li>
                    <li class="header__nav__list__item"><a class="header__nav__link" href="/login"><span class="header__nav__link--login">Login</a></span></li>
                </ul>
                <div class="header__nav__social-icons">
                    <a href="#"><img src="./img/icon-facebook.svg" alt="facebook icon"></a>
                    <a href="#"><img src="./img/icon-twitter.svg" alt="twitter icon"></a>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero__content-wrapper">
            <div class="hero__img-wrapper">
                <img class="hero__img animate__animated animate__bounceInRight" src="./img/hero1.png" alt="tablet">
            </div>
            
            <div class="hero__text-wrapper animate__animated animate__fadeInLeft">
                <h1 class="hero__heading heading heading--primary">Starbhak Bimbingan Konseling</h1>
                <p class="hero__description paragraph">Tujuan utama ada nya pelajaran BK adalah membantu siswa mengatasi masalah pribadi, belajar mengenai diri mereka sendiri, dan mengembangkan keterampilan yang dibutuhkan untuk mencapai tujuan akademik dan kehidupan.</p>
                <div class="hero__btn-wrapper">
                    <!-- <button class="btn btn--blue animate__animated animate__tada animate__delay-1s">Get it on Chrome</button>
                    <button class="btn btn--grey animate__animated animate__tada animate__delay-2s">Get it on Firefox</button> -->
                </div>
            </div>
        </div>
    </section>

    <section class="features" aria-live="polite">
        <div class="features__content-wrapper">
            <div class="features__header">
                <h2 class="features__heading heading heading--secondary" style="font-size: 2.8rem;">Perkenalkan guru BK yang siap membimbing anda</h2>
                <p class="features__description paragraph">    Guru SMK Taruna Bhakti   bimbingan konseling 2023/2024</p>
            </div>

            <ul class="tabs">
                <li class="tabs__tab tabs__tab--active" id="tab-1" tabindex="0">Bu. Kasandra Fitriani N</li>
                <li class="tabs__tab" id="tab-2" tabindex="0">Bpk.  Ricky Sudrajat</li>
                <li class="tabs__tab" id="tab-3" tabindex="0">Bu. Heni Siswanti</li>
            </ul>

            <div class="feature" id="abouts">
                <div class="feature__img-wrapper">
                    <img id="feature__img" class="feature__img" src="./img/bucaca.png" alt="dashboard" >
                </div>
                <div class="feature__text-wrapper">
                    <h3 class="feature__heading heading heading--secondary">Bu. Kasandra Fitriani N</h3>
                    <p class="feature__description paragraph">Perkenalkan Bu. Kasandra Fitriani Nurjanah, bisa di panggil juga Bu Caca. Bu Caca terkenal sangat lucu dan seru Lho! ketika mengajar di kelas.</p>
                    <button class="feature__btn btn btn--blue">Show More</button>
                </div>
            </div>
        </div>
    </section>

    <section class="downloads" id="supports">
        <div class="downloads__content-wrapper">
            <h2 class="downloads__heading heading heading--secondary">Website ini didukung oleh Beberapa Organisasi Starbhak </h2>
            <p class="downloads__description paragraph"></p>
            <div class="downloads__card-wrapper">
                <article class="download-card">
                    <img class="download-card__img" src="./img/mpk.png" alt="chrome logo" >
                    {{-- <h4 class="download-card__heading">Absen Mahasiswa</h4>
                    <p class="download-card__subheading">M</p>
                    <button class="download-card__btn btn btn--blue">Go To Website</button> --}}
                </article>

                <article class="download-card download-card--2">
                    <img class="download-card__img" src="./img/perundungan.png" alt="chrome logo">
                    {{-- <h4 class="download-card__heading">Add to Firefox</h4>
                    <p class="download-card__subheading">Minimum version 55</p>
                    <button class="download-card__btn btn btn--blue">Go To Website</button> --}}
                </article>

                <article class="download-card">
                    <img class="download-card__img" src="./img/kesiswaan.png" alt="chrome logo">
                    {{-- <h4 class="download-card__heading">Add to Opera</h4>
                    <p class="download-card__subheading">Minimum version 46</p>
                    <button class="download-card__btn btn btn--blue">Go To Website</button> --}}
                </article>
            </div>
        </div>
    </section>

    <section class="faqs" id="faqs">
        <div class="faqs__content-wrapper">
            <h2 class="faqs__heading heading heading--secondary">Frequently Asked Questions</h2>
            <p class="faqs__description paragraph">Berikut adalah beberapa FAQ kami. Jika Anda memiliki pertanyaan lain yang ingin Anda jawab, jangan ragu untuk mengirim email kepada kami.</p>
            <div class="faqs__faqs-wrapper">
                <details class="faq">
                    <summary class="faq__question">Bagaimana mengukur keberhasilan dan efektivitas sebuah website bimbingan konseling?
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12" viewbox="0 0 18 12"><path fill="none" stroke="#5267DF" stroke-width="3" d="M1 1l8 8 8-8"/></svg>
                    </summary>
                    <p class="faq__answer">Tetapkan tujuan yang jelas untuk website bimbingan konseling dan tentukan indikator kinerja yang dapat diukur. Misalnya, jika tujuan adalah meningkatkan akses ke informasi bimbingan konseling, Anda dapat melacak jumlah unduhan materi, jumlah pengguna yang mengakses sumber daya tertentu, atau jumlah peserta dalam kegiatan bimbingan konseling online.</p>
                </details>

                <details class="faq">
                    <summary class="faq__question">Bagaimana menjaga keamanan dan privasi informasi siswa saat menggunakan website bimbingan konseling ?
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="12" viewbox="0 0 18 12"><path fill="none" stroke="#5267DF" stroke-width="3" d="M1 1l8 8 8-8"/></svg>
                    </summary>
                    <p class="faq__answer">Pastikan informasi siswa tidak dapat diakses oleh orang lain saat menggunakan website bimbingan konseling. Terapkan kebijakan yang memastikan bahwa pengguna harus keluar dari sesi mereka setelah selesai menggunakan website, dan pastikan tidak ada penyimpanan data login di komputer umum atau perangkat yang tidak aman.</p>
                </details>

                <details class="faq">
                    <summary class="faq__question">apakah sudah tersedia mobile app ?
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewbox="0 0 18 12"><path fill="none" stroke="#5267DF" stroke-width="3" d="M1 1l8 8 8-8"/></svg>
                    </summary>
                    <p class="faq__answer">Untuk Mobile App sudah tersedia dan support di versi android manapun.</p>
                </details>

                <details class="faq">
                    <summary class="faq__question">Bagaimana website bimbingan konseling dapat membantu siswa atau individu dalam mendapatkan layanan dan sumber daya yang dibutuhkan ?
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="12" viewbox="0 0 18 12"><path fill="none" stroke="#5267DF" stroke-width="3" d="M1 1l8 8 8-8"/></svg>
                    </summary>
                    <p class="faq__answer">Website bimbingan konseling menyediakan akses mudah dan cepat ke informasi penting yang berkaitan dengan bimbingan konseling. Hal ini mencakup informasi tentang pengembangan pribadi, kesehatan mental, pemilihan jurusan, karir, manajemen stres, hubungan interpersonal, dan banyak lagi. Siswa dapat mencari informasi ini kapan saja, sehingga mereka dapat memperoleh pemahaman yang lebih baik tentang topik yang relevan dengan kehidupan dan perkembangan mereka.</p>
                </details>
            </div>
            <button class="faqs__btn btn btn--blue">Show More</button>
        </div>
    </section>

    <section class="cta" id="contacts">
        <div class="cta__content-wrapper">
            <p class="cta__subheading">115+ Siswa-Siswi Starbhak sudah join</p>
            <h2 class="cta__heading" id="form-heading">Tetap up-to-date dengan apa yang kami lakukan</h2>
            <form class="cta__form">
                <input class="cta__input" type="text" placeholder="Enter your email address" aria-labelledby="form-heading" required>
                <button class="cta__btn btn btn--red">Contact Us</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="footer__content-wrapper">
            <nav class="footer__nav">
              <a href=""></a>
              <h5>Website Starbhak Bimbingan konseling adalah sebuah situs yang menyediakan Bimbingan untuk Siswa-Siswi SMK Taruna Bhakti, Didalam Situs ini juga kalian bisa memilih Jadwal bimbingan yang anda inginkan. Jadi meskipun kalian sudah memilih jadwal akan di infokan tanggal pertemuan guru BK, Bagi kalian yang ingin menggunakan situs Starbhak Bimbingan konseling yang satu ini, maka kalian tidak perlu khawatir tidak aman. Pasalnya kami sudah mendapatkan informasi dari beberapa Siswa-Siswi yang menggunakan situs ini dan terbukti aman.</h5>
            </nav>
            <div class="footer__social-links">
                
                {{-- <a href="#" class="footer__social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24"><title>Facebook Logo</title><path fill="#FFF" fill-rule="evenodd" d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                </a>

                <a href="#" class="footer__social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewbox="0 0 24 20"><title>Twitter Logo</title><path fill="#FFF" fill-rule="evenodd" d="M24 2.557a9.83 9.83 0 0 1-2.828.775A4.932 4.932 0 0 0 23.337.608a9.864 9.864 0 0 1-3.127 1.195A4.916 4.916 0 0 0 16.616.248c-3.179 0-5.515 2.966-4.797 6.045A13.978 13.978 0 0 1 1.671 1.149a4.93 4.93 0 0 0 1.523 6.574 4.903 4.903 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 0 1-2.224.084 4.928 4.928 0 0 0 4.6 3.419A9.9 9.9 0 0 1 0 17.54a13.94 13.94 0 0 0 7.548 2.212c9.142 0 14.307-7.721 13.995-14.646A10.025 10.025 0 0 0 24 2.557z"/></svg>
                </a> --}}
            </div>
        </div>
    </footer>

</body>
</html>