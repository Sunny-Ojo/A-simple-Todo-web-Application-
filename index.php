<?php
include "php_files/menu.php";
require "php_files/db_conn.php";
if (isset($_POST["submit"])) {
    $error = "";
    $success = "";
    if (!empty($_POST["todo"])) {
        $task = $_POST["todo"];
        $task = filter_var($task, FILTER_SANITIZE_STRING);
        $task = trim($task);
        $stmt = $conn->prepare("INSERT INTO `tasks` (`todos`) value(?)");
        $stmt->execute([$task]);
        if ($stmt) {
            $success = "<div class='badge-success text-capitalize text-center'>successfully created</div>";
        }
    } else {
        $error = "<div class='badge-danger text-capitalize text-center'>please enter a value</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="A simple to do web application that allows users to add, edit and delete
       their todo lists" />
    <meta name="author" content="Sunny Ojo" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/all.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
    <title>To do Web Application</title>
</head>

<body>
    <div class="container">
        <div class="main col-md-10 offset-md-1">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <h2 class="text-center">Create your Todo Lists</h2>
                <?php if (isset($error)) {echo $error;}
if (isset($success)) {echo $success;}
?>
                <input type="text" name="todo" class="form-control" /> <br />
                <button type="submit" name="submit" class="btn btn-success">
                    Create
                </button>
            </form>

        </div>
        <br>
        <div>
            <table class=" details table-hover" border=1 align=center>
                <tr>
                    <th>ID</th>
                    <th>TODO TASKS</th>
                    <th>DATE CREATED</th>
                    <th>ACTION</th>
                </tr>
                <?php
$dis = $conn->query("SELECT * FROM `tasks`");
foreach ($dis as $me) {
    echo "<tr>
          <td>" . $me['id'] . "</td>
          <td>" . $me['todos'] . "</td>
          <td>" . $me['created_on'] . "</td>
          <td><a href='remove.php?id=" . $me['id'] . "'><i title='Delete this task' class='fa fa-trash'></i></a>
          <a href='edit.php?id=" . $me['id'] . "'><i title='Edit this task' class='fa fa-pen-alt'></i></a></td>


          </tr>";
}

?>
            </table>
        </div>
    </div>
</body>

</html>