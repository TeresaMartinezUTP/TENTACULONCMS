<?php

require_once 'conexion.php';
class CajaModelo
{

    static public function mdlListarTablaTempventa($id_usuario)
    {
        $stmt = Conexion::conectar()->prepare(" SELECT * FROM temp_venta tv LEFT JOIN platos p ON p.id_plato=tv.id_localplato LEFT JOIN bebidas b ON b.id_bebida=tv.id_localbebida WHERE tv.id_usuario='$id_usuario'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlRegistrarTempventa($datos)
    {
        $db = Conexion::conectar();

        $consultar = Conexion::conectar()->prepare("SELECT * FROM temp_venta WHERE id_usuario=? AND id_localplato=?");
        $consultar->execute([$datos['id_usuario'], $datos['id_localplato']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO temp_venta(id_usuario,id_localplato,precio_venta,cantidad,total) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['id_usuario'], $datos['id_localplato'], $datos['precio_venta'], $datos['cantidad'], $datos['total']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }

        $respuesta = null;
    }
    static public function mdlRegistrarUpventa($datos)
    {
        $db = Conexion::conectar();

        $consultar = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_venta=? AND id_localplato=?");
        $consultar->execute([$datos['id_venta'], $datos['id_localplato']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO detalle_venta(id_venta,id_localplato,precio_venta,cantidad,total) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['id_venta'], $datos['id_localplato'], $datos['precio_venta'], $datos['cantidad'], $datos['total']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }

        $respuesta = null;
    }
    static public function mdlEliminarTempVenta($id_temp)
    {
        $stmt = Conexion::conectar()->prepare("DELETE  from temp_venta where id_temp='$id_temp'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlEliminardetVenta($id_detalle)
    {
        $stmt = Conexion::conectar()->prepare("DELETE  from detalle_venta where id_detalle='$id_detalle'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlRegistrarTempventaBebida($datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM temp_venta WHERE id_usuario=? AND id_localbebida=?");
        $consultar->execute([$datos['id_usuario'], $datos['id_localbebida']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }


        $stmt = $db->prepare("INSERT INTO temp_venta(id_usuario,id_localbebida,precio_venta,cantidad,total) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['id_usuario'], $datos['id_localbebida'], $datos['precio_venta'], $datos['cantidad'], $datos['total']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }

        $respuesta = null;
    }
    static public function mdlRegistrarupventaBebida($datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_venta=? AND id_localbebida=?");
        $consultar->execute([$datos['id_venta'], $datos['id_localbebida']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }


        $stmt = $db->prepare("INSERT INTO detalle_venta(id_venta,id_localbebida,precio_venta,cantidad,total) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['id_venta'], $datos['id_localbebida'], $datos['precio_venta'], $datos['cantidad'], $datos['total']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }

        $respuesta = null;
    }


    static public function mdlRegistrarVenta($datos, $id_usuario)
    {

        $db = Conexion::conectar();

        $consultar = Conexion::conectar()->prepare("SELECT * FROM temp_venta WHERE id_usuario='$id_usuario'");
        $consultar->execute();
        $result = $consultar->fetchAll();
        if (empty($result)) {
            return 'vacio';
        }

        $consultar = Conexion::conectar()->prepare("SELECT * FROM venta v INNER JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE v.id_mesa = ? AND v.estado='Pendiente'");
        $consultar->execute([$datos['id_mesa']]);
        $result = $consultar->fetchAll();
        if (!empty($result)) {
            return 'ocupado';
        }

        $stmt = $db->prepare("INSERT INTO venta (id_cliente_frecuente,id_usuario,id_mesa,atencion,direccion,telefono,nombre_contacto,id_local,prioridad,cargo,estado) VALUES (?,?,?,?,?,?,?,?,?,?,'Pendiente')");

        $stmt2 = $db->prepare("SELECT last_insert_id() as id;");

        $respuesta = $stmt->execute([$datos['id_cliente_frecuente'], $datos['id_usuario'], $datos['id_mesa'], $datos['atencion'], $datos['direccion'], $datos['telefono'], $datos['nombre_contacto'], $datos['id_local'], $datos['prioridad'], $datos['cargo']]);
        $stmt2->execute();

        $id =  $stmt2->fetch(PDO::FETCH_ASSOC);

        $stmt3 = $db->prepare("INSERT INTO detalle_venta (id_venta,id_localplato,id_localbebida,precio_venta,cantidad,total,estado) SELECT v.venta 
        AS id_venta,temp_venta.id_localplato 
        AS id_localplato,temp_venta.id_localbebida 
        AS id_localbebida,temp_venta.precio_venta 
        AS precio_venta,temp_venta.cantidad 
        AS cantidad,temp_venta.total 
        AS total,'Pendiente' 
        AS estado FROM temp_venta CROSS JOIN (SELECT MAX(id_venta) venta
        FROM venta) v WHERE temp_venta.id_usuario='$id_usuario'");

        if ($datos['atencion'] == "Delivery") {
            $idve = $db->prepare("SELECT MAX(id_venta) venta FROM venta");
            $idve->execute();
            $idven = $idve->fetch(PDO::FETCH_ASSOC);
            $ven = json_encode($idven['venta']);
            $stmtd = $db->prepare("INSERT INTO pedido_motorizado (id_venta) VALUES ($ven)");
            $stmtd->execute();
        }

        $stmt3->execute();
        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }

        $respuesta = null;
    }
    static public function mdlLimpiarTempVenta($id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("DELETE  from temp_venta where id_usuario='$id_usuario'");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlActualizarTotalTempVenta($cantidad, $id_temp)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE temp_venta SET cantidad='$cantidad' WHERE id_temp = '$id_temp'");
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlActualizarclifrefromventa($id_venta, $id_clifre)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE venta SET id_cliente_frecuente='$id_clifre' WHERE id_venta = '$id_venta'");
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlActualizarTotaldetVenta($cantidad, $id_detalle)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE detalle_venta SET cantidad='$cantidad' WHERE id_detalle = '$id_detalle'");
        $stmt->execute();
        //Estado detalle venta
        $estado = "Pendiente";
        $ccxcp = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_detalle = '$id_detalle'");
        $ccxcp->execute();
        $respuesta = $ccxcp->fetchAll(PDO::FETCH_ASSOC);
        if (json_encode($respuesta[0]["cantidad"] == $respuesta[0]["cantidadcocinada"]) == "true") {
            $estado = "Preparado";
        }
        $stmt2 = Conexion::conectar()->prepare("UPDATE detalle_venta SET estado='$estado' WHERE id_detalle='$id_detalle'");
        $stmt2->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlMostrardatosventa($id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT FORMAT(SUM(total),2) AS subtotal,FORMAT(SUM(total) * 0.18,2) AS igv, FORMAT((SUM(total) * 0.18) + SUM(total),2) As total FROM temp_venta WHERE id_usuario='$id_usuario'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }
    static public function mdlMostrarVenta($id_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM venta v left join local_mesas l ON v.id_mesa=l.id_mesa
        WHERE v.id_venta='$id_venta'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }

    static public function mdlActualizarVenta($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE venta SET id_cliente_frecuente=?, id_mesa=?  WHERE id_venta = '?'");
        $stmt->execute([$datos['id_cliente_frecuente'], $datos['id_mesa'], $datos['id_venta']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarTabladetventa($id_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM detalle_venta tv LEFT JOIN platos p ON p.id_plato=tv.id_localplato LEFT JOIN bebidas b ON b.id_bebida=tv.id_localbebida WHERE tv.id_venta='$id_venta'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlMostrardatosventa2($id_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT v.*, FORMAT(SUM(dv.total),2) AS subtotal,FORMAT(SUM(dv.total) * 0.18,2) AS igv, FORMAT((SUM(dv.total) * 0.18) + SUM(dv.total),2) As total FROM detalle_venta dv LEFT JOIN venta v ON dv.id_venta = v.id_venta WHERE dv.id_venta='$id_venta'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }

    static public function mdlActualizarcantpreparada($cantidad, $id_detalle)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE detalle_venta SET cantidadcocinada='$cantidad' WHERE id_detalle = '$id_detalle'");
        $stmt->execute();

        //Estado detalle venta
        $estado = "Pendiente";
        $ccxcp = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_detalle = '$id_detalle'");
        $ccxcp->execute();
        $respuesta = $ccxcp->fetchAll(PDO::FETCH_ASSOC);
        if (json_encode($respuesta[0]["cantidad"] == $respuesta[0]["cantidadcocinada"]) == "true") {
            $estado = "Preparado";
        }
        $stmt2 = Conexion::conectar()->prepare("UPDATE detalle_venta SET estado='$estado' WHERE id_detalle='$id_detalle'");
        $stmt2->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlActualizarestadoventa($id_venta)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE venta SET estado='Finalizado',fecha_hora_entrega = current_timestamp WHERE id_venta = '$id_venta'");
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlActualizaPrioridadventa($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE venta SET prioridad=? WHERE id_venta = ?");
        $stmt->execute([$datos['prioridad'], $datos['id_venta']]);
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlActualizarcantpagada($cantidad, $id_detalle, $id_tempventaparte)
    {
        $stmt1 = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_detalle = '$id_detalle'");
        $stmt1->execute();
        $respuesta = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $cantidadactual = $respuesta[0]["cantidadpagada"] + $cantidad;

        $stmt2 = Conexion::conectar()->prepare("SELECT * FROM temp_ventaparte WHERE id_tempventaparte = '$id_tempventaparte'");
        $stmt2->execute();
        $respuesta2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $cantidadvparte = $respuesta2[0]["cantidad"] + $cantidad;

        $stmt3 = Conexion::conectar()->prepare("UPDATE detalle_venta SET cantidadpagada='$cantidadactual' WHERE id_detalle = '$id_detalle'");
        $stmt3->execute();

        $stmt4 = Conexion::conectar()->prepare("UPDATE temp_ventaparte SET cantidad='$cantidadvparte' WHERE id_tempventaparte = '$id_tempventaparte'");
        $stmt4->execute();

        if ($stmt3 == true && $stmt4 == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlRegistrarTempVentaParte($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO temp_ventaparte (id_usuario, id_localplato, id_localbebida, precio_venta) VALUES (?, ?, ?, ?);");
        $stmt->execute([$datos['id_usuario'], $datos['id_localplato'], $datos['id_localbebida'], $datos['precio_venta']]);

        $stmt2 = Conexion::conectar()->prepare('SELECT MAX(id_tempventaparte) id_tempventaparte FROM temp_ventaparte');
        $stmt2->execute();
        $respuesta = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt == true) {
            return $respuesta;
        } else {
            return "error";
        }
    }

    static public function mdlActualizarcantpreparadaTodo($id_venta)
    {
        $ccxcp = Conexion::conectar()->prepare("SELECT * FROM detalle_venta WHERE id_venta = '$id_venta'");
        $ccxcp->execute();
        $respuesta = $ccxcp->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($respuesta); $i++) {
            $cantidad = $respuesta[$i]["cantidad"];
            $id_detalle = $respuesta[$i]["id_detalle"];
            $stmt = Conexion::conectar()->prepare("UPDATE detalle_venta SET cantidadcocinada='$cantidad' WHERE id_detalle = '$id_detalle'");
            $stmt->execute();
        }
        $stmt2 = Conexion::conectar()->prepare("UPDATE detalle_venta SET estado='Preparado' WHERE id_venta='$id_venta'");
        $stmt2->execute();
        if ($stmt2 == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlEliminarTempVentaParte($id_tempventaparte)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM temp_ventaparte WHERE id_tempventaparte = '$id_tempventaparte'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = Conexion::conectar()->prepare("DELETE FROM temp_ventaparte WHERE id_tempventaparte = '$id_tempventaparte'");
        $stmt2->execute();

        if ($stmt2 == true) {
            return $respuesta;
        } else {
            return "error";
        }
    }

    static public function mdlRegistrarVentaParte($datos, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM temp_ventaparte WHERE id_usuario = $id_usuario");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();

        $stmt2 = Conexion::conectar()->prepare("INSERT INTO venta_parte (id_venta, id_cliente_frecuente, monto_pagado) VALUES (?,?,?)");
        $stmt2->execute([$datos["id_venta"], $datos["id_cliente_frecuente"], $datos["monto_pagado"]]);

        $stmt3 = Conexion::conectar()->prepare("SELECT MAX(vp.id_ventaparte) id_ventaparte FROM venta_parte vp LEFT JOIN venta v ON vp.id_venta = v.id_venta WHERE v.id_usuario = $id_usuario");
        $stmt3->execute();
        $respuesta2 = $stmt3->fetchAll();

        for ($i = 0; $i < count($respuesta); $i++) {
            $stmt4 = Conexion::conectar()->prepare("INSERT INTO detalle_venta_parte (id_venta_parte, id_localplato, id_localbebida, precio_venta, cantidad) VALUES (?,?,?,?,?)");
            $stmt4->execute([$respuesta2[0]["id_ventaparte"], $respuesta[$i]["id_localplato"], $respuesta[$i]["id_localbebida"], $respuesta[$i]["precio_venta"], $respuesta[$i]["cantidad"]]);
        }

        $stmt5 = Conexion::conectar()->prepare("DELETE FROM temp_ventaparte WHERE id_usuario = $id_usuario");
        $stmt5->execute();

        if (empty($respuesta) || empty($respuesta2)) {
            return "vacio";
        } else if ($stmt4 == true && $stmt5 == true) {
            return "ok";
        } else {
            return "error";
        }
    }
}
