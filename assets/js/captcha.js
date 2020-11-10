// function captcha qui genere une suite de STR Maj / Min / INT aleatoire
function Captcha() {
    // variable qui stoke les caracteres autorisers pour la generation du captcha 
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    // variable i qui definira la limite de longueur de mmon captcha
    var i;
    for (i = 0; i < 6; i++) {
        // initialisation de mes sept caracteres selectionner grace a la function math.random qui permet de generer un caractere aleatoirement
        var a = alpha[Math.floor(Math.random() * alpha.length)];
        var b = alpha[Math.floor(Math.random() * alpha.length)];
        var c = alpha[Math.floor(Math.random() * alpha.length)];
        var d = alpha[Math.floor(Math.random() * alpha.length)];
        var e = alpha[Math.floor(Math.random() * alpha.length)];
        var f = alpha[Math.floor(Math.random() * alpha.length)];
        var g = alpha[Math.floor(Math.random() * alpha.length)];
    }
    // variable qui concatene mes variable qui stocke mes caractere selectionner aleatoirement
    var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
    var str = 'Veuillez copier le captcha afin de pouvoir valider votre inscription.';
      var com = 'Veuillez copier le captcha afin de pouvoir valider votre commentaire.';
    var msg = 'Veuillez copier le captcha afin de pouvoir valider votre message.';
    // j'affiche le code generer grace a la function innerHTML
    document.getElementById("mainCaptcha").innerHTML = code
    document.getElementById("mainCaptcha").value = code
        document.getElementById("main").innerHTML = str
    document.getElementById("main").value = str
          document.getElementById("msg").innerHTML = msg
    document.getElementById("msg").value = msg
          document.getElementById("com").innerHTML = com
    document.getElementById("com").value = com
}
//La méthode split() permet de diviser une chaîne de caractères à partir d'un séparateur pour fournir un tableau de sous-chaînes.
// crée et renvoie une nouvelle chaîne de caractères en concaténant tous les éléments d'un tableau
function removeSpaces(string) {
    return string.split(' ').join('');
}

