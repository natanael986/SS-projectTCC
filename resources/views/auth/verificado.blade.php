<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/indexlayout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <style>
        .email-content {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            margin-top: 300px;
        }

        .texto {
            text-align: center;
        }

        header>h1 {
            font-size: 100px;
        }

        main>a {
            text-decoration: none;
        }

        main>a>button {
            width: 100%;
            height: 100px;

            border-radius: 40px;

            font-size: 50px;
        }

        main>a>button:hover {
            border-color: #2CAF46;
            background-color: #000;
            color: #F2F2F2;
        }
    </style>
    <title>Verificado - pos-email</title>
</head>

<body>

    <div class="email-content">
        <form method="POST" action="{{ route('verifyced', $user->id) }}">
            @csrf
            <div class="texto">
                <header>
                    <h1>Seja bem-vindo(a) ao Street Slang!</h1>
                    <h2>Parabéns, seu email foi verificado!!!</h2>
                </header>
                <main>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="submit">Clique para fazer login novamente</button>
                </main>
            </div>
        </form>
    </div>

</body>

</html>