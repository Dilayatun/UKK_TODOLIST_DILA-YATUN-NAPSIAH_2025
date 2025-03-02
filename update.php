<?php
include "koneksi.php";

// Pastikan ID tugas tersedia
if (!isset($_GET['id'])) {
    echo "ID tugas tidak ditemukan!";
    exit();
}

$id_tugas = $_GET['id'];

// Ambil data tugas dari database
$query = "SELECT * FROM tugas WHERE id = $id_tugas";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Tugas tidak ditemukan!";
    exit();
}

$tugas = mysqli_fetch_assoc($result);

// Jika form dikirim, lakukan update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tugas_baru = mysqli_real_escape_string($koneksi, $_POST['tugas']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $prioritas = mysqli_real_escape_string($koneksi, $_POST['prioritas']);

    $update_query = "UPDATE tugas SET tugas='$tugas_baru', tanggal='$tanggal', status='$status', prioritas='$prioritas' WHERE id=$id_tugas";

    if (mysqli_query($koneksi, $update_query)) {
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
    <title>Edit Tugas</title>
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
        <h2>Edit Tugas</h2>
        <form method="POST">
            <label>Tugas:</label>
            <input type="text" name="tugas" value="<?= htmlspecialchars($tugas['tugas']) ?>" required><br>

            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="<?= $tugas['tanggal'] ?>" required><br>

            <label>Prioritas:</label>
            <select name="prioritas">
                <option value="Rendah" <?= $tugas['prioritas'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                <option value="Sedang" <?= $tugas['prioritas'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                <option value="Tinggi" <?= $tugas['prioritas'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
            </select><br>

            <label>Status:</label>
            <select name="status">
                <option value="Belum" <?= $tugas['status'] == 'Belum' ? 'selected' : '' ?>>Belum</option>
                <option value="Sudah" <?= $tugas['status'] == 'Sudah' ? 'selected' : '' ?>>Sudah</option>
            </select><br>

            <button type="submit">Simpan</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
</body>
</html>
