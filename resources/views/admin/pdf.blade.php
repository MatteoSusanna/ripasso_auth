<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esempio PDF</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">

        <div class="card mb-5" style="width: 30rem;">

            <div class="my_img">
                <img src="data:image/jpeg;base64,{{ $image_base64 }}" class="card-img-top" alt="{{$post->nome}}">
            </div>
            <div class="card-body">
                <h2 class="card-title">{{$post->nome}}</h2>
                <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
    </div>

    <style>
        .my_img{
            width: 80%;
        }
        img{
            width: 100%;
            object-fit: contain;
        }
    </style>
</body>
</html>