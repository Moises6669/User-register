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
}
