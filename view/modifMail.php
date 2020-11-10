<?php if ($_SESSION && $_GET['modifMail'] == $tokenUser): ?>
    <div class="pad content1">
        <div class="center alert-success">
            <h3 class="text-success"><?= isset($formError['successMail']) ? $formError['successMail'] : '' ?></h3>
        </div>
        <div class="center alert-danger">
            <h3 class="text-danger"><?= isset($formError['modifMail']) ? $formError['modifMail'] : '' ?></h3>
        </div>
        <div class="center content shadow container">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="">
                        <div class="form-group font"><label for="mail1">Veuillez entrer un nouveau mail</label><input type="mail" name="mail1" id="mail1" class="form-control shadow" required /><div class="confirmMail"></div></div>
                        <div class="form-group font"><label for="mail2">veuillez confirmer votre mail</label><input type="mail" name="mail2" id="mail2" class="form-control shadow" required /><div class="confirmMail"></div></div>
                        <hr/>
                        <a href="index.php?id=<?= $_SESSION['id'] ?>"><button type="button" class="btn btn-danger">Annuler</button></a>
                        <input type="submit" name="modifyMail" class="btn btn btn-success" value="Confirmer" />
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
