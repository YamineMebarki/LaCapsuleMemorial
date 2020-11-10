<h3 class="text-danger"><?= isset($formError['passlost']) ? $formError['passlost'] : ''; ?></h3>
<div class="container-fluid content center">
    <!--J'utilise bootstrap afin de créer une ligne -->
    <div class="row">
        <!--Puis j'utilise les 12 colonnes de la grille bootstrap afin d'occuper l'espace souhaiter lors de l'affichage-->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
            <h1 class="mt-5  title-font">Mot de passe Oublié ?</h1>
            <!--formulaire passlost-->
            <div class="mt-5">
                <form action="" method="POST" class="mt-5">
                    <div  class="form-group"><label for="passlost" class="font mt-5">Veuillez entrer votre adresse mail afin de reçevoir un nouveau mot de passe</label><input type="email" name="passlost"  id="passlost" class="form-control shadow mt-5 mb-5" value="" required /></div>
                    <div class="form-group"><input type="submit" name="newPass" id='newPass' class="btn btn-primary mt-5 mb-5" value="Confirmer" /></div>
                </form>
            </div>
        </div>
    </div>
</div>
