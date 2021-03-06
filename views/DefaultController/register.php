<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>
<div class="container">
    <a href="?page=login">Login</a>
</div>
<div class="container">
    <div clas="row">
        <div class="col-sm-6 offset-sm-3">
            <h1 class="panel-header">Register new account</h1>
            <hr>
            <?php if(isset($message)): ?>
                <?php foreach($message as $item): ?>
                    <div><?= $item ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form action="?page=register" method="POST">
            <div class="form-group row">
                    <label for="inputName" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="name" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">email</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="email" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password"  required/>
                    </div>
                </div>
                <input type="submit" value="Register" class="btn btn-primary btn-lg float-right" />
            </form>
        </div>
    </div>
</div>

</body>
</html>

