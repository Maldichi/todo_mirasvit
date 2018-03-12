<html>
<head>
</head>
<body>
<p>
    <?php
    class Task {
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
        public function Subj($subject){
            return $this->subject = $subject;
        }
    }

    class Repository extends Task
    {

        function List()
        {
            $connection = new mysqli($this->server, $this->user, $this->pass, $this->data);
            $res = "SELECT * FROM tasks";
            $result = $connection->query($res);
            return $result;
        }
//        public function getId($id)
//        {
//            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
//            $id = "SELECT '$id' FROM tasks";
//            $result = $connection->query($id);
//            $row = $result->fetch_array(MYSQLI_ASSOC);
//        }
//        public function delTask ($id) {
//            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
//            if (isset($_POST['del_submit'])) {
//                if(!empty($id)){
//                    $id = "DELETE FROM tasks WHERE id = $id";
//                    $connection->query($id);
//                }
//            }
//        }

        public function Save($subject)
        {

            $connection = new mysqli($this->server, $this->user, $this->pass, $this->data);

            if (isset($_POST['submit'])) {
                if (!empty($subject)) {
                    $sql = "INSERT INTO tasks (name) VALUES ('$subject')";
                    $connection->query($sql);
                }

            }
        }

        public function New()
        {
            return new Task();
        }
    }

    $con = new Repository();
    $tasks = $con->New();
    $task = $tasks->Subj($_POST['task']);
    $con->Save($task);
    $list = $con->List();
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
