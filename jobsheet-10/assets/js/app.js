function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Validasi untuk form Pelanggan
        const namaPelanggan = form.querySelector("[name='nama']");
        if (namaPelanggan && namaPelanggan.value.trim() === "") {
            tampilkanError(namaPelanggan, "Nama pelanggan wajib diisi.");
            valid = false;
        } else if (namaPelanggan) { hapusError(namaPelanggan); }

        const noPelanggan = form.querySelector("[name='no_pelanggan']");
        if (noPelanggan && noPelanggan.value.trim() === "") {
            tampilkanError(noPelanggan, "No. Pelanggan wajib diisi.");
            valid = false;
        } else if (noPelanggan) { hapusError(noPelanggan); }

        // Validasi untuk form Aplikasi
        const kodeApp = form.querySelector("[name='kode_app']");
        if (kodeApp && kodeApp.value.trim() === "") {
            tampilkanError(kodeApp, "Kode App wajib diisi.");
            valid = false;
        } else if (kodeApp) { hapusError(kodeApp); }

        const namaApp = form.querySelector("[name='nama_app']");
        if (namaApp && namaApp.value.trim() === "") {
            tampilkanError(namaApp, "Nama Aplikasi wajib diisi.");
            valid = false;
        } else if (namaApp) { hapusError(namaApp); }

        const harga = form.querySelector("[name='harga']");
        if (harga) {
            const nilai = parseFloat(harga.value);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(harga, "Harga tidak boleh negatif.");
                valid = false;
            } else { hapusError(harga); }
        }

        if (!valid) { e.preventDefault(); }
    });
}

function initEditConfirm() {
    document.addEventListener("submit", function (e) {
        const form = e.target;

        if (!form.classList.contains("form-edit")) return;

        const yakin = confirm("Apakah Anda Yakin Ingin Menyimpan Perubahan Data Ini?");

        if (!yakin) {
            e.preventDefault();
        }
    });
}

// Script untuk Toggle Hamburger Menu
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const navMenu = document.querySelector("header nav");

    if (toggleBtn && navMenu) {
        toggleBtn.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }
});

// Panggil fungsi agar aktif saat file JavaScript dimuat
initEditConfirm();