<html>
<head>
</head>
<body>
<p>
    <?php
    class Task {

        public function Subj($subject){
            return $subject;
        }
    }

    class DB{
        protected $server = '127.0.0.1';
        protected $user = 'root';
        protected $pass = 'astral';
        protected $data = 'todo_base';
        public function __construct() {

            $this->connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );

            if ( mysqli_connect_errno() ) {
                printf("Connection failed: %s\/", mysqli_connect_error());

                exit();
            }
            return $this->connection;
        }
    }


    class Repository extends DB
    {

        public function List()
        {
            $res = "SELECT * FROM tasks";
            $result = $this->connection->query($res);
            return $result;
        }

        public function New()
        {
            $this->task = new Task;
            return $this->task;
        }

        public function Save($task)
        {
            $this->task = $task;
            $sql = "INSERT INTO tasks (name) VALUES ('$this->task')";
            $this->connection->query($sql);
        }
    }



    $con = new Repository();
    $list = $con->List();
    if (isset($_POST['submit'])) {

        $tasks = $con->New();
//        var_dump($tasks);
        $task = $tasks->Subj($_POST['task']);
        if (!empty($task)) {
            $con->Save($task);
        }
    }
    ?>



<h1>Todo application</h1>
<form method="post" class="form">

    <label>Name of task</label>
    <input type="text" name="task" class="task">


    <button type="submit" name="submit" id="submit">Add Task</button>

</form>

<?php

foreach ($list as $key => $value) {
    echo 'Tasks # '. $value['id']. 'Tasks name:' .$value['name'].'<br>';
}

?>
</p>
</body>
</html>
