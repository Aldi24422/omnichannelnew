<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Manual dengan JavaScript</title>
    <style>
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
        }
        .pagination a.active {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Data Pagination</h1>
    <ul id="data-list"></ul>

    <div class="pagination" id="pagination"></div>

    <script>
        // Fungsi untuk mengambil data dari API melalui PHP (data.php).
        function fetchData(page = 1) {
            const limit = 10; // Menentukan jumlah data per halaman.

            // Memanggil PHP yang akan mengambil data dari API.
            fetch(`test_data.php?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Cek data yang diterima dari PHP (bisa dilihat di console)
                    displayData(data.contacts); // Menampilkan data yang diterima dari API.
                    displayPagination(data.totalPages, page); // Menampilkan pagination berdasarkan total halaman.
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Fungsi untuk menampilkan data pada halaman.
        function displayData(contacts) {
            const dataList = document.getElementById('data-list');
            dataList.innerHTML = ''; // Bersihkan data lama.

            // Menampilkan data yang diterima dari API.
            contacts.forEach(contact => {
                const listItem = document.createElement('li');
                listItem.textContent = `Alias: ${contact.alias}, Number Phone: ${contact.numberPhone}, Message: ${contact.message}`;
                dataList.appendChild(listItem);
            });
        }

        // Fungsi untuk menampilkan pagination berdasarkan jumlah total halaman dan halaman saat ini.
        function displayPagination(totalPages, currentPage) {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = ''; // Bersihkan pagination lama.

            // Tombol "Sebelumnya"
            if (currentPage > 1) {
                const prevPage = document.createElement('a');
                prevPage.textContent = 'Sebelumnya';
                prevPage.href = '#';
                prevPage.addEventListener('click', () => fetchData(currentPage - 1));
                pagination.appendChild(prevPage);
            }

            // Menampilkan nomor halaman.
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.textContent = i;
                pageLink.href = '#';
                if (i === currentPage) {
                    pageLink.classList.add('active');
                }
                pageLink.addEventListener('click', () => fetchData(i));
                pagination.appendChild(pageLink);
            }

            // Tombol "Selanjutnya"
            if (currentPage < totalPages) {
                const nextPage = document.createElement('a');
                nextPage.textContent = 'Selanjutnya';
                nextPage.href = '#';
                nextPage.addEventListener('click', () => fetchData(currentPage + 1));
                pagination.appendChild(nextPage);
            }
        }

        // Panggil fetchData untuk memuat data halaman pertama saat pertama kali diakses.
        fetchData();
    </script>

</body>
</html>

<!-- [
                    {
                              "_id": "af3da51a-9578-4522-bcca-dcb8ab467a55",
                              "_createdAt": "2024-10-04T02:29:12.149Z",
                              "_updatedAt": "2024-10-04T09:34:31.500Z",
                              "numberPhone": "120363280173471464",
                              "fullPhone": "120363280173471464@g.us",
                              "alias": "Jokerjkt",
                              "message": "aw"
                    },
                    {
                              "_id": "af3da51a-9578-4522-bcca-dcb8ab467a55",
                              "_createdAt": "2024-10-04T02:29:12.149Z",
                              "_updatedAt": "2024-10-04T09:34:31.500Z",
                              "numberPhone": "120363280173471464",
                              "fullPhone": "120363280173471464@g.us",
                              "alias": "Jokerjkt",
                              "message": "aw"
                    }
] -->