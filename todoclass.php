<html>
<head>
</head>
<body>
<p>
    <?php
    class Task {
        public function Subj($subject){
            return $this->subject = $subject;
        }
    }
    class DB{
        protected $server = '127.0.0.1';
        protected $user = 'root';
        protected $pass = 'astral';
        protected $data = 'todo_base';
        protected $connection;
        public function __construct() {
            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
            if ( mysqli_connect_errno() ) {
                printf("Connection failed: %s\/", mysqli_connect_error());
                exit();
            }
        }
    }


    class Repository extends DB
    {
        function List()
        {
            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
            $res = "SELECT * FROM tasks";
            $result = $connection->query($res);
            return $result;
        }
        public function Save($subject)
        {
            $connection = new mysqli($this->server, $this->user, $this->pass, $this->data);
            $sql = "INSERT INTO tasks (name) VALUES ('$subject')";
            $connection->query($sql);
        }
        public function New()
        {
            return new Task();
        }
    }


    $con = new Repository();
    $tasks = $con->New();
    $task = $tasks->Subj($_POST['task']);

    $list = $con->List();

    if (isset($_POST['submit'])) {
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
