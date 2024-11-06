<?php
    require_once 'header.php';
    if (isset($_SESSION['error_message']))
    {?>
        <div class="container mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center my-4">
                        <h1 class="page-title text-success">Erreur</h1>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-12 text-center my-4">
                        <div class="alert alert-danger " role="alert">
                            <h3 class=".fs-4 text"> Une erreur s'est produite : "<?php echo htmlspecialchars($_SESSION['error_message']) ?> </h1>
                        </div>
                    </div>
                </div>
        <?php unset($_SESSION['error_message']);
    }
?>