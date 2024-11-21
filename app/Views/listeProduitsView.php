<?php
require_once 'header.php';
?>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success">Gestion des produits</h1>
            </div>
        </div>
        <a class="btn btn-success mb-3" href="../publics/ajout-produit.php">Ajouter un nouveau produit</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if (!empty($produits)) {
                foreach ($produits as $produit) { ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img height="50px" width="50px" 
                                src="<?php echo (!empty($produit->getcheminImage())) 
                                    ? '../ressources/' . $produit->getcheminImage()
                                    : '../ressources/images-produit/image-back.png'; ?>">
                        </td>
                        <td><?= htmlspecialchars($produit->getNom()); ?></td>
                        <td><?= htmlspecialchars($produit->getQuantite()); ?></td>
                        <td><?= htmlspecialchars($produit->getPrixUnitaire()); ?></td>
                        <td><?= htmlspecialchars($produit->getNomCategorie()); ?></td>
                        <td>
                            <a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a>
                            <a class="btn btn-primary" href="../publics/modifier-produit.php?id=<?= $produit->getId(); ?>"><i class="bi bi-pencil-square"></i></a>
                            <form method="POST" action="../publics/liste-produits.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='7'>Aucun produit trouvé.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
