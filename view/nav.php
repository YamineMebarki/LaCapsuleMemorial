<?php
//navbar profil pour un user
if (isset($_GET['id'])) {
    ?>
    <!--Navbar-->
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Menu</span>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav-mv"><a href="controler/deconnexion_ctrl.php"><i data-toggle='tooltip' data-placement='top' title="Quitter le profil" class="fas fa-power-off"></i></a></div>
                <a data-toggle="modal" data-target="#parametreModal"><i class="fas fa-cog nav-mv" data-toggle='tooltip' data-placement='bottom' title="Paramétres"></i></a>
            </div>
            <?php
            //navbar user visite autre profil toute en étant connecter
            if ($_GET['id'] != $_SESSION['id']):
                ?>
                <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
                    <span class="font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
                </nav>
                <?php
            endif;
        //navbar profil visitor
        else:
            ?>
            <span class="line-height font"><a href="index.php">Accueil du site</a></span>
            <?php
        endif;
        if (isset($_SESSION['id_ya_role']) && $_SESSION['id_ya_role'] == 2):
            ?>
            <span class="font"><a href="index.php?moderator=<?= $_SESSION['id_ya_role'] ?>"></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar tableau admin
} else if (isset($_GET['admin'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar moderateur
} else if (isset($_GET['moderator'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar modifier son password
} else if (isset($_GET['contact'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php else: ?>
            <span class="line-height font"><a href="index.php">Accueil du site</a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar condition d'utilisation
} else if (isset($_GET['conditions'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php else: ?>
            <span class="line-height font"><a href="index.php">Accueil du site</a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar pour modifier son mot de pass
} else if (isset($_GET['modifPass'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>&userToken=<?= $tokenUser ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar pour modifier son mail
} else if (isset($_GET['modifMail'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar de la gestion des commentaires
} else if (isset($_GET['comment'])) {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marg font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
<?php } else if (isset($_GET['modifMail'])) { ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded shadow fixed-top">
        <?php if (isset($_SESSION['id'])): ?>
            <span class="marge font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="btn btn-default"> Retour profil</button></a></span>
        <?php endif; ?>
    </nav>
    <?php
    //navbar acceuil
} else {
    ?>
    <nav class="navbar navbar-dark bg-light navbar-expand-lg rounded page shadow center fixed-top">
        <!--menu_responsive-->
        <?php if (isset($_SESSION['id'])): ?>
            <span class=" font"><a href="index.php?id=<?= $_SESSION['id'] ?>"><button class="retour btn btn-primary"> Retour profil</button></a></span>
        <?php else: ?>
            <span class="marg font" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Menu</span>
        <?php endif; ?>
        <!--menu_navbar-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_GET['contact'])) { ?>
                    <li class=" marge font"><a href="index.php">Accueil</a></li>
                <?php } else if (isset($_GET['conditions'])) { ?>
                    <li class=" marge font"><a href="index.php">Accueil</a></li>
                <?php } else { ?>
                    <li class="nav-item navBar"><span class="btn"><i class="fas fa-user-plus naV"><a data-toggle="modal" data-target="#signUp"> Inscritpion</a></i></span></li>
                    <li class="nav-item"><span class="text-white">Paix</span></li>
                    <li class="nav-item "><span class="btn"><a data-toggle="modal" data-target="#loginModal"><i class="fas fa-sign-in-alt"> S'identifier</i></a></span></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <!--modal SignIn pour ce connecter-->
    <div id="loginModal" class="modal center" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h2><i class="fas fa-sign-in-alt"><span class="font"> S'identifier</span></i></h2>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>
                <div class="modal-body">
                    <!--formulaire de connexion-->
                    <form action="" method="POST">
                        <div  class="form-group"><label for="mailconnect" class="font">Adresse mail</label><input type="email" name="mailconnect"  id="mailconnect" class="form-control shadow formconnexion" value="<?= isset($_POST['mailconnect']) ? $_POST['mailconnect'] : '' ?>" required /></div>
                        <div class="form-group"><input type="button" name="formconnexion" id='formconnexion' class="btn btn-primary" value="Se connecter" /></div>
                        <div class="form-group"><label for="passconnect" class="font">Mot de passe</label><input  type="<?= isset($types) ? $types : 'password' ?>" name="passconnect"  id="passconnect" class="form-control shadow formconnexion" value="<?= isset($_POST['passconnect']) ? $_POST['passconnect'] : '' ?>" required />
                        </div>
                    </form>
                    <label for="view">Masquer/Afficher</label>
                    <div class="form-group">
                        <button class="view btn-white" id="viewInput" value="<?= isset($view) ? $view : 'voir' ?>" name="view" ><img src="assets/img/oeil.jpg" class="oeil"></button>
                        <button class="view btn-white" id="viewInput" value="<?= isset($view) ? $view : 'cacher' ?>" name="view" ><img src="assets/img/closeOeil.png" class="oeil"></button>
                    </div>
                    <a href="index.php?passlost" class="text-black-50" data-toggle='tooltip' data-placement='bottom' title="Pas de probléme">mot de pass oublié ?</a>
                </div>
            </div>
        </div>
    </div>
    <!--modal d'inscription-->
    <div id="signUp" class="modal center" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h2><i class="fas fa-user-plus naV"> <span class="font">S'enregistrer</span></i></h2>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>
                <div class="modal-body">
                    <form action=""  onload="Captcha();" method="POST">
                        <div class="form-group"><label for="lastname" class="font">Nom : </label><input type="text" name="lastname" id="lastname" class="form-control shadow" placeholder="Veuillez entrer votre nom" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" required /></div>
                        <div class="form-group"><label for="lastname" class="font">Prenom : </label><input type="text" name="firstname" id="firstname" class="form-control shadow" placeholder="Veuillez entrer votre prenom" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" required= /></div>
                        <div class="form-group"><label for="mail1" class="font">email : </label><input type="mail" name="mail1" id="mail" class="form-control shadow" placeholder="Veuillez entrer votre adresse mail" value="" required /><div class="mailMessage"></div></div>
                        <div class="form-group"><label for="mail2" class="font">Confirmez votre email : </label><input type="mail" name="mail2" id="confirmMail" class="form-control shadow" placeholder="Veuillez confirmer votre adresse mail" value="" required /><div class="mailMessage"></div></div>
                        <!--captcha d-inscription-->
                        <div class="capt">
                            <h2 type="text" id="mainCaptcha"></h2>
                            <p type="text" id="main" class="text-success"></p>
                            <p><button type="button" class="btn" id="refresh" onclick="Captcha();" value=""><img src="assets/img/captcha.png"/></button></p>
                            <div class="form-group"><input class="form-control shadow" placeholder="Générer un captcha" type="text" id="txtInput" required /></div>
                            <input id="Button1" type="button" class="btn btn-primary" value="Valider captcha"/>
                        </div>
                        <hr/>
                        <!-- Set up a container element for the button -->
                        <div class="confirmCaptcha"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr/>
<?php } ?>
