// Hamburger menu JS7
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;
    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}
// Konfirmasi Hapus
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;
        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td:nth-child(2)")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) { row.remove(); }
    });
}
// Pencarian Tabel
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;
    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}
// Validasi Form Client-Side
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}
function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) next.remove();
}
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        let valid = true;
        // Validasi Nama App & Nama Pelanggan
        const nama = form.querySelector("[name='nama_app'], [name='nama']");
        if (nama && nama.value.trim() === "") {
            tampilkanError(nama, "Nama wajib diisi.");
            valid = false;
        } else if (nama) hapusError(nama);

        // Validasi Kode App & ID Pelanggan
        const id = form.querySelector("[name='kode_app'], [name='id_pelanggan']");
        if (id && id.value.trim() === "") {
            tampilkanError(id, "Field ini wajib diisi.");
            valid = false;
        } else if (id) hapusError(id);

        // Validasi Harga
        const harga = form.querySelector("[name='harga']");
        if (harga) {
            const nilai = parseInt(harga.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(harga, "Harga tidak valid.");
                valid = false;
            } else hapusError(harga);
        }

        if (!valid) e.preventDefault();
    });
}
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});