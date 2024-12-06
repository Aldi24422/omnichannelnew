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
     <!-- <style>
         .btn-xs-custom {
             padding: 2px 5px;
             font-size: 12px;
         }
     </style> -->

 </head>

 <body>
     <!-- tap on top starts-->
     <div class="tap-top"><i data-feather="chevrons-up"></i></div>
     <!-- tap on tap ends-->
     <!-- page-wrapper Start-->
     <div class="page-wrapper compact-wrapper" id="pageWrapper">
         <!-- Page Header Start-->
         <?php
            require_once("../includes/header.php");
            ?>
         <!-- Page Header Ends                              -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
             <!-- Page Sidebar Start-->
             <?php
                require_once("../includes/sidebar.php");
                ?>
             <!-- Page Sidebar Ends-->
             <div class="page-body">
                 <div class="container-fluid">
                     <div class="page-title">
                         <div class="row">
                             <div class="col-6">
                                 <h3>
                                     <!-- Setting ChatBot WA -->
                                 </h3>
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
                 <!-- Container-fluid starts-->
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-sm-12 col-xxl-4 box-col-12">
                             <div class="card">
                                 <div class="card-header">
                                     <h5>Data Petugas</h5>
                                 </div>
                                 <form class="form theme-form">
                                     <div class="card-body">
                                         <div class="row">
                                             <div class="col">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="namePetugas">Nama Pengguna</label>
                                                     <input class="form-control" id="namePetugas" type="text" placeholder="Masukan Nama Petugas">
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="userPetugas">Username</label>
                                                     <input class="form-control" id="userPetugas" type="text" placeholder="Masukan Username Petugas">
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="rolePetugas">Role Petugas</label>
                                                     <select class="form-select digits" id="rolePetugas">
                                                         <option>--Pilih Role--</option>
                                                         <option>Admin Utama</option>
                                                         <option>Petugas WhatsApp</option>
                                                         <option>Petugas Instagram</option>
                                                         <option>Petugas X</option>
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col">
                                                 <div class="mb-3">
                                                     <label class="form-label" for="password">Password</label>
                                                     <input class="form-control" id="password" type="password" placeholder="Masukkan Password" value="OmniChannel@D15dukc4piL">
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
                                     <!-- <span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span> -->
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
                                                 <tr>
                                                     <td>1</td>
                                                     <td>Meita Eny</td>
                                                     <td>meitaeny</td>
                                                     <td>Admin Utama</td>
                                                     <td>
                                                         <button class="btn btn-pill btn-primary btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#editPertanyaan" data-whatever="@getbootstrap"><i data-feather="edit"></i></button>
                                                         | <button class="btn btn-pill btn-secondary btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#hapusPertanyaan" data-whatever="@getbootstrap"><i data-feather="trash-2"></i></button>
                                                     </td>
                                                 </tr>
                                                 <!-- Modal Button Edit -->
                                                 <div class="modal fade" id="editPertanyaan" tabindex="-1" role="dialog" aria-labelledby="modaleditPertanyaan" aria-hidden="true">
                                                     <div class="modal-dialog" role="document">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title">Edit Petugas</h5>
                                                                 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>
                                                             <div class="modal-body">
                                                                 <form>
                                                                     <div class="row">
                                                                         <div class="col">
                                                                             <div class="mb-3">
                                                                                 <label class="form-label" for="namePetugas">Nama Pengguna</label>
                                                                                 <input class="form-control" id="namePetugas" type="text" placeholder="Masukan Nama Petugas">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="row">
                                                                         <div class="col">
                                                                             <div class="mb-3">
                                                                                 <label class="form-label" for="userPetugas">Username</label>
                                                                                 <input class="form-control" id="userPetugas" type="text" placeholder="Masukan Username Petugas">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="row">
                                                                         <div class="col">
                                                                             <div class="mb-3">
                                                                                 <label class="form-label" for="rolePetugas">Role Petugas</label>
                                                                                 <select class="form-select digits" id="rolePetugas">
                                                                                     <option>--Pilih Role--</option>
                                                                                     <option>Admin Utama</option>
                                                                                     <option>Petugas WhatsApp</option>
                                                                                     <option>Petugas Instagram</option>
                                                                                     <option>Petugas X</option>
                                                                                 </select>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="row">
                                                                         <div class="col">
                                                                             <div class="mb-3">
                                                                                 <label class="form-label" for="password">Password</label>
                                                                                 <input class="form-control" id="password" type="password" placeholder="Masukkan Password" value="OmniChannel@D15dukc4piL">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </form>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                                                 <button class="btn btn-info" type="button">Edit</button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>

                                                 <!-- Modal Button Hapus -->
                                                 <div class="modal fade" id="hapusPertanyaan" tabindex="-1" role="dialog" aria-labelledby="hapusPertanyaan" aria-hidden="true">
                                                     <div class="modal-dialog modal-dialog-centered" role="document">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title">Peringatan !</h5>
                                                                 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>
                                                             <div class="modal-body">
                                                                 <p>Apakah Anda Yakin Akan Menghapus Petugas ini ? </p>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                                                 <button class="btn btn-primary" type="button">Yakin</button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>

                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 <!-- Container-fluid Ends-->
             </div>
             <!-- footer start-->
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