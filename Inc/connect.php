<?php

class Database
            {
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = 'secury';
        public function connect(){
            try
                {
                    $conn = new PDO("mysql:host=$this->servername;dbname=myDB", $this->username, $this->password);
                        // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $success = "Connected successfully";
                    return $success;

                }

                catch
                    (PDOException $e) {

                        $error = "Connection failed: " . $e->getMessage();
                        return $error;

                }
            }

            public function InsertData(){
                $sql = "INSERT INTO MyGuests (firstname, lastname, email)
                              VALUES ('John', 'Doe', 'john@example.com')";
                try {
                    $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    echo "New record created successfully";
                } catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }

                $conn = null;

            }

        }