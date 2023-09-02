<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JaBry | Tambah Buku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100" style="height: 66rem">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold mb-7 flex justify-center mt-8">Tambah Data Buku</h1>
        <div id="preview" class="mb-4 flex justify-center"></div>
        <form action="buku" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4 mr-56 ml-56">
                <label for="cover" class="font-medium flex justify-center">Upload Cover</label>
                <div class="flex justify-center mb-5">
                    
                    <input type="file" name="cover" id="cover" class="file-input file-input-bordered file-input-info w-full max-w-xs mb-4" required/>
                </div>
                <div class="flex space-x-4">
                    
                    <div class="w-1/2">
                        <label for="judul" class="block font-medium">Judul Buku</label> 
                        <input type="text" name="judul" id="judul" class="input input-bordered w-full" placeholder="Masukkan Judul" required>
                    </div>
                    <div class="w-1/2">
                        <label for="penulis" class="block font-medium">Penulis Buku</label>
                        <input type="text" name="penulis" id="penulis" class="input input-bordered w-full" placeholder="Masukkan Nama Penulis">
                    </div>
                </div>
                <div>
                    <label for="deskripsi" class="block font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="textarea textarea-bordered w-full" placeholder="Masukkan Deskripsi" required></textarea>
                </div>
                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <label for="tgl_terbit" class="block font-medium">Tanggal Terbit</label>
                        <input type="date" name="tgl_terbit" id="tgl_terbit" class="input input-bordered w-full" required>
                    </div>
                    <div class="w-1/2">
                        <label for="kategori" class="block font-medium">Kategori</label>
                        <select name="kategori" id="kategori" class="select select-bordered w-full" required>
                            <option value="" selected disabled>-- Pilih Kategori Buku --</option>
                            <option value="Fiksi">Fiksi</option>
                            <option value="Non-Fiksi">Non-Fiksi</option>
                            <option value="Referensi">Referensi</option>
                            <option value="Agama dan Spiritualitas">Agama dan Spiritualitas</option>
                            <option value="Hobi dan Kerajinan">Hobi dan Kerajinan</option>
                            <option value="Anak-anak dan Remaja">Anak-anak dan Remaja</option>
                            <option value="Travel dan Peta">Travel dan Peta</option>
                            <option value="Kesehatan dan Kebugaran">Kesehatan dan Kebugaran</option>
                            <option value="Lingkungan dan Alam">Lingkungan dan Alam</option>
                            <option value="Puisi">Puisi</option>
                            <option value="DEATH NOTE">DEATH NOTE</option>
                        </select>
                        {{-- <input type="text" name="favorite_color" id="favorite_color" class="input input-bordered w-full" placeholder="Warna Favorit" required> --}}
                    </div>
                </div>
            </div>
            <div class="mt-6 ml-56 mr-56">
                <button type="submit" class="btn btn-info w-full text-white">Simpan</button>
            </div>
        </form>
        <script>
            document.getElementById('cover').addEventListener('change', function(e) {
                const preview = document.getElementById('preview');
                preview.innerHTML = '';

                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.classList.add('w-44', 'h-64', 'mt-2');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>
</body>
</html>
