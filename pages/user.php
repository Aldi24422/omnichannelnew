<?php
// Mulai sesi PHP
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login dengan pesan error
    header("Location: ../pages/login.php?error=unauthorized");
    exit();
}
?>

 <!DOCTYPE html>
 <html lang="en">

<head>
    <?php
    require_once("../includes/head.php");
    ?>
</head>

<body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <?php
        require_once("../includes/header.php");
        ?>
        <div class="page-body-wrapper">
            <?php
            require_once("../includes/sidebar.php");
            ?>
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Pengaturan Petugas</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Pengaturan Petugas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-xxl-4 box-col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Petugas</h5>
                                </div>
                                <form class="form theme-form" method="POST">
                                    <input type="hidden" name="action" value="create">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="namePetugas">Nama Pengguna</label>
                                                    <input class="form-control" id="namePetugas" name="nama" type="text" placeholder="Masukan Nama Petugas" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userPetugas">Username</label>
                                                    <input class="form-control" id="userPetugas" name="username" type="text" placeholder="Masukan Username Petugas" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="rolePetugas">Role Petugas</label>
                                                    <select class="form-select digits" id="rolePetugas" name="role" required>
                                                        <option value="">--Pilih Role--</option>
                                                        <option value="admin">Admin Utama</option>
                                                        <option value="petugas whatsapp">Petugas WhatsApp</option>
                                                        <!-- <option value="petugas instagram">Petugas Instagram</option>
                                                        <option value="petugas x">Petugas X</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan Password" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                        <input class="btn btn-light" type="reset" value="Cancel">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xxl-8 box-col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Daftar Petugas</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Username</th>
                                                    <th>Role Petugas</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $index => $user) : ?>
                                                    <tr>
                                                        <td><?= $index + 1 ?></td>
                                                        <td><?= htmlspecialchars($user['nama']) ?></td>
                                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                                        <td><?= htmlspecialchars($user['role']) ?></td>
                                                        <td>
                                                            <form method="POST" class="d-inline">
                                                                <input type="hidden" name="action" value="update">
                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                <button type="button" class="btn btn-pill btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editPertanyaan<?= $user['id'] ?>"><i data-feather="edit"></i></button>
                                                            </form>
                                                            |
                                                            <form method="POST" class="d-inline">
                                                                <input type="hidden" name="action" value="delete">
                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                <button type="submit" class="btn btn-pill btn-secondary btn-xs" onclick="return confirm('Hapus data ini?')"><i data-feather="trash-2"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once("../includes/footer.php");
            ?>
        </div>
    </div>
    <?php
    require_once("../includes/script.php");
    ?>
</body>

</html>
