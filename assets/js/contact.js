document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Récupérer les données du formulaire
            const formData = new FormData(this);
            
            // Désactiver le bouton d'envoi
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Envoi en cours...';
            
            // Envoyer les données
            fetch('../assets/mail/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Réactiver le bouton
                submitButton.disabled = false;
                submitButton.innerHTML = 'Envoyer le message';
                
                // Afficher le message de réponse
                if (data.success) {
                    // Message de succès
                    alert(data.message);
                    contactForm.reset();
                } else {
                    // Message d'erreur
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                submitButton.disabled = false;
                submitButton.innerHTML = 'Envoyer le message';
                alert('Une erreur est survenue. Veuillez réessayer plus tard.');
            });
        });
    }
}); 