$(document).ready(function () {
    //click sur l'id btn
    $('#btn').click(function () {
        console.log('HELLO!');
        alert('HELLO!');
        $.ajax("http://localhost/bonjour.php", //appel de bonjour.php sur le serveur web
    {
    type: "GET",
    success: function (resultat) {
        $("#result").html(resultat);
    }
    });
    });
});