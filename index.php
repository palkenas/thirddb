<?php
include './controllers/UserController.php';

// --------------issaugojimas--------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['save'])) {
        $hasErrors = UserController::store();
        if (!$hasErrors) {
            header("Location:" . $_SERVER['REQUEST_URI']);
        }
        // 
        // neis po reloadinimo uzklausos
    }
    if (isset($_POST['edit'])) {
        $user = UserController::show();
    }
    if (isset($_POST['update'])) {
        UserController::update();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
    if (isset($_POST['destroy'])) {
        UserController::destroy();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
}
$users = UserController::index();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/main.css">
    <title>Third Data Base</title>
</head>

<body>

    <div class="container">
        <?php if (isset($_SESSION) && isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) { ?>
                <div class="alert alert-danger" role="allert">
                    <?= $error; ?>
                </div>
        <?php  }
        unset($_SESSION['errors']);
    } 
        ?>

        <form id="form" class="form-inline" action="" method="post">
            <div class="form-row">
                <div id="input1" class="form-group col-md-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" <?= isset($_POST['edit']) ? 'value="' . $user->name . '"' : '' ?>>
                </div>
                <div id="input2" class="form-group col-md-3">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" <?= isset($_POST['edit']) ? 'value="' . $user->surname . '"' : '' ?>>
                </div>
                <div id="input3" class="form-group col-md-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" <?= isset($_POST['edit']) ? 'value="' . $user->email . '"' : '' ?>>
                </div>
                <div id="input4" class="form-group col-md-3">
                    <label for="phonNum">Phone number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone" placeholder="Enter phone number" <?= isset($_POST['edit']) ? 'value="' . $user->phone . '"' : '' ?>>
                </div>
                <?= isset($_POST['edit']) ? '<input type="hidden" name="id" value="' . $user->id . '">' : "" ?>
                <button id="btn" class="btn btn-success" type="submit" name=<?= isset($_POST['edit']) ? '"update" > Atnaujinti' : '"save" > Išsaugoti' ?> </button>
            </div>
        </form>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                ?>
                    <tr>
                        <th scope="row"></th>
                        <td><?= $user->name; ?></td>
                        <td><?= $user->surname; ?> </td>
                        <td><?= $user->email; ?> </td>
                        <td><?= $user->phone; ?> </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                <button class="btn btn-warning" type="submit" name="edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                <button class="btn btn-danger" type="submit" name="destroy">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>