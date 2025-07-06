<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekomendasi Jurusan</title>
    <style>
        /** Styling minimal untuk PDF **/
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
        th, td { border: 1px solid #333; padding: 4px; text-align: center; }
        th { background: #eee; }
        .header { text-align: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hasil Rekomendasi Jurusan</h2>
        <p>Nama Siswa: <strong>{{ $siswa->name}}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Jurusan</th>
                <th>Skor SMART</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $idx => $row)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td style="text-align: left;">{{ $row['jurusan'] }}</td>
                <td>{{ $row['total'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
