// Fungsi Fetch Generik (Latihan 2 & 5)
async function muatDataGenerik(url, keys) {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 3000));

        const res = await fetch(url);
        if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");

        const dataArray = await res.json();
        dataArray.forEach(function (item) {
            const tr = document.createElement("tr");
            let tdContent = "";
            keys.forEach(key => {
                tdContent += "<td>" + item[key] + "</td>";
            });
            tdContent += "<td><button type=\"button\" class=\"btn-edit\">Edit</button> <button type=\"button\" class=\"btn-hapus\">Hapus</button></td>";
            tr.innerHTML = tdContent;
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML = "<tr><td colspan=\"" + (keys.length + 1) + "\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        if (loading) loading.style.display = "none";
    }
}

function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;
    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        // Latihan 4: Log elemen yang diklik
        console.log("Elemen yang diklik:", e.target);

        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelectorAll("td")[1]?.textContent : "data ini";
        if (confirm("Yakin ingin menghapus \"" + nama + "\"?") && row) {
            row.remove();
        }
    });
}

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
        const inputWajib = form.querySelectorAll("[required]");
        inputWajib.forEach(function (input) {
            if (input.value.trim() === "") {
                tampilkanError(input, "Field ini wajib diisi.");
                valid = false;
            } else {
                hapusError(input);
            }
        });

        const harga = form.querySelector("[name='harga']");
        if (harga) {
            const nilai = parseInt(harga.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(harga, "Harga tidak boleh negatif.");
                valid = false;
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
});