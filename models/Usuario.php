<?php
require_once("../config/conexion.php");

class Usuario extends Conectar {
    public function login() {
       
        $conectar = parent::getConexion(); 
        parent::set_names();

        if (isset($_POST["enviar"])) {
            $correo = $_POST["email1"];
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
                    $_SESSION["usu_nombre"] = $result["usu_nom"];
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

    public function restablecer_contrasena($correo, $nueva_contrasena) {
        try {
            $conexion = parent::getConexion();
            $sql = "SELECT * FROM usuarios WHERE usu_correo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $sql = "UPDATE usuarios SET usu_pass = ? WHERE usu_correo = ?";
                $stmt = $conexion->prepare($sql);
                $nueva_contrasena_hash = $nueva_contrasena;
                $stmt->execute([$nueva_contrasena_hash, $correo]);
                return true;
            } else {
                return false; // Usuario no encontrado
            }
        } catch (Exception $e) {
            return false; // Error
        }
    }

    
    public function get_usuarios() {
        $sql = "SELECT * FROM usuarios ORDER BY usu_nom ASC";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuario_by_id($id) {
        $sql = "SELECT * FROM usuarios WHERE usu_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_usuario($nombre, $apep, $apem, $correo, $telf, $pass, $estado) {
        $sql = "INSERT INTO usuarios (usu_nom, usu_apep, usu_apem, usu_correo, usu_telf, usu_pass, est) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $nombre);
        $stmt->bindValue(2, $apep);
        $stmt->bindValue(3, $apem);
        $stmt->bindValue(4, $correo);
        $stmt->bindValue(5, $telf);
        $stmt->bindValue(6, $pass);
        $stmt->bindValue(7, $estado);
        return $stmt->execute();
    }

    public function update_usuario($id, $nombre, $apep, $apem, $correo, $telf, $pass, $estado) {
        $sql = "UPDATE usuarios SET usu_nom = ?, usu_apep = ?, usu_apem = ?, usu_correo = ?, usu_telf = ?, usu_pass = ?, est = ? WHERE usu_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $nombre);
        $stmt->bindValue(2, $apep);
        $stmt->bindValue(3, $apem);
        $stmt->bindValue(4, $correo);
        $stmt->bindValue(5, $telf);
        $stmt->bindValue(6, $pass);
        $stmt->bindValue(7, $estado);
        $stmt->bindValue(8, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_usuario($id) {
        $sql = "DELETE FROM usuarios WHERE usu_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


}
?>



