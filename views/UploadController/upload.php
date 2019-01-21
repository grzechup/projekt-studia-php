<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>
<div class="container">
    <a href="?page=index">Go back...</a>
</div>
<h1>UPLOAD</h1>

<?php foreach($message as $item): ?>
    <div><?= $item ?></div>
<?php endforeach; ?>

<form action="?page=upload" method="POST" ENCTYPE="multipart/form-data">


    <input type="hidden" name="size" value="1000000">

    <div>
        <textarea name="name" cols="15" rows="1" placeholder="Name of the file..."></textarea>
    </div>
    <div>
        <textarea name="description" cols="40" rows="4" placeholder="Add some description of your file..."></textarea>
    </div>
    <div>
        <input type="file" name="file">
    </div>
    <input type="submit" value="Submit" class="btn btn-primary btn-lg float-right"/>
</form>

</body>
</html>