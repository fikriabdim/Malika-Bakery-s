<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: modules/login.php");
    exit;
}

include "config/database.php"; 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$query = "SELECT laporan.*, users.nama FROM laporan 
          JOIN users ON laporan.user_id = users.id 
          WHERE laporan.judul LIKE '%$search%' 
          OR laporan.lokasi_ditemukan LIKE '%$search%' 
          ORDER BY laporan.id DESC";

$result = mysqli_query($conn, $query);

include "includes/header.php"; 
?>

<div class="dashboard-header">
    <h1>Dashboard Barang</h1>
    <a href="modules/add.php" class="btn btn-primary">+ Lapor Barang</a>
</div>

<div class="search-container">
    <form method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari nama barang atau lokasi..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if($search != ''): ?> <a href="index.php" class="btn">Reset</a> <?php endif; ?>
    </form>
</div>

<?php if (mysqli_num_rows($result) > 0): ?>
    <div class="grid">
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
            <div class="card">
                <img src="assets/img/<?= $row['foto']; ?>" alt="Foto Barang">
                <div class="card-content">
                    <div class="status-badge <?= ($row['status'] == 'aktif') ? 'status-aktif' : 'status-found'; ?>">
                        <?= $row['status']; ?>
                    </div>
                    <h3 class="card-title"><?= $row['judul']; ?></h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">📍 <?= $row['lokasi_ditemukan']; ?></p>
                    
                    <a href="modules/detail.php?id=<?= $row['id']; ?>" class="btn btn-primary" style="width: 100%; margin-bottom: 5px;">Detail</a>
                    
                    <?php if ($row['user_id'] == $_SESSION['user_id']): ?>
                        <a href="modules/delete.php?id=<?= $row['id']; ?>" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Hapus laporan ini?')">Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert-not-found">
        <h3>🔍 Maaf, barang yang Anda cari tidak ditemukan.</h3>
        <p>Gunakan kata kunci yang lebih umum atau periksa kembali lokasi.</p>
        <br>
        <a href="index.php" class="btn btn-primary">Lihat Semua Barang</a>
    </div>
<?php endif; ?>

<?php include "includes/footer.php"; ?>