<?php

class Conexiones
{
    private $conexion;
    private $hostname = "localhost";
    private $user = "root";
    private $dbName = "contactos";

    public function connect()
    {

        try {
            $this->conexion = new PDO(
                "mysql:host=$this->hostname;
                dbname=$this->dbName",
                $this->user,
                ""
            );
            echo "Connected to $this->dbName at $this->hostname successfully.";
        } catch (PDOException $err) {

            die("Could not connect to the database  $this->dbName :" . $err->getMessage());
        }
    }

    public function QueryTable(string $query)
    {
         $sql = $this->conexion->query($query);

         $arrDatos = $sql->fetchALL(PDO::FETCH_ASSOC);

         foreach ($arrDatos as $muestra) {
           
            $name  = $muestra["EMAIL"];

            echo "<p>$name</p>";
         }
         
    }

    public function NewUser(string $name, string $email, string $password)
    {
        $query = "INSERT INTO USUARIOS (NOMBRE,EMAIL,PASSWORD) VALUES (:name,:email,:password)";

        $insert = $this->conexion->prepare($query);

        $insert->bindParam(':name',$name,PDO::PARAM_STR, 20);
        $insert->bindParam(':email',$email,PDO::PARAM_STR, 50);
        $insert->bindParam(':password',$password,PDO::PARAM_STR, 50);

        $insert->execute();
    }
}
