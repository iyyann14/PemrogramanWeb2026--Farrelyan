// ...
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        let valid = true;

        // Ubah selector ke target input aplikasi/pelanggan
        const fieldUtama = form.querySelector("[name='nama_aplikasi'], [name='nama']");
        if (fieldUtama && fieldUtama.value.trim() === "") {
            tampilkanError(fieldUtama, "Field ini wajib diisi.");
            valid = false;
        } else if (fieldUtama) { hapusError(fieldUtama); }

        const dev = form.querySelector("[name='developer']");
        if (dev && dev.value.trim() === "") {
            tampilkanError(dev, "Developer wajib diisi.");
            valid = false;
        } else if (dev) { hapusError(dev); }

        const tahun = form.querySelector("[name='tahun_rilis']");
        if (tahun) {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1990 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus 1990-2026.");
                valid = false;
            } else { hapusError(tahun); }
        }

        const ukuran = form.querySelector("[name='ukuran_mb']");
        if (ukuran) {
            const nilai = parseInt(ukuran.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(ukuran, "Ukuran MB tidak boleh negatif.");
                valid = false;
            } else { hapusError(ukuran); }
        }

        if (!valid) { e.preventDefault(); }
    });
}