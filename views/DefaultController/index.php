<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/navbar.html'); ?>

<div class="container">
    <div class="row">
        <h1 class="col-12">HOMEPAGE</h1>
        <p>
            <?= $text ?>
        </p>

        <?php
        if(isset($_SESSION) && !empty($_SESSION)) {
            print_r($_SESSION["name"]);
        }
        ?>
        <form action="?page=logout" method="POST">

        <input type="submit" value="Logout" class="btn btn-primary btn-lg float-right" />

        </form>

    </div>
</div>

</body>
</html>