<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold; background-color: yellow">NAMA</th>
                <th style="font-weight: bold; background-color: yellow">EMAIL</th>
                <th style="font-weight: bold; background-color: yellow">WALI KELAS</th>
                <th style="font-weight: bold; background-color: yellow">KELAS</th>
                <th style="font-weight: bold; background-color: yellow">GURUBK</th>
            </tr>
            
        </thead>
        <tbody>
            @foreach ($data as $siswa)
            <tr>
                <td>{{$siswa->namasiswa}}</td>
                <td>{{$siswa->user->email}}</td>
                <td>{{$siswa->kelas->walikelas->namagurukelas}}</td>
                <td>{{$siswa->kelas->kelas}}</td>
                <td>{{$siswa->kelas->guru->namaguru}}</td>
            </tr>  
            @endforeach
           
        </tbody>
    </table>
</body>
</html>