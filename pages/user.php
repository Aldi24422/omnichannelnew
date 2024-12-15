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
                                                        <option value="admin">Admin</option>
                                                        <option value="petugas whatsapp">Petugas WhatsApp</option>
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
                                                            <!-- <form method="POST" class="d-inline">
                                                                <input type="hidden" name="action" value="update">
                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                <button type="button" class="btn btn-pill btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editPertanyaan<?= $user['id'] ?>"><i data-feather="edit"></i></button>
                                                            </form> -->

                                                            <form method="POST" action="process_login.php?action=edit">
                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                <input type="hidden" name="nama" value="<?= $user['nama'] ?>">
                                                                <input type="hidden" name="username" value="<?= $user['username'] ?>">
                                                                <input type="hidden" name="password" value="<?= $user['password'] ?>">
                                                                <input type="hidden" name="role" value="<?= $user['role'] ?>">
                                                                <button type="button" class="btn btn-pill btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editUsers<?= $user['id'] ?>"><i data-feather="edit"></i></button>
                                                                <!-- Kolom lainnya seperti nama, username, role, dan password -->
                                                            </form>

                                                            <div class="modal fade" id="editUsers<?= $user['id'] ?>" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="../CRUD/process_login.php?action=edit">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Edit Pengguna</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                                <div class="mb-3">
                                                                                    <label for="namePetugas" class="form-label">Nama Pengguna</label>
                                                                                    <input type="text" class="form-control" id="namePetugas" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="userPetugas" class="form-label">Username</label>
                                                                                    <input type="text" class="form-control" id="userPetugas" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="rolePetugas" class="form-label">Role</label>
                                                                                    <select class="form-select" id="rolePetugas" name="role" required>
                                                                                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                                                        <option value="petugas whatsapp" <?= $user['role'] === 'petugas whatsapp' ? 'selected' : '' ?>>Petugas WhatsApp</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="password" class="form-label">Password</label>
                                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

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