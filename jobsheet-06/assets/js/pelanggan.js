// Mengambil & menampilkan Daftar Pelanggan dari data/pelanggan.json
async function muatDaftarPelanggan() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));
        const res = await fetch("../data/pelanggan.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }

        const daftarPelanggan = await res.json();
        daftarPelanggan.forEach(function (cust) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + cust.id_pelanggan + "</td>" +
                "<td>" + cust.nama + "</td>" +
                "<td>" + cust.kota + "</td>" +
                "<td>" + cust.aplikasi + "</td>" +
                "<td>" +
                "<button type=\"button\" class=\"btn-edit\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", muatDaftarPelanggan);