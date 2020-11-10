<?php
if (isset($_SESSION['id'])):
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="mt-5 text-center mb-4 font mb-5">Méthodes de paiement</h1>
            <div class="mb-5">
                <div id="buton-paypal"></div>
                <div class="confirmPay"></div>
            </div>
        </div>
    </div>
</div>
<?php else:
    echo '<script>window.location.href="error-404.php";</script>';
    endif;
    ?>