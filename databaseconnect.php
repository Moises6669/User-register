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
            $this->conexion = new PDO("mysql:host=$this->hostname; dbname=$this->dbName", $this->user, "");
        } catch (PDOException $err) {
            die("Could not connect to the database  $this->dbName :" . $err->getMessage());
        }
    }

    public function AllTable()
    {
        $query = "SELECT * FROM USUARIOS";

        $sql = $this->conexion->query($query);

        //la forma en que se obtenedran los datos
        $arrDatos = $sql->fetchALL(PDO::FETCH_ASSOC);

        foreach ($arrDatos as $muestra) {
            $name  = $muestra["NAME"];
            $email = $muestra["EMAIL"];
        }
    }

    public function NewUser($name, $email, $password)
    {
        $sql = "INSERT INTO USUARIOS (NOMBRE,EMAIL,PASSWORD) VALUES (:name,:email,:password)";

        $insert = $this->conexion->prepare($sql);

        $password = password_hash(
            base64_encode(hash('sha256', $password, true)),
            PASSWORD_DEFAULT
        );

        $insert->bindParam(':name', $name, PDO::PARAM_STR, 20);
        $insert->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $insert->bindParam(':password', $password);

        $insert->execute();
    }
}
