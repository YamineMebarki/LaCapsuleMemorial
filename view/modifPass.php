<?php if ($_SESSION && $_GET['modifPass'] == $tokenUser): ?>
    <div class="pad content1 mt-5">
        <div class="center alert-success">
            <h3 class="text-success"><?= isset($formError['successPass']) ? $formError['successPass'] : '' ?></h3>
        </div>
        <div class="center alert-danger">
            <h3 class="text-danger"><?= isset($formError['modifPass']) ? $formError['modifPass'] : '' ?></h3>
        </div>
        <div class="center content shadow container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title-font mb-3">Nouveau mot de passe</h1>
                    <form method="POST" action="">
                        <div class="form-group font"><label for="pass1">Veuillez entrer un nouveau mot de passe</label><input type="password" name="pass1" id="pass1" class="form-control shadow" required /><div class="confirmPass"></div></div>
                        <div class="form-group font"><label for="pass2">veuillez confirmer votre nouveau mot de passe</label><input type="password" name="pass2" id="pass2" class="form-control shadow" required /><div class="confirmPass"></div></div>
                        <hr/>
                        <a href="index.php?id=<?= $_SESSION['id'].'&userToken='.$tokenUser ?>"><button type="button" class="btn btn-danger">Annuler</button></a>
                        <input type="submit" name="modifyPass" class="btn btn btn-success" value="Confirmer" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
else:
    include 'view/contentError.php';
endif;
?>
