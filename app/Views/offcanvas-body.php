<div class="offcanvas offcanvas-end d-flex flex-column" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="fs-4 text-success text-center fw-bold" id="offcanvasRightLabel">Informations personnelles</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <img src="../ressources/profile-icon.jpeg" style="width: 120px; height: auto;" class="rounded mx-auto d-block">
        <p class="fs-6 text-start"><span class="fw-bold">Prenom : </span> <?= htmlspecialchars($_SESSION['utilisateur']->getPrenom()) ?> </p>
        <p class="fs-6 text-start"><span class="fw-bold">Nom : </span> <?= htmlspecialchars($_SESSION['utilisateur']->getNom()) ?> </p>
        <p class="fs-6 text-start"><span class="fw-bold">Courriel : </span> <?= htmlspecialchars($_SESSION['utilisateur']->getCourriel()) ?> </p>
        <p class="fs-6 text-start"><span class="fw-bold">Telephone: </span> <?= htmlspecialchars($_SESSION['utilisateur']->getTelephone()) ?> </p>
        <p class="fs-6 text-start"><span class="fw-bold">Date de naissance : </span> <?= htmlspecialchars($_SESSION['utilisateur']->getDateNaissance()) ?> </p>
        <p class="fs-6 text-start"><span class="fw-bold">Adresse : </span> <?= htmlspecialchars($_SESSION['utilisateur']->getAdresse()) ?> </p>
    </div>

    <div class="d-grid gap-2 mt-auto">
        <a class="btn btn-success w-100" href='modificationInfoPers.php'>Modifier Info</a>
        <a class="btn btn-danger w-100" href="../publics/deconnexion.php">Deconnexion</a>
    </div>
</div>
