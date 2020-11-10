<hr/>
<hr/>
<hr/>
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://googletagmanager.com/ns.html?id=GTM-TNZSNXZ"
height="0" width="0" style="display:none;visibility:hidden" ></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="center alert-success">
    <h3 class="text-success"><?= isset($formSuccess['success']) ? $formSuccess["success"] : '' ?></h3>
    <h5 class="text-success "><?= isset($formSuccess['courriel']) ? $formSuccess["courriel"] : '' ?></h5>
    <h5 class="text-success "><?= isset($formSuccess['newMail']) ? $formSuccess["newMail"] : '' ?></h5>
</div>
<div  class="center alert-danger">
    <h3 class="text-danger"><?= isset($formError['co']) ? $formError["co"] : '' ?></h3>
    <h3 class="text-danger"><?= isset($formError['form']) ? $formError['form'] : ''; ?></h3>                 
    <h3 class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : ''; ?></h3>                 
    <h3 class="text-danger"><?= isset($formError['mailconnect']) ? $formError['mailconnect'] : ''; ?></h3>                 
    <h3 class="text-danger"><?= isset($formError['pass']) ? $formError['pass'] : ''; ?></h3>   
</div>
<div class="content shadow rounded">
    <header class="header">
        <div id="titre text-center" >
          <h1 class="titleFont center"><span class="wild">La Capsule</span></h1>
          <p class="titleFont center">Mémorial</p>
        </div>
        <h3 class="fontStyle center">Un lieu de mémoire pour tous.</h3>
        <div class="toScroll center">
            <a class="scrollTo rounded shadow" href="#QuiSommesNous"> Qui sommes nous ?</a>
        </div>
    </header>
</div>
