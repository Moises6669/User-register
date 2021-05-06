<?php

class Conection
{
    private $conexion;
    private $hostname = "localhost";
    private $user = "root";
    private $dbName = "contactos";
    private static $instancia;
    private $dbh;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->hostname; dbname=$this->dbName", $this->user, "");
        } catch (PDOException $err) {
            die("Could not connect to the database  $this->dbName :" . $err->getMessage());
        }
    }
    public static function singleton_conexion()
    {

        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }

        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
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
        $queryEmail = "SELECT COUNT(*) FROM USUARIOS WHERE EMAIL=:email";

        $searchEmail = $this->conexion->prepare($queryEmail);

        $searchEmail->bindParam(":email", $email);

        $searchEmail->execute();

        $emailExist =  $searchEmail->fetchColumn();

        if ($emailExist > 0) {

            echo "<div class='emailexist'>
                    <p>Este correo ya existe</p>
            </div> ";
        } else {

            $sql = "INSERT INTO USUARIOS (NOMBRE,EMAIL,PASSWORD) VALUES (:name,:email,:password)";

            $insert = $this->conexion->prepare($sql);

            $password = password_hash($password, PASSWORD_BCRYPT);

            $insert->bindParam(':name', $name, PDO::PARAM_STR, 20);
            $insert->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $insert->bindParam(':password', $password);

            $insert->execute();
        }
    }


    public function login_users($email, $password)
    {
        //Comprobar si un usuario existe
        $sql = "SELECT * FROM USUARIOS WHERE EMAIL =:email LIMIT 1 ";

        $find_user =  $this->conexion->prepare($sql);

        $find_user->bindParam(':email', $email, PDO::PARAM_STR);

        $find_user->execute();

        if ($find_user->rowCount() == 1) {
            //existe
            $user = $find_user->fetch(PDO::FETCH_ASSOC);

            $hash = $user["PASSWORD"];

            if (password_verify($password, $hash)) {
                echo 'LOGGIN GOOD';
            } else {
                echo 'FAIL LOGIN';
            }
            // echo 'Existe el usuario';
        } else {
            echo 'no estas registrado';
        }
    }
}
