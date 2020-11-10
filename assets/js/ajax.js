// Connexion grace a la method AJAX
$(function () {
    // Je cible mon le boutton du formulaire de connexion et initialise la function au click
    $('#formconnexion').click(function () {
        // j'initialise ma variable qui stock la value de mon input mail 
        var login = $('#mailconnect').val();
        // j'initialise ma variable qui stock la value de mon input pass 
        var password = $('#passconnect').val();
        // Je fait appel à la function ajax
        $.ajax({
            // Je declare le type de donnees qui transit
            type: "POST",
            // Je déclare le chemin du controler vers lequel mes donnees seron traîter
            url: 'controler/connect_ctrl.php',
// J'initialise mes variable qui stock la valeur des input ciblé et initialise mes POST XHR
            data: {mailconnect: login, passconnect: password, formconnexion: ''},
            // Declaration du cache a FALSE afin de ne garder aucune trace en memoire cache
            cache: false
// Execution de la function qui retournera la valeur des donnees traitées a la suite de l'appel ajax
        }).done(function (returnData) {
            // Initialisation d'une variable qui stockera les donnes retournees parser en JSON 
            infos = JSON.parse(returnData);
            // Si la valeur des donnees envoyer retourne Success alor
            if (infos.type == 'Success') {
// Je redirige grace a info.url qui me retourne l'url de redirection envoyer par la valeur retourner par mon conroler
                document.location.href = infos.url;
            }
        });
    });
    // verifier le pass via AJAX afin de le modifier appel de la function blur qui lance l'execution du script js quand je quitte le ficus de l'element html cibler via son attribu id
    $('#oldPass').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/profil_ctrl.php', {passTest: $(this).val(), userId: $('#userId').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage il existe aussi .text
                $('.passMessage').html('<p class="text-success alert-successs">mot de passe correct</p>');
            } else {
                $('.passMessage').html('<p class="text-danger alert-danger">mot de passe incorrect</p>');
            }
        });
    });
    // verifier le mail via AJAX afin de le modifier appel de la function blur qui lance l'execution du script js quand je quitte le ficus de l'element html cibler via son attribu id
    $('#oldMail').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/profil_ctrl.php', {changeMail: $(this).val(), userId: $('#userId').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.mailMessage').html('<p class="text-success alert-success">mail correct</p>');
            } else {
                $('.mailMessage').html('<p class="text-danger alert-danger">mail incorrect</p>');
            }
        });
    });

    // verifier le mail via AJAX afin de verifier sa disponibilité et ainsi eviter toute occurence possible en base de donnees
    $('#mail').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/addUser_ctrl.php', {mailTest: $(this).val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 0) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.mailMessage').html('<p class="text-success alert-success">L\'adresse mail est disponible</p>');
            } else {
                $('.mailMessage').html('<p class="text-danger alert-danger">L\'adresse mail est déjà utiliser</p>');
            }
        });
    });
    // verifier la confimation du pass via AJAX afin de le modiifer
    $('#pass2').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/modifPass_ctrl.php', {testConfirm: $(this).val(), confirmTest: $('#pass1').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmPass').html('<p class="text-success alert-success">mot de passe correct</p>');
            } else {
                $('.confirmPass').html('<p class="text-danger alert-danger">vos mot de passe ne corresponde pas</p>');
            }
        });
    })
    // verifier la confimation du pass via AJAX sur l'input inverse afin d'eviter tous contournement
    $('#pass1').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/modifPass_ctrl.php', {testConfirm: $(this).val(), confirmTest: $('#pass2').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmPass').html('<p class="text-success alert-success">mot de passe correct</p>');
            } else {
                $('.confirmPass').html('<p class="text-danger alert-danger">vos mot de passe ne corresponde pas</p>');
            }
        });
    })
    // verifier la confimation du mail via AJAX afin de le modifier
    $('#mail2').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/modify_mail.php', {mailConfirm: $(this).val(), confirmMail: $('#mail1').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmMail').html('<p class="text-success alert-success">mail correct</p>');
            } else {
                $('.confirmMail').html('<p class="text-danger alert-danger">votre mail ne corresponde pas</p>');
            }
        });
    })
    // verifier la confimation du mail via AJAX afin de le modifier
    $('#mail1').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/modify_mail.php', {confirmMail: $(this).val(), mailConfirm: $('#mail2').val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmMail').html('<p class="text-success alert-success">mail correct</p>');
            } else {
                $('.confirmMail').html('<p class="text-danger">votre mail ne corresponde pas</p>');
            }
        });
    })
    // verifier le mail via AJAX afin de verifier sa disponibilité et ainsi eviter toute occurence possible en base de donnees
    $('#mail1').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/modify_mail.php', {mailConfirm: $(this).val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 0) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmMail').html('<p class="text-success alert-success">L\'adresse mail est disponible</p>');
            } else {
                $('.confirmMail').html('<p class="text-danger alert-danger">L\'adresse mail est déjà utiliser</p>');
            }
        });
    });
    // Method ajax qui permet la verification de la confirmation du captcha sur le formualire d'inscription
    $('#Button1').click(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/captcha_ctrl.php', {string2: removeSpaces($('#txtInput').val()), string1: removeSpaces($('#mainCaptcha').val()), confirmCaptcha: removeSpaces($(this).val())}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmCaptcha').html('<div class="form-group font"><label for="valider"></label><input type="submit" name="valider" class="btn btn-success btn-lg shadow" value="S\'inscrire" /></div><div class="font titre"><p>En cliquant sur Inscription, vous acceptez <a href="https://www.lacapsulememorial.fr/index.php?conditions">nos Conditions générales et nos Mentions légales</a></p></div>');
            } else {
                $('.confirmCaptcha').html('<p class="text-danger alert-danger">Verifiez votre saisie</p>');
            }
        });
    })
    // Method ajax qui permet la verification de la confirmation du captcha afin de pouvoir laisser un commentaire
    $('#commentInput').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/captcha_ctrl.php', {string2: removeSpaces($(this).val()), string1: removeSpaces($('#mainCaptcha').val()), confirmCaptcha: removeSpaces($('#Button2').val())}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmCaptcha').html('<input type="submit" name="registerComment" class="btn btn-success" value="Soumettre mon commentaire" />');
            } else {
                $('.confirmCaptcha').html('<p class="text-danger alert-danger">Verifiez votre saisie</p>');
            }
        });
    })
    // Method ajax qui permet la verification de la confirmation du captcha formulaire de contact
    $('#contactInput').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('controler/captcha_ctrl.php', {string2: removeSpaces($(this).val()), string1: removeSpaces($('#mainCaptcha').val()), confirmCaptcha: removeSpaces($('#Button3').val())}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if (data == 1) {
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.confirmCaptcha').html('<input type="hidden" name="action" value="envoyer" /><button type="submit" class="btn btn-primary shadow">Envoyer</button>');
            } else {
                $('.confirmCaptcha').html('<p class="text-danger alert-danger">Verifiez votre saisie</p>');
            }
        });
    })
// Permet d'inverser le type d'un input
    $('.view').click(function () {
        $.post('controler/view_ctrl.php', {view: removeSpaces($(this).val())}, function (data) {
            if (data == 1) {
                $('#passconnect').attr('type', 'text');
            }else {
                $('#passconnect').attr('type', 'password');
            }
        });
    })

    $('#ajax').click(function () {
        $.post('controler/paypal_ctrl.php', {
                ajax: removeSpaces($(this).val()),
                adresse:removeSpaces($('#adresse').val()),
                postalCode:removeSpaces($('#postalCode').val()),
                city:removeSpaces($('#city').val()),
                id_ya_users:removeSpaces($('#id_ya_users').val())},
            function (data) {
                if (data == 1) {
                    $('#paypal-ajax').html('<button type="submit" name="buy" id="buy" class="btn btn-success" value="payer">Payer</button>');
                }else {
                    $('#paypal-ajax').html('<h3 class="text-danger">Merci de remplir le formulaire</h3>');
                }
            });
    })
});
