<?php
require_once 'partial/header.php';
require_once './database/database.php';

$id = $_GET['id'];
$data = selectOneStudent($id);

foreach ($data as $key) {
?>
    <div class="container p-4">
        <form action="./update_model.php" method="post">
            <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $key['name']; ?>">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Age" name="age" value="<?php echo $key['age']; ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $key['email']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Image URL" name="profile" value="<?php echo $key['profile']; ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>
    </div>
<?php
}
require_once 'partial/footer.php';
?>