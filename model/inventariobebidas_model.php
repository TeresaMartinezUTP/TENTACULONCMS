
<?php
require_once 'conexion.php';
class inventariobebidasmodel
{
    public static function mdlListarinventariobebidas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT b.id_bebida, CONCAT(b.marca, ' ', b.descripcion)as bebida,sum(stock) as stock_total, l.sede,lb.estado, lb.id_localbebida FROM $tabla ib INNER JOIN local_bebidas lb ON ib.id_localbebida=lb.id_localbebida INNER JOIN local l ON lb.id_local=l.id_local INNER JOIN bebidas b ON lb.id_bebida=b.id_bebida GROUP by b.id_bebida,l.sede");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    public static function mdlListarBebidaStock($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT ib.id_inventario, b.id_bebida,ib.fecha ,CONCAT(b.marca, ' ', b.descripcion)as bebida, ib.stock, lc.sede FROM $tabla ib INNER JOIN local_bebidas lb ON ib.id_localbebida=lb.id_localbebida INNER JOIN local lc ON lb.id_local=lc.id_local INNER JOIN bebidas b on lb.id_bebida=b.id_bebida ");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    public static function mdlRegistrarinventariobebida($tabla, $datos)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare("INSERT INTO $tabla (id_localbebida,stock) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['id_localbebida'], $datos['stock']]);
        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    public static function mdlListarinventariobebidasxsede($tabla,$sede)
    {
        if($sede!="")
        {
            $query="WHERE l.sede='".$sede."'";
        }else{
            $query='';
        }
        $stmt = Conexion::conectar()->prepare("SELECT ib.id_inventario, sum(stock) as stock_total, l.sede,lb.estado, CONCAT(b.marca, ' ', b.descripcion)as bebida, lb.id_localbebida FROM $tabla ib INNER JOIN local_bebidas lb ON ib.id_localbebida=lb.id_localbebida INNER JOIN local l ON lb.id_local=l.id_local INNER JOIN bebidas b ON lb.id_bebida=b.id_bebida $query GROUP by b.id_bebida, l.sede");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    static public function mdlMostrarBebidaInventario($tabla, $id_inventario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT ib.*,lc.sede FROM $tabla ib INNER JOIN local_bebidas lb ON ib.id_localbebida=lb.id_localbebida INNER JOIN local lc ON lb.id_local=lc.id_local WHERE ib.id_inventario='$id_inventario'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }
    static public function mdlActualizarBebidaInventario($tabla, $datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_localbebida=? and id_inventario!=?");
        $consultar->execute([$datos['id_localbebida'],$datos['id_inventario']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_localbebida=?,stock=? WHERE id_inventario=?");
        $stmt->execute([$datos['id_localbebida'], $datos['stock'], $datos['id_inventario']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }


    static public function mdlEliminarBebidaInventario($tabla, $id_inventario)
    {
        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_inventario=$id_inventario");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }
}
