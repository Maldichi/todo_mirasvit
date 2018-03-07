<html>
<head>
</head>
<body>
<p>
    <?php
    $server = '127.0.0.1';
    $user = 'root';
    $pass = 'astral';
    $data = 'todo_base';

    $connection = mysqli_connect($server, $user, $pass, $data);
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }





//    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $err = '';

    if (isset ($_POST['submit'])){
        if(!empty($_POST['task'])){
            $add = $_POST['task'];
            $sql = "INSERT INTO tasks (name) VALUES ('$add')";
            mysqli_query($connection, $sql);
        }
        else{
            $err = 'Fulfill the input';
        }
    }
    $res = "SELECT * FROM tasks";
    $result = mysqli_query($connection, $res);
    ?>
<h1>Todo application</h1>
<form method="post" class="form">

    <label for="">Name of task</label>
    <input type="text" name="task" class="task">

<button type="submit" name="submit" id="add_task">Add Task</button>
    <?php if (isset($err)){?>
        <h6 style="color: crimson"><?php echo $err ?></h6><?php }?>
</form>
<?php
//echo '<pre>';
//var_dump(mysqli_fetch_array($result, MYSQLI_ASSOC));
//die();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        printf("Task number: %d  Task name: %s", $row["id"], $row["name"].'<br>');
    }

    if (isset($_POST['submit'])) {
        if (!empty($_POST['task'])) {
            $task = $_POST['task'];
            $res = mysqli_query($connection, "INSERT INTO tasks $task");
        }
        else {
            $err = "This field can`t be empty";
        }
    }
    ?>
</p>
</body>
</html>