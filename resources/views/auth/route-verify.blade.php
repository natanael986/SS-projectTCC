@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .email-content {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
        }

        .texto {
            text-align: center;
        }


        main>h2 {
            font-size: 3rem;
        }
    </style>
    <title>Verificação</title>
</head>

<body>

    <div class="email-content">
        <div class="texto">
            <main>
                <h2>Por favor verifique seu email</h2>
                <h2>para confirmar e poder acessar o site</h2>
            </main>
        </div>
    </div>

</body>

</html>
@endsection