<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - ParkirKabasa</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #101318;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        h1 {
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-tambah {
            background: #f5b400;
            color: #111;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: #1b2028;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #303640;
            text-align: left;
        }

        th {
            color: #f5b400;
        }

        .success {
            background: #1f5135;
            padding: 12px;
            border-radius: 6px;
            margin: 15px 0;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Kelola User</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-tambah">
        + Tambah User
    </a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    <a href="{{ route('user.edit', $user->id) }}"
                       class="btn btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('user.destroy', $user->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-hapus">
                            Hapus
                        </button>

                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="4">
                    Belum ada data user.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

</body>
</html>