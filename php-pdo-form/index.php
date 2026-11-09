<?php
require 'db.php';

try {
    $stmt = $pdo->query("SELECT * FROM langages");
    $langages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des langages : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Développeur Web</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Profil Développeur</h2>
        <form id="devForm" action="process.php" method="POST">
            <div class="form-group">
                <label for="nomPrenom">Nom et Prénom :</label>
                <input type="text" id="nomPrenom" name="nomPrenom" placeholder="Votre nom complet" class="form-control">
                <div id="nomError" class="error-message">Veuillez entrer votre nom et prénom.</div>
            </div>

            <div class="form-group">
                <label>Quel langage(s) vous maîtrisez ?</label>
                <div class="checkbox-group">
                    <?php if (!empty($langages)): ?>
                        <?php foreach ($langages as $lang): ?>
                            <label>
                                <input type="checkbox" name="langages[]" value="<?php echo htmlspecialchars($lang['langage']); ?>"> 
                                <?php echo htmlspecialchars($lang['langage']); ?>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun langage disponible.</p>
                    <?php endif; ?>
                </div>
                <div id="langagesError" class="error-message">Veuillez sélectionner au moins un langage.</div>
            </div>

            <button type="submit" id="submitBtn">Envoyer</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#devForm').submit(function (event) {
                let isValid = true;

                // Validation Nom et Prénom
                const nomPrenom = $('#nomPrenom').val().trim();
                const nomError = $('#nomError');
                
                if (nomPrenom === '') {
                    nomError.text("Veuillez entrer votre nom et prénom.").show();
                    $('#nomPrenom').addClass('input-error');
                    isValid = false;
                } else if (nomPrenom.indexOf(' ') === -1) {
                    nomError.text("Veuillez entrer le nom et le prénom séparés par un espace.").show();
                    $('#nomPrenom').addClass('input-error');
                    isValid = false;
                } else {
                    nomError.hide();
                    $('#nomPrenom').removeClass('input-error');
                }

                // Validation Langages (Au moins un coché)
                // Utilisation du sélecteur jQuery pour vérifier si au moins une case est cochée
                if ($('input[name="langages[]"]:checked').length === 0) {
                    $('#langagesError').show();
                    isValid = false;
                } else {
                    $('#langagesError').hide();
                }

                // Bloquer l'envoi si non valide
                if (!isValid) {
                    event.preventDefault(); // Empêche la soumission du formulaire
                }
            });

            // Optionnel : Enlever l'erreur quand l'utilisateur commence à corriger
            $('#nomPrenom').on('input', function () {
                if ($(this).val().trim() !== '') {
                    $('#nomError').hide();
                    $(this).removeClass('input-error');
                }
            });

            // Evenement pour les checkbox dynamiques (delegation d'événement si nécessaire, mais ici .change marche car éléments créés au chargement PHP, pas AJAX)
            // Cependant, pour la robustesse si on passait en AJAX un jour : $(document).on('change', ...) mais ici le PHP génère le HTML initial donc le binding direct fonctionne.
            // On garde le code existant qui est compatible.
            $('input[name="langages[]"]').change(function () {
                if ($('input[name="langages[]"]:checked').length > 0) {
                    $('#langagesError').hide();
                }
            });
        });
    </script>
</body>

</html>