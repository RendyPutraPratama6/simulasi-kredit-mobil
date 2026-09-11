<?php

$harga_mobil = 0;
$dp_persen   = "";
$tenor_tahun = "";

$nominal_dp         = 0;
$bunga_rp           = 0;
$total_bulan        = 0;
$angsuran_per_bulan = 0;

$bunga_persen = 20;
$is_calculated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $harga_mobil = isset($_POST['harga_mobil']) ? (float)$_POST['harga_mobil'] : 0;
    $dp_persen   = isset($_POST['dp_persen']) ? (float)$_POST['dp_persen'] : 0;
    $tenor_tahun = isset($_POST['tenor']) ? (int)$_POST['tenor'] : 0;

    if ($harga_mobil > 0 && $dp_persen > 0 && $tenor_tahun > 0) {
        $bunga_rp = ($bunga_persen / 100) * $harga_mobil;
        $nominal_dp = ($dp_persen / 100) * $harga_mobil;
        $total_bulan = $tenor_tahun * 12;
        $angsuran_per_bulan = (($harga_mobil + $bunga_rp) - $nominal_dp) / $total_bulan;

        $is_calculated = true;
    }
}

function formatRupiah($angka) {
    return "Rp. " . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Kredit Mobil - LSP Teknologi Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white border-b shadow-sm fixed w-full z-10">
        <div class="max-w-4xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="https://via.placeholder.com/40" class="h-10 w-10 rounded-full bg-gray-300" alt="Logo Perusahaan">
                <span class="text-lg font-bold text-gray-900">Nama Perusahaan</span>
            </div>
            <nav class="flex space-x-6 mt-2 md:mt-0">
                <a href="#" class="text-blue-600 font-bold hover:underline">Beranda</a>
                <a href="#tentangperusahaan" class="text-gray-600 hover:text-gray-900">Tentang Perusahaan</a>
                <a href="#footer" class="text-gray-600 hover:text-gray-900">Kontak Perusahaan</a>
            </nav>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 my-6 mt-[100px] flex-grow w-full" >
        <div class="relative w-full h-56 md:h-64 rounded-lg overflow-hidden mb-6 shadow-md bg-gray-200">
            <div class="slider-item absolute inset-0 transition-opacity duration-500 opacity-100">
                <img src="https://picsum.photos/1200/400?random=1" class="w-full h-full object-cover" alt="Slider 1">
                <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">Mobil Impian Keluarga</div>
            </div>
            <div class="slider-item absolute inset-0 transition-opacity duration-500 opacity-0">
                <img src="https://picsum.photos/1200/400?random=2" class="w-full h-full object-cover" alt="Slider 2">
                <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">Proses Cepat & Bunga Ringan</div>
            </div>
            <div class="slider-item absolute inset-0 transition-opacity duration-500 opacity-0">
                <img src="https://picsum.photos/1200/400?random=3" class="w-full h-full object-cover" alt="Slider 3">
                <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">DP Murah & Angsuran Transparan</div>
            </div>
            <button id="prevBtn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-2 rounded-full">❮</button>
            <button id="nextBtn" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-2 rounded-full">❯</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6" id="tentangperusahaan">
            <div class="bg-white p-6 rounded-lg border shadow-sm flex flex-col justify-center">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Tentang Perusahaan</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Kami adalah penyedia layanan pembiayaan mobil terpercaya yang membantu Anda mendapatkan kendaraan impian dengan proses cepat dan angsuran transparan.
                </p>
            </div>
            <div class="rounded-lg border overflow-hidden shadow-sm h-40 md:h-auto">
                <img src="https://picsum.photos/400/300?random=4" class="w-full h-full object-cover" alt="Gambar Perusahaan">
            </div>
        </div>

        <div class="bg-white rounded-lg border shadow-sm mb-6 overflow-hidden">
            <div class="bg-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-bold">Simulasi Kredit Mobil</h3>
            </div>
            <div class="p-6">
                <form action="" method="POST" class="space-y-4">

                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center gap-2">
                        <label for="harga_mobil" class="font-semibold text-gray-700">Harga Mobil</label>
                        <div class="sm:col-span-2">
                            <input type="number" id="harga_mobil" name="harga_mobil"
                                   value="<?= htmlspecialchars($harga_mobil > 0 ? $harga_mobil : '') ?>"
                                   placeholder="Masukkan harga mobil"
                                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center gap-2">
                        <label for="dp_persen" class="font-semibold text-gray-700">DP</label>
                        <div class="sm:col-span-2 flex items-center space-x-2">
                            <select id="dp_persen" name="dp_persen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="" disabled <?= empty($dp_persen) ? 'selected' : '' ?>>Pilih DP</option>
                                <?php foreach ([10, 20, 30, 40, 50, 60] as $option): ?>
                                    <option value="<?= $option ?>" <?= $dp_persen == $option ? 'selected' : '' ?>><?= $option ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="font-bold text-gray-600">%</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center gap-2">
                        <label class="font-semibold text-gray-700">Tenor</label>
                        <div class="sm:col-span-3 flex flex-wrap gap-4">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <label for="tenor<?= $i ?>" class="inline-flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="tenor" value="<?= $i ?>" id="tenor<?= $i ?>"
                                           class="tenor-checkbox rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                           <?= $tenor_tahun == $i ? 'checked' : '' ?>>
                                    <span class="text-gray-700"><?= $i ?> Tahun</span>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 pt-2">
                        <div class="sm:col-start-2">
                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium px-6 py-2 rounded transition-colors shadow">Hitung</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($is_calculated): ?>
        <div class="bg-white rounded-lg border border-gray-300 shadow-sm p-6 mb-6">
            <div class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-4 border-b pb-2">
                    <span class="font-bold text-gray-700">Harga Mobil</span>
                    <span class="sm:col-span-3 text-gray-900">: <?= formatRupiah($harga_mobil) ?></span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 border-b pb-2">
                    <span class="font-bold text-gray-700">DP</span>
                    <span class="sm:col-span-3 text-gray-900">: <?= $dp_persen ?>% (<?= formatRupiah($nominal_dp) ?>)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 border-b pb-2">
                    <span class="font-bold text-gray-700">Tenor</span>
                    <span class="sm:col-span-3 text-gray-900">: <?= $tenor_tahun ?> Tahun (<?= $total_bulan ?> Bulan)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 border-b pb-2">
                    <span class="font-bold text-gray-700">Bunga</span>
                    <span class="sm:col-span-3 text-gray-900">: <?= $bunga_persen ?>% (<?= formatRupiah($bunga_rp) ?>)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 pt-2">
                    <span class="font-bold text-blue-600 text-lg">Jumlah Angsuran</span>
                    <span class="sm:col-span-3 font-bold text-blue-600 text-lg">: <?= formatRupiah($angsuran_per_bulan) ?> / Bulan</span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <footer class="bg-white border-t py-4 mt-auto" id="footer">
        <div class="max-w-4xl mx-auto px-4 text-center text-gray-500 text-sm">
         &copy; <?= date('Y') ?> LSP Teknologi Digital
        </div>
    </footer>

    <script>
        document.querySelectorAll('.tenor-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelectorAll('.tenor-checkbox').forEach((cb) => {
                        if (cb !== this) cb.checked = false;
                    });
                }
            });
        });

        const slides = document.querySelectorAll('.slider-item');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 4000);
    </script>
</body>
</html>