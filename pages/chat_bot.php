<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../includes/head.php");
    ?>
</head>

<body>
    <!-- tap on top starts -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on top ends -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header -->
        <?php require_once("../includes/header.php"); ?>
        <!-- Page Header Ends -->

        <div class="page-body-wrapper">
            <!-- Page Sidebar -->
            <?php require_once("../includes/sidebar.php"); ?>
            <!-- Page Sidebar Ends -->

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>ChatBot WA</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">ChatBot</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Setting ChatBot WA</h5>
                                    <button class="btn btn-success btn-sm float-right" type="button" data-bs-toggle="modal" data-bs-target="#tambahPertanyaan">Tambah Data</button>
                                </div>

                                <!-- Modal Tambah -->
                                <div class="modal fade" id="tambahPertanyaan" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="../CRUD/proses_question.php?action=add">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Chatbot</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="keyword" class="col-form-label">Pertanyaan:</label>
                                                        <input type="text" class="form-control" name="keyword" placeholder="Masukkan pertanyaan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jawaban" class="col-form-label">Jawaban:</label>
                                                        <textarea class="form-control" name="jawaban" placeholder="Masukkan jawaban" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-info">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Data -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="basic-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Keyword</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../CRUD/pertanyaan.php';
                                                $pertanyaanList = getAllPertanyaan();
                                                foreach ($pertanyaanList as $index => $pertanyaan): ?>
                                                    <tr>
                                                        <td><?= $index + 1; ?></td>
                                                        <td><?= htmlspecialchars($pertanyaan['keyword']); ?></td>
                                                        <td><?= htmlspecialchars($pertanyaan['jawaban']); ?></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPertanyaan-<?= $pertanyaan['id']; ?>">Edit</button>
                                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusPertanyaan-<?= $pertanyaan['id']; ?>">Hapus</button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="editPertanyaan-<?= $pertanyaan['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="POST" action="../CRUD/proses_question.php?action=edit">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Chatbot</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id" value="<?= $pertanyaan['id']; ?>">
                                                                        <div class="mb-3">
                                                                            <label for="keyword" class="col-form-label">Pertanyaan:</label>
                                                                            <input type="text" class="form-control" name="keyword" value="<?= htmlspecialchars($pertanyaan['keyword']); ?>" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jawaban" class="col-form-label">Jawaban:</label>
                                                                            <textarea class="form-control" name="jawaban" required><?= htmlspecialchars($pertanyaan['jawaban']); ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-info">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="hapusPertanyaan-<?= $pertanyaan['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form method="POST" action="../CRUD/proses_question.php?action=delete">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Peringatan!</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                                        <input type="hidden" name="id" value="<?= $pertanyaan['id']; ?>">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends -->
            </div>
            <!-- Footer -->
            <?php require_once("../includes/footer.php"); ?>
        </div>
    </div>
    <?php require_once("../includes/script.php"); ?>
</body>

</html>
