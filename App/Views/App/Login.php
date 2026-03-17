<?php require "headerHtml.php" ?>

<div class="main-bg min-vh-100 d-flex justify-content-center align-items-center p-3">
    <div class="bg-white shadow-sm rounded row overflow-hidden g-0" style="max-width: 1100px; width: 100%;">

        <div class="col-md-6 d-none d-md-block">
            <img src="public/Assets/img/img1.jpg" alt="Imagem" class="w-100 h-100">
        </div>

        <form class="col-md-6 p-3 d-flex flex-column justify-content-center">
            <h1 class="mb-4 text-center"><i class="fa-solid fa-paw"></i> <span class="poppins-bold">PetShop</span>
            </h1>

            <div class="mb-3">
                <label for="login" class="form-label poppins-semibold">Login</label>
                <input type="text" class="form-control" name="login" id="login">
            </div>

            <div class="mb-4">
                <label for="senha" class="form-label poppins-semibold">Password</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>

            <button type="submit" class="btn main-bg text-light w-100">Login</button>
        </form>
    </div>
</div>

<?php require "footerHtml.php" ?>