<html>
<head>
</head>
<body>
<p>
    <?php


    class Repository {
        protected $server = '127.0.0.1';
        protected $user = 'root';
        protected $pass = 'astral';
        protected $data = 'todo_base';

        public function connect() {

            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );

            if ( mysqli_connect_errno() ) {
                printf("Connection failed: %s\/", mysqli_connect_error());
                exit();
            }

            return true;
        }
        public function listing () {
            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
            $res = "SELECT * FROM tasks";
            $result = $connection->query($res);
            $len =  $result->num_rows;

            for ($i=0;$i<$len; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo '# of task '. $row['id'].'Name of task '. $row['name'].'<br>';
            }

        }

//        public function getId()
//        {
//            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
//            $id = "SELECT id FROM tasks";
//            $result = $connection->query($id);
//            $row = $result->fetch_array(MYSQLI_ASSOC);
//
//
//        }
        public function saveTask($subject) {
            $connection = new mysqli( $this->server, $this->user, $this->pass, $this->data );
            if (isset($_POST['submit'])) {
                if(!empty($subject)){
                    $sql = "INSERT INTO tasks (name) VALUES ('$subject')";
                    $connection->query($sql);
                }
                else {
                   echo 'empty field';
                }
            }
        }
    }




    class Task {
        public $id;
        public $subject;

        public function setId($id, $subject)
        {
            $this->id = $id;
            $this->subject = $subject;
        }
    }
    $task = new Task();

    $con = new Repository();
    $con->connect();
    $con->getId();
    ?>

    <h1>Todo application</h1>
<form method="post" class="form">

    <label for="">Name of task</label>
    <input type="text" name="task" class="task">

<button type="submit" name="submit" id="add_task">Add Task</button>

</form>
<p><?php
$con->saveTask($_POST['task']);?></p>
<?php
$con->listing();
?>
</p>
</body>
</html>