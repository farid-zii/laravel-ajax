<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | </title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    {{-- MyStyle --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4 px-4 py-4" >
    <form action="/kasus" class="form-control" method="POST" >
        @csrf
        <textarea type="text" id="gambar" name="url_gambar" ></textarea>
        <textarea type="text" id="" name="url_blog" ></textarea>
        <button type="submit" class="btn btn-primary">Tombol</button>
    </form>

        <table class="table table-bordered">
        <tr> 
            <th>URL Gambar</th>
            <th>BLOG</th>
        </tr>
        
        @foreach($datas as $data)
        <tr> 
            <td>{{$data->url_gambar}}</td>
            <td>{{$data->url_blog}}</td>
        </tr>
        @endforeach
    </table>



</div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script >
        const gambar = document.getElementById('gambar');

    gambar.addEventListener('keydown', function(event) {
       
        if (event.key === 'Enter') {
            event.preventDefault();
            const currentValue = gambar.value;
            gambar.value = `${currentValue.trim()}, `;
        }
    });
    </script>
</body>
</html>
