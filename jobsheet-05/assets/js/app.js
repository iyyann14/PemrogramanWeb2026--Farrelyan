// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) ===== 
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;
    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Konfirmasi hapus (front-end only, belum ke server) ===== 
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
                updateCounter();
            }
        });
    });
}

// ===== Filter/pencarian tabel real-time ===== 
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;
    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const selPertama = row.querySelector("td");
            const teks = selPertama ? selPertama.textContent.toLowerCase() : "";
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
        updateCounter();
    });
}

// ===== Validasi form (client-side) ===== 
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        let valid = true;

        const fieldsWajib = [
            { selector: "[name='judul'], [name='nama'], [name='username']", pesan: "Field Ini Wajib Diisi." },
            { selector: "[name='pengarang'], [name='password']", pesan: "Field Ini Wajib Diisi." }
        ];

        fieldsWajib.forEach(function (field) {
            const elemen = form.querySelector(field.selector);
            if (elemen) {
                if (elemen.value.trim() === "") {
                    tampilkanError(elemen, field.pesan);
                    valid = false;
                } else {
                    hapusError(elemen);
                }
            }
        });

        const harga = form.querySelector("[name='harga'], [name='stok']");
        if (harga) {
            const nilai = parseInt(harga.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(harga, "Nilai tidak boleh negatif.");
                valid = false;
            } else {
                hapusError(harga);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
    updateCounter();
});

function updateCounter() {
    const table = document.querySelector(".table-responsive table");
    const counter = document.getElementById("counter-baris");
    if (!table || !counter) return;
    const rows = table.querySelectorAll("tbody tr");
    let visibleCount = 0;
    rows.forEach(row => {
        if (row.style.display !== "none") visibleCount++;
    });
    counter.textContent = `Menampilkan ${visibleCount} dari ${rows.length} data`;
}