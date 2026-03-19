<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
    <link rel="stylesheet" href="/petshop/public/Assets/css/styles.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- GOOGLE FONTS POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>



    <div class="main-bg min-vh-100 d-flex justify-content-center align-items-center p-3">
        <div class="bg-white shadow-sm rounded row overflow-hidden g-0" style="max-width: 1100px; width: 100%;">



            <form class="col-md-6 p-3 d-flex flex-column justify-content-center" method="POST" action="<?= BASE_URL ?>/novaSenha">

                <h1 class="mb-4 text-center"><span class="poppins-bold">Alterar Senha</span>
                </h1>

                <?php if (isset($_SESSION['erro'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION['erro'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION['erro']) ?>

                <div class="mb-4">
                    <label for="senha" class="form-label poppins-semibold">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Informe sua senha">
                </div>
                <div class="mb-4">
                    <label for="senha" class="form-label poppins-semibold">Confirmar Senha</label>
                    <input type="password" class="form-control" name="confirmarSenha" placeholder="Confirme sua senha">
                </div>

                <button type="submit" class="btn main-bg text-light w-100 mb-4">Alterar</button>
                <a class="justify-content-end d-flex" href="<?= BASE_URL ?>/logout">Voltar à tela de login</a>
            </form>

            <div class="col-md-6 d-none d-md-block">
                <img src="/petshop/public/Assets/img/img2.jpg" alt="Imagem" class="w-100 h-100">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="public/Assets/scripts/scripts.js"></script>
</body>

</html>