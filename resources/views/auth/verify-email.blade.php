<div class="container">
    <div class="alert alert-success" role="alert">
        <header>
            <h1>Seja bem-vindo(a) ao Street Slang!</h1>
        </header>
        <main>
            <p>Olá {{$username}},</p>
            <p>Para ativar sua conta, clique no link abaixo:</p>
            <p><a href="{{ url('route-verifyced', ['id' => $user_id]) }}">https://street-slang.com/verification-email</a></p>
            <p>Obrigado por se cadastrar!</p>
        </main>
        <footer>
            <p>Este email é automático, por favor, não responda.</p>
        </footer>
    </div>
</div>