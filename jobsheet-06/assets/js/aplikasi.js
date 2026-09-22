// Mengambil & menampilkan Daftar Aplikasi dari data/aplikasi.json
async function muatDaftarAplikasi() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600)); // Delay simulasi JS6
        const res = await fetch("../data/aplikasi.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }

        const daftarAplikasi = await res.json();
        daftarAplikasi.forEach(function (app) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + app.kode + "</td>" +
                "<td>" + app.nama + "</td>" +
                "<td>" + app.kategori + "</td>" +
                "<td>" + app.harga + "</td>" +
                "<td>" + app.status + "</td>" +
                "<td>" +
                "<button type=\"button\" class=\"btn-edit\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"6\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", muatDaftarAplikasi);

// Event Listener Tombol Muat Ulang Data (Latihan 1)
const btnReload = document.getElementById("btn-reload");
if (btnReload) {
    btnReload.addEventListener("click", loadAplikasi);
}