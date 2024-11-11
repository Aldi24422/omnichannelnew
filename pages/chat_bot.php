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
                                     <li class="breadcrumb-item">ChatBot Whatsapp</li>
                                 </ol>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Container-fluid starts-->
                 <div class="container-fluid">
                     <div class="row">
                         <!-- Zero Configuration  Starts-->
                         <div class="col-sm-12">
                             <div class="card">
                                 <div class="card-header">
                                     <h5>Setting ChatBot WA</h5>
                                     <span>Silakan isi bank pertanyaan untuk kebutuhan Chatbot Whatsapp Disdukcapil Surabaya</span>
                                     <button class="btn btn-success btn-sm float-right" type="button" data-bs-toggle="modal" data-bs-target="#tambahPertanyaan" data-whatever="@getbootstrap" style="float: right;">Tambah Data</button>

                                 </div>

                                 <!-- Modal Button Tambah -->
                                 <div class="modal fade" id="tambahPertanyaan" tabindex="-1" role="dialog" aria-labelledby="modaltambahPertanyaan" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">Tambah Chatbot</h5>
                                                 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body">
                                                 <form>
                                                     <div class="mb-3">
                                                         <label class="col-form-label" for="recipient-name">Pertanyaan :</label>
                                                         <input class="form-control" type="text" placeholder="Buat pertanyaan .." value="">
                                                     </div>
                                                     <div class="mb-3">
                                                         <label class="col-form-label" for="message-text">Jawaban :</label>
                                                         <textarea class="form-control" placeholder="Buat jawaban.."></textarea>
                                                     </div>
                                                 </form>
                                             </div>
                                             <div class="modal-footer">
                                                 <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                                 <button class="btn btn-info" type="button">Simpan</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="card-body">
                                     <div class="table-responsive">
                                         <table class="display" id="basic-1">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Keyword</th>
                                                     <th>Jawaban</th>
                                                     <th>Lampiran</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr>
                                                     <td>1</td>
                                                     <td>Halo Dispendukcapil</td>
                                                     <td>Selamat datang di Layanan Pengaduan Dukcapil Surabaya!
                                                         Bagaimana kami bisa membantu anda, Silahkan Pilih (contoh : ketik "A")

                                                     </td>
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
                                                                 <h5 class="modal-title">Edit Chatbot</h5>
                                                                 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>
                                                             <div class="modal-body">
                                                                 <form>
                                                                     <div class="mb-3">
                                                                         <label class="col-form-label" for="recipient-name">Pertanyaan :</label>
                                                                         <input class="form-control" type="text" placeholder="" value="">
                                                                     </div>
                                                                     <div class="mb-3">
                                                                         <label class="col-form-label" for="message-text">Jawaban :</label>
                                                                         <textarea class="form-control" placeholder=""></textarea>
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
                                                                 <p>Apakah Anda Yakin Akan Menghapus Pertanyaan ini ? </p>
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
                         <!-- Zero Configuration  Ends-->
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