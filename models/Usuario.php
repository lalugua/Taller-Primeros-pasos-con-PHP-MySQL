<?php
class Usuario extends Conectar {
    public function login() {
       
        $conectar = parent::getConexion(); 
        parent::set_names();

        if (isset($_POST["enviar"])) {
            $correo = $_POST["email"];
            $password = $_POST["password"];

            if (empty($correo) && empty($password)) {
                header("location:" . Conectar::ruta() . "views/login.php?m=2");
                exit();
            } else {
                
                $sql = "SELECT * FROM usuarios WHERE usu_correo = ? AND usu_pass = ?";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo, PDO::PARAM_STR);
                $stmt->bindValue(2, $password, PDO::PARAM_STR);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (is_array($result) && count($result) > 0) {
                    $_SESSION["usu_id"] = $result["usu_id"];
                    $_SESSION["usu_nombre"] = $result["usu_nombre"];
                    $_SESSION["usu_apem"] = $result["usu_apem"];
                    $_SESSION["usu_correo"] = $result["usu_correo"];
                    header("location:" . Conectar::ruta() . "views/home.php");
                    exit();
                } else {
                    header("location:" . Conectar::ruta() . "views/login.php?m=1");
                    exit();
                }
            }
        }
    }

}
?>
