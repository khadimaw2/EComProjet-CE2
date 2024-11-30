<style>
    .offcanvas-header {
        background-color: #198754; /* Couleur d'accent */
        color: #fff; /* Texte blanc pour le contraste */
        padding: 15px;
        border-radius: 5px 5px 0 0;
    }

    .offcanvas-header h5 {
        font-size: 24px;
        margin: 0;
    }

    .offcanvas-body {
        padding: 20px;
        background-color: #1f1f1f; /* Couleur pour le mode sombre */
        color: #dcdcdc; /* Texte clair */
    }

    .offcanvas-body img {
        border-radius: 50%; /* Rend l'image circulaire */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Effet d'ombre */
        margin-bottom: 20px;
    }

    .offcanvas-body .info-container {
        display: flex;
        flex-direction: column;
        row-gap: 10px; /* Espacement vertical entre les éléments */
    }

    .offcanvas-body p {
        font-size: 16px;
        margin-bottom: 0;
    }

    .offcanvas-body span {
        color: #198754; /* Couleur d'accent */
        font-weight: bold;
    }

    .offcanvas-body hr {
        border-top: 1px solid #444; /* Séparateur subtil */
        margin: 15px 0;
    }

    .offcanvas-footer .btn {
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .offcanvas-footer .btn-success {
        background-color: #198754;
        border: none;
    }

    .offcanvas-footer .btn-success:hover {
        background-color: #145b40;
    }

    .offcanvas-footer .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .offcanvas-footer .btn-danger:hover {
        background-color: #a71d2a;
    }
</style>

<div class="offcanvas offcanvas-end d-flex flex-column" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <!-- Header -->
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Informations personnelles</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body">
        <!-- Photo de profil -->
        <div class="text-center mb-3">
            <img src="../ressources/profile-icon.jpeg" alt="Profil" style="width: 120px; height: auto;">
        </div>
        <hr>
        <!-- Informations personnelles -->
        <div class="info-container">
            <p class="fw-bold">
                <span>Prenom :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getPrenom())?>
                <?php if ($_SESSION['utilisateur']->getRole()== 'admin') {?>
                    <i class="bi bi-patch-check-fill text-warning"></i>
                <?php }elseif ($_SESSION['utilisateur']->getRole()== 'employer') {?>
                    <i class="bi bi-patch-check-fill text-success"></i>
                <?php } ?>
            </p>
            <p class="fw-bold"><span>Nom :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getNom()) ?></p>
            <p class="fw-bold"><span>Courriel :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getCourriel()) ?></p>
            <p class="fw-bold"><span>Telephone :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getTelephone()) ?></p>
            <p class="fw-bold"><span>Date de naissance :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getDateNaissance()) ?></p>
            <p class="fw-bold"><span>Adresse :</span> <?= htmlspecialchars($_SESSION['utilisateur']->getAdresse()) ?></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="offcanvas-footer d-grid gap-3 px-3 mt-auto">
        <a class="btn btn-success w-100" href='modificationInfoPers.php'>Modifier Info</a>
        <a class="btn btn-danger w-100" href="../publics/deconnexion.php">Deconnexion</a>
    </div>
</div>
