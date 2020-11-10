/**
 * Created by yamine on 21/12/19.
 */
paypal.Button.render ({
    env: 'sandbox', // Ou 'production',
    commit: true, // Affiche le bouton  "Payer maintenant"
    locale: 'fr_FR',
    style: {
        color: 'gold', // ou 'blue', 'silver', 'black'
        size: 'responsive' // ou 'small', 'medium', 'large'
    },
    payment: function () {
        return paypal.request.post('controler/payment.php').then(function(data){
            return data.id;
        });
    },
    onAuthorize: function (data, actions) {
        return paypal.request.post('controler/pay.php', {
            paymentID: data.paymentID,
            payerID: data.payerID
        }).then(function(data){
            document.location.href = 'index.php?success=paypal';
        }).catch(function (err) {
            console.log('erreur', err)
        });
    }
}, '#buton-paypal');