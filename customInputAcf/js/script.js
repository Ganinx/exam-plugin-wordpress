function updateCountdown(eventTimestamp) {
    // Date et heure actuelles
    var currentTimestamp = Math.floor(Date.now() / 1000);

    // Calcul du temps restant jusqu'à l'événement
    var timeLeft = eventTimestamp - currentTimestamp ;

    // Si le temps restant est négatif, l'événement est passé
    if (timeLeft < 0) {
        document.getElementById('countdown').innerHTML = 'L\'événement est terminé.';
        return;
    }

    // Convertir le temps restant en jours, heures, minutes et secondes
    var daysLeft = Math.floor(timeLeft / (60 * 60 * 24));
    var hoursLeft = Math.floor((timeLeft % (60 * 60 * 24)) / (60 * 60));
    var minutesLeft = Math.floor((timeLeft % (60 * 60)) / 60);
    var secondsLeft = timeLeft % 60;

    if (timeLeft < 86400){
        var countdownHTML = '<h2>L\'événement démarre dans :</h2>';
        countdownHTML += '<div id="countdown-clock">';
        countdownHTML += '<span>' + hoursLeft + ' Heures</span>';
        countdownHTML += '<span>' + minutesLeft + ' Minutes</span>';
        countdownHTML += '<span>' + secondsLeft + ' Secondes</span>';
        countdownHTML += '</div>';
        document.getElementById('MyClockDisplay').innerHTML = countdownHTML;
    }
}

// Date et heure de l'événement (à partir des méta-données du produit)
var eventTimestamp = document.getElementById('variableAPasser').value;

// Mettre à jour le compteur toutes les secondes
setInterval(function() {
    updateCountdown(eventTimestamp);
}, 1000);

// Appeler la fonction une première fois pour initialiser le compteur
updateCountdown(eventTimestamp);








