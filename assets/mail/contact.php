<?php
// Définir les en-têtes pour éviter les problèmes de caractères spéciaux
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Fonction pour nettoyer les données
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialiser le tableau de réponse
$response = array(
    'success' => false,
    'message' => ''
);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer et nettoyer les données du formulaire
    $name = isset($_POST['name']) ? cleanInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? cleanInput($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? cleanInput($_POST['subject']) : '';
    $phone = isset($_POST['phone']) ? cleanInput($_POST['phone']) : '';
    $message = isset($_POST['message']) ? cleanInput($_POST['message']) : '';

    // Validation des champs
    $errors = array();

    if (empty($name)) {
        $errors[] = "Le nom est requis";
    }

    if (empty($email)) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide";
    }

    if (empty($subject)) {
        $errors[] = "Le sujet est requis";
    }

    if (empty($message)) {
        $errors[] = "Le message est requis";
    }

    // Si pas d'erreurs, envoyer l'email
    if (empty($errors)) {
        // Email de destination
        $to = "votre-email@domaine.com"; // Remplacez par votre email

        // Construire le contenu de l'email
        $email_content = "Nouveau message de contact\n\n";
        $email_content .= "Nom: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Téléphone: $phone\n";
        $email_content .= "Sujet: $subject\n\n";
        $email_content .= "Message:\n$message\n";

        // En-têtes de l'email
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Tentative d'envoi de l'email
        try {
            if (mail($to, "Nouveau contact: $subject", $email_content, $headers)) {
                $response['success'] = true;
                $response['message'] = "Votre message a été envoyé avec succès !";
                
                // Enregistrer dans un fichier log (optionnel)
                $log_file = 'contact_log.txt';
                $log_content = date('Y-m-d H:i:s') . " - Message reçu de $name ($email)\n";
                file_put_contents($log_file, $log_content, FILE_APPEND);
            } else {
                throw new Exception("Erreur lors de l'envoi de l'email");
            }
        } catch (Exception $e) {
            $response['message'] = "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer plus tard.";
        }
    } else {
        // S'il y a des erreurs, les renvoyer
        $response['message'] = implode("\n", $errors);
    }
} else {
    $response['message'] = "Méthode non autorisée";
}

// Renvoyer la réponse en JSON
echo json_encode($response);
?> 