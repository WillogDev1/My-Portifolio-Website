<!DOCTYPE html>
<html>

<head>
    <title>FirstAccess</title>
    <link rel="stylesheet" href="/Public/Css/Login/FirstAccess/FirstAccess.css">
</head>

<body>
    <div class="container">
        <!-- code here -->
        <div class="card">
            <div class="card-image">
                <h2 class="card-heading">
                    Matenha-se seguro
                    <small>Troque sua senha</small>
                </h2>
            </div>
            <form class="card-form" method="POST">
                <div class="input">
                    <input type="password" class="input-field" id="password" name="password" required />
                    <label class="input-label">Senha</label>
                </div>
                <div class="input">
                    <input type="passwordConfirm" class="input-field" id="passwordConfirm" name="passwordConfirm" required />
                    <label class="input-label">Confirme a senha</label>
                </div>
                <div class="action">
                    <button class="action-button" type="button" onclick="send_Fetch_First_Access()">Atualizar</button>
                </div>
            </form>
            <div class="card-info">
                <p>By signing up you are agreeing to our <a href="#">Terms and Conditions</a></p>
            </div>
           <a href="#">Design by FreePik</a>
        </div>
    </div>

</body>
<script type="text/javascript" src="/Public/Js/Login/FirstAccess/First_Access.js"></script>
</html>