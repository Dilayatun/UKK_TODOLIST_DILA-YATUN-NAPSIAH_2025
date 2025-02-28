<?php
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $prioritas = mysqli_real_escape_string($koneksi, $_POST['prioritas']);

    $query = "INSERT INTO tugas (tugas, tanggal, status, prioritas) VALUES ('$tugas', '$tanggal', '$status', '$prioritas')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <style>
        body { background: rgb(240, 196, 209); font-family: 'Comic Sans MS', cursive; text-align: center; }
        .container { background: #fff; padding: 20px; width: 50%; margin: auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #ff66b2; }
        input, select, button, a { padding: 10px; margin: 5px; border-radius: 5px; border: 1px solid #ddd; width: 90%; }
        button { background: rgb(248, 143, 204); color: white; border: none; cursor: pointer; }
        button:hover { background: #ff3385; }
        a { text-decoration: none; background: gray; color: white; padding: 10px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Tugas</h2>
        <form method="POST">
            <label>Tugas:</label>
            <input type="text" name="tugas" required><br>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required><br>
            <label>Prioritas:</label>
            <select name="prioritas">
                <option value="Rendah">Rendah</option>
                <option value="Sedang">Sedang</option>
                <option value="Tinggi">Tinggi</option>
            </select><br>
            <label>Status:</label>
            <select name="status" required>
                <option value="Belum">Belum</option>
                <option value="Sudah">Sudah</option>
            </select><br>
            <button type="submit">Simpan</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
</body>
</html>
