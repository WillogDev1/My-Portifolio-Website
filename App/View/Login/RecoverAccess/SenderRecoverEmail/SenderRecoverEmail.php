<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <style>
        #modalExemplo .modal-content {
            border: none;
            /* Remove a borda padrão */
            border-radius: 10px;
            /* Adiciona bordas arredondadas */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Adiciona uma sombra suave */
        }

        #modalExemplo .modal-header {
            border-bottom: none;
            /* Remove a borda inferior do cabeçalho */
        }

        #modalExemplo .modal-title {
            color: #333;
            /* Cor do título */
        }

        #modalExemplo .modal-body {
            padding: 20px;
            /* Espaçamento interno */
        }

        #modalExemplo input[type="email"] {
            border: 1px solid #ccc;
            /* Adiciona uma borda fina */
            border-radius: 5px;
            /* Adiciona bordas arredondadas */
            padding: 10px;
            /* Espaçamento interno */
            width: 100%;
            /* Largura total */
            margin-bottom: 15px;
            /* Espaçamento inferior */
        }

        #modalExemplo .g-recaptcha {
            margin-bottom: 15px;
            /* Espaçamento inferior */
        }

        #modalExemplo .modal-footer {
            border-top: none;
            /* Remove a borda superior do rodapé */
        }

        #modalExemplo .btn-primary {
            background-color: #007bff;
            /* Cor de fundo do botão primário */
            border: none;
            /* Remove a borda do botão */
        }

        #modalExemplo .btn-primary:hover {
            background-color: #0056b3;
            /* Cor de fundo do botão primário ao passar o mouse */
        }

        #modalExemplo .btn-secondary {
            background-color: #6c757d;
            /* Cor de fundo do botão secundário */
            border: none;
            /* Remove a borda do botão */
        }

        #modalExemplo .btn-secondary:hover {
            background-color: #545b62;
            /* Cor de fundo do botão secundário ao passar o mouse */
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#modalExemplo').modal('show');

            $('#modalExemplo').on('hidden.bs.modal', function() {
                console.log("Modal fechado");
                window.location.href = '/login'; // Substitua '/pagina-inicial' pela URL da sua página inicial
            });
        });
    </script>
</head>

<body>
    <!-- Botão para acionar modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo" style="display: none;">
        Abrir modal de demonstração
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recuperar senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <form id="demo-form" action="/login/recoveraccess/senderrecoveremail" method="post">
                            <div style="text-align: center;">
                                <label>Digite seu email cadastrado</label><br>
                                <input type="email" name="email" required><br><br>
                                <!-- Campo oculto para o token do reCAPTCHA -->
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                <!-- Espaço reservado para o reCAPTCHA -->
                                <div style="padding-left: 20%; padding-bottom: 20%; " class="g-recaptcha" data-sitekey="6LfJvr4pAAAAAKVu4uYF67RhEPa-Y1P_ImUWC5gs" data-size="normal"></div>
                                <!-- Botão de envio do formulário -->
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: left;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>

</html>