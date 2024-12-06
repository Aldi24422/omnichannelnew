<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("../includes/head.php"); ?>
    <!-- Link ke file CSS eksternal -->
</head>

<body>
    <!-- Tap on top starts -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- Tap on tap ends -->
    <!-- Page-wrapper Start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start -->
        <?php require_once("../includes/header.php"); ?>
        <!-- Page Header Ends -->
        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start -->
            <?php require_once("../includes/sidebar.php"); ?>
            <!-- Page Sidebar Ends -->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Sambungkan Whatsapp</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Sambungkan Whatsapp</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="whatsapp-container">
                            <div class="whatsapp-header">
                                <h1>WHATSAPP WEB</h1>
                            </div>

                            <div class="whatsapp-instructions">
                                <ol>
                                    <li>Buka WhatsApp di telepon Anda</li>
                                    <li>Ketuk Menu <strong>⋮</strong> di Android, atau Pengaturan <strong>⚙️</strong> di iPhone</li>
                                    <li>Ketuk <b>Perangkat tertaut</b> lalu <b>Tautkan perangkat</b></li>
                                    <li>Arahkan telepon Anda di layar ini untuk memindai kode QR</li>
                                </ol>
                            </div>

                            <div class="whatsapp-qr-code">
                                <img id="qr-code-image" src="" alt="QR Code">
                                <p id="qr-status">Loading QR Code...</p>
                            </div>

                            <script>
                                async function fetchQRCode() {
                                    try {
                                        const response = await fetch('http://localhost:3000/qr'); // Adjust URL as needed
                                        const data = await response.json();

                                        if (data.success) {
                                            document.getElementById('qr-code-image').src = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(data.qr)}&size=200x200`;
                                            document.getElementById('qr-status').textContent = '';
                                        } else {
                                            document.getElementById('qr-status').textContent = data.message;
                                        }
                                    } catch (error) {
                                        document.getElementById('qr-status').textContent = 'Failed to load QR Code.';
                                        console.error(error);
                                    }
                                }

                                // Fetch QR Code every 5 seconds
                                setInterval(fetchQRCode, 5000);
                                fetchQRCode(); // Initial call
                            </script>

                            <div class="whatsapp-keep-signed">
                                <input type="checkbox" id="keep-signed">
                                <label for="keep-signed">Keep me signed in</label>
                            </div>

                            <div class="whatsapp-help-link">
                                <a href="#">Need help to get started?</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends -->
            </div>
            <!-- Footer start -->
            <?php require_once("../includes/footer.php"); ?>
        </div>
    </div>

    <?php require_once("../includes/script.php"); ?>
</body>

</html>