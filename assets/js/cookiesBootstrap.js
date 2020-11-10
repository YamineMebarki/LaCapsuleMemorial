/*CSS body.cookiewarning {
    padding-bottom: 15em;
}
body div.cookiewarning {
    display: none;
}
body.cookiewarning div.cookiewarning {
    padding: 1em;	
    display: block;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 100;
    background-color: lightblue;
    color: black;
}

body .removecookie {
    display: inline-block;
}

body.cookiewarning .removecookie {
    display: none;
}
*/
/*<div class="cookiewarning text-center">
 <h3>Bienvenue sur La Capsule</h3>
 <p>En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de Cookies ou autres traceurs pour améliorer et personnaliser votre navigation sur le site, réaliser des statistiques et mesures d'audiences, vous proposer des produits et services ciblés et adaptés à vos centres d'intérêt et vous offrir des fonctionnalités relatives aux réseaux et médias sociaux. .</p>
 <span class="btn btn-primary btn-xl">Accepter</span>
 <a href="https://google.fr"><span class="btn btn-danger btn-xl">Refuser</span></a>
 </div>*/
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
var $body = $("body"),
        sCookieName = "cookiewarning",
        $cookiewarning = $("div." + sCookieName);

function setCookieWarning(active) {
    (!!active) ? $body.addClass(sCookieName) : $body.removeClass(sCookieName)
}
$cookiewarning.on("click", function () {
    createCookie(sCookieName, 1, 365)
    setCookieWarning(false);
});
// cookie warning
if (readCookie(sCookieName) != 1) {
    setCookieWarning(true);
}
$(".removecookie").on("click", function () {
    eraseCookie(sCookieName);
    setCookieWarning(false);
})


