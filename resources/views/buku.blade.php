<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JaBry | Home</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="navbar bg-base-100 shadow-md">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Homepage</a></li>
                    <li><a>Portfolio</a></li>
                    <li><a>About</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a href="/" class="btn btn-ghost normal-case text-xl">Jawir Library</a>
        </div>
        <div class="navbar-end">
            <form action="" method="get">
            <div class="form-control">
                <input type="text" name="search" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
              </div>
            </form>
            </button>
            <button class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </button>
        </div>
    </div>

    <br>
    <a href="/tambah-buku" class="btn btn-info ml-10 mt-3 mb-3 text-white">+ TAMBAH BUKU</a>
    <br><br>

    @if (Session::has('status'))
    <div class="alert alert-success text-center mx-auto" style="max-width: 1450px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ Session::get('message') }}</span>
    </div>
    @endif

    <div class="overflow-x-auto m-0 mt-5">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th class="p-4">
                        <label>
                            <input type="checkbox" class="checkbox" />
                        </label>
                    </th>
                    <th class="p-4">No</th>
                    <th class="p-4">Daftar Buku</th>
                    <th class="p-4">Deskripsi</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Tanggal Penerbitan</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                <!-- rows -->
                @foreach ($buku as $data)
                <tr>
                    
                    <td class="p-4">
                        <label>
                            <input type="checkbox" class="checkbox" />
                        </label>
                    </td>
                    <td class="p-4">{{ $data->id }}</td>
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            
                                <div class="mb-7 w-32 h-44">
                                    <img src="{{ asset('storage/' . $data->cover) }}"
                                        alt="Cover Buku" />
                                </div>
                            
                            <div>
                                <div class="font-bold text-lg">{{ $data->judul }}</div>
                                <div class="text-sm opacity-50">{{ $data->penulis }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 ">
                        <div class="w-96 text-justify">{{ $data->deskripsi }}</div>
                    </td>
                    <td class="p-4"><span class="badge badge-ghost badge-lg">{{ $data->kategori }}</span></td>
                    <td class="p-4">
                        <?php
                            $tgl_terbit = $data->tgl_terbit;
                            $formatted_date = date('d-m-Y', strtotime($tgl_terbit));
                            echo $formatted_date;
                        ?>
                    </td>
                    
                    <td class="p-4">
                        <div class="flex">
                            <a class="btn btn-info btn-sm mr-1" href="edit-buku/{{$data->id}}">Edit</a>
                            <form id="deleteForm-{{$data->id}}" action="/buku/{{$data->id}}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-error btn-sm" value="Delete">Delete</button>
                            </form>
                        </div>
                    </td>
                    
                </tr>
                <!-- row 2 -->
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="flex justify-center items-center">
        {{ $buku->links() }}
    </div>
    
    <br><br><br><br><br><br><br>
    
    </div>
    

    
</body>

</html>
