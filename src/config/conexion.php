

<?php
    require_once realpath('./vendor/autoload.php');
    $dotenv=Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();
    define ('SERVIDOR',$_ENV['HOST']);
    define ('USER',$_ENV['USUARIO']);
    define ('PASS',$_ENV['PASSWORD']);
    define ('DB',$_ENV['DB']);
    define ('PORT',$_ENV['PUERTO']);
    class conexion{
        // cereamos claases privadas
        private $conexion;
        // creamos funcion (static para acceder de manera rapida)
        public static function abrir_conexion(){
            if(!isset(self::$conexion)){
                try{
                    self::$conexion =new PDO('mysql:host='.SERVER.';dbname='.BD,USER,PASS);
                    self::$conexion-> exec('SET CHARACTER SET utf8') ; 
                }catch(PDOException $e){
                    echo "error en la conexion:". $e;
                    die();
                }
            }else{
                return self::$conexion;
            }
        }

        public static function obtener_conexcion(){
            $conexion = self :: abrir_conexion();
            return $conexion;
        }
        public static function cerrar_conexion(){
            self:: $conexion = null;
        }

        public static function agregar($nombre, $apellido){
            try {
                $stmt = self::obtener_conexion()->prepare("INSERT INTO t_prueba (nombre, apellido) VALUES (?, ?)");
                $stmt->execute([$nombre, $apellido]);
                echo "Registro agregado correctamente";
            } catch (PDOException $e) {
                echo "Error al agregar registro: " . $e->getMessage();
            }
        }

        public static function editar($nombre, $apellido){
            try {
                $stmt = self::obtener_conexion()->prepare("UPDATE t_prueba SET campo1 = ?, campo2 = ? WHERE id = ?");
                $stmt->execute([$nombre, $apellido]);
                echo"Se actualizo correctamente";
            } catch (PDOException $e){
                echo "Erro al actualizar:" . $e ->getMessage();
            }
        }

        public static function eliminar($id)
        {
            try {
                $stmt = self::obtener_conexion()->prepare("DELETE FROM t_prueba WHERE id = ?");
                $stmt->execute([$id]);
                echo "Registro eliminado correctamente";
            } catch (PDOException $e) {
                echo "Error al eliminar registro: " . $e->getMessage();
            }
        }
    } 

?>