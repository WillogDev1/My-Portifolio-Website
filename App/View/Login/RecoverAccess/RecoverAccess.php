<!DOCTYPE html>
<html>

<head>
    <title>RecoverAccess</title>
    <link rel="stylesheet" href="/Public/Css/Login/RecoverAccess/RecoverAccess.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <!-- code here -->
        <div class="card">
            <div class="card-image">
                <h2 class="card-heading">
                    Recuperar senha
                    <small>Entre com os dados abaixo</small>
                </h2>
            </div>
            <form class="card-form" method="post">
                <div class="input">
                    <input type="text" class="input-field" id="passwordRecover" name="passwordRecover" required />
                    <label class="input-label">Senha</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" id="password" name="password" required />
                    <label class="input-label">Nova senha</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" id="passwordConfirm" name="passwordConfirm" required />
                    <label class="input-label">Confirma Nova senha</label>
                </div>
                <div class="action">
                    <button class="action-button" type="button" onclick="send_Fetch_To_Recover_Access()">Atualizar</button>
                </div>
            </form>
            <div class="card-info">
                <p>By signing up you are agreeing to our <a href="#">Terms and Conditions</a></p>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src="/Public/Js/Login/RecoverAccess/RecoverAccess.js"></script>
</html>