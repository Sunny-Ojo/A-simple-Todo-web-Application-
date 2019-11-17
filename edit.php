<?php
require "php_files/db_conn.php";
$id = $_GET["id"];
$error = "";
if (isset($_POST["cancel"])) {
    header("location:index.php");
}
if (isset($_POST["submit"])) {
    $task = $_POST["todo"];
    $id = $_POST['task_id'];
    $task = filter_var($task, FILTER_SANITIZE_STRING);
    $task = trim($task);
    $stmt = $conn->prepare("UPDATE tasks SET todos = ? WHERE id =?");
    $stmt->execute([$task, $id]);
    header("location:index.php");} elseif
(!empty($_POST["todo"])) {$error = '
<div class="badge-danger text-center text-capitalize">please enter a value</div>
';}

$con = $conn->query("SELECT todos FROM tasks WHERE id =" . $id);
$pos =
$con->fetchAll();foreach ($pos as $ta); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="description"
      content="A simple to do web application that allows users to add, edit and delete
       their todo lists"
    />
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
        <form action="edit.php" method="post">
          <h2 class="text-center">Edit Todo List</h2>
          <?php if (isset($error)) {echo $error;}
?>
          <input type="hidden" name="task_id" value="<?php echo $id; ?>" />
          <input
            type="text"
            name="todo"
            class="form-control"
            value="<?php echo $ta['todos'] ?>"
          />
          <br />
          <button
            type="submit"
            name="submit"
            class="btn btn-success"
          >
            Change
          </button>
          <button name="cancel" class="btn btn-danger" >
            Cancel
          </button>
        </form>
      </div>
    </div>
  </body>
</html>
