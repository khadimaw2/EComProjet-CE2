<nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">BeautyStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active text-light" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="store.php">Store</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="panier.php">Voir panier</a></li>
                <?php if(isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['description'] == "client") { ?>
                    <li class="nav-item"><a class="nav-link text-light" href="listeCommandeUtilisateur.php">Mes commandes</a></li>
                <?php } elseif(isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['description'] == "admin") { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestion produits
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ajoutProduit.php">Ajout produit</a></li>
                            <li><a class="dropdown-item" href="listeProduits.php">Liste des produits</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-light" href="listeUtilisateurs.php">Gestion utilisateurs</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="listeToutesLesCommandes.php">Gestion Commandes</a></li>
                <?php } ?>
            </ul>
            <?php if(isset($_SESSION['utilisateur'])) { ?>
                <form class="d-flex me-2">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche">
                    <button class="btn btn-outline-light" type="submit">Rechercher</button>
                </form>
                <a class="btn btn-light text-success" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="#"><i class="bi bi-person-circle"></i></a>
            <?php } else { ?>
                <a class="btn btn-dark" href="connexion.php">Se connecter</a>
            <?php } ?>
        </div>
    </div>
</nav>