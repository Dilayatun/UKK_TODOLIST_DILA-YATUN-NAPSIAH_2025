<?php
include "koneksi.php";
$result = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY tanggal ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Tugas Harian</title>
  <style>
    body { 
      background: rgb(240, 196, 209); 
      font-family: 'Comic Sans MS', cursive; 
      text-align: center; 
    }
    .container { 
      width: 80%; 
      margin: auto; 
      background: #fff; 
      padding: 20px; 
      border-radius: 15px; 
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
    }
    h2 { 
      color: #ff66b2; 
      font-weight: bold; 
    }
    .btn { 
      padding: 8px 15px; 
      border: none; 
      border-radius: 10px; 
      cursor: pointer; 
      display: inline-block; 
      text-decoration: none; 
      color: white; 
    }
    .btn-add { 
      background: rgb(248, 143, 204); 
      margin-bottom: 10px; 
    }
    .btn-add:hover { 
      background: #ff3385; 
    }
    .table { 
      width: 100%; 
      border-collapse: collapse; 
      margin-top: 10px; 
    }
    .table th, 
    .table td { 
      padding: 10px; 
      border: 1px solid black; 
    }
    .table th { 
      background: #ff66b2; 
      color: white; 
    }
    .btn-edit { background: #ff80c0; }
    .btn-delete { background: #ff3366; }
    .badge { 
  padding: 5px 10px; 
  border-radius: 5px; 
  color: white; 
  display: inline-block; 
}

.bg-danger { background: red; }
.bg-warning { background: orange; }
.bg-success { background: green; }

  </style>
</head>
<body>
  <div class="container">
    <h2>Daftar Tugas Harian 📌</h2>
    <a href="tambah.php" class="btn btn-add">Tambah Tugas</a>
    <table class="table">
      <tr><th>No</th><th>Tugas</th><th>Tanggal</th><th>Status</th><th>Prioritas</th><th>Aksi</th></tr>
      <?php $no = 1; while($data = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($data['tugas']); ?></td>
        <td><?= date("d-m-Y", strtotime($data['tanggal'])); ?></td>
        <td><?= htmlspecialchars($data['status']); ?></td>
        <td><span class="badge <?= $data['prioritas'] == "Tinggi" ? "bg-danger" : ($data['prioritas'] == "Sedang" ? "bg-warning" : "bg-success") ?>">
          <?= htmlspecialchars($data['prioritas']); ?></span></td>
        <td>
          <a href="update.php?id=<?= $data['id']; ?>" class="btn btn-edit">Edit</a>
          <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus tugas ini?');">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
