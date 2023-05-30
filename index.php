<?php
require_once 'controller/plantilla.controller.php';
require_once 'controller/usuarios_controller.php';
require_once 'controller/local_controller.php';
require_once 'controller/categoriaplatos_controller.php';
require_once 'controller/empleado_controller.php';
require_once 'controller/clientefre_controller.php';
require_once 'controller/buscar_controller.php';
require_once 'controller/postulante_controller.php';
require_once 'controller/caja_controller.php';
require_once 'controller/cocina_controller.php';
require_once 'controller/venta_controller.php';

require_once 'controller/bebida_controller.php';
require_once 'controller/plato_controller.php';
require_once 'controller/inventariobebidas_controller.php';
require_once 'controller/incidencia_controller.php';


require_once 'model/incidencia_model.php';
require_once 'model/bebida_model.php';
require_once 'model/plato_model.php';
require_once 'model/usuarios_model.php';
require_once 'model/local_model.php';
require_once 'model/categoriaplatos_model.php';
require_once 'model/empleado_model.php';
require_once 'model/clientefre_model.php';
require_once 'model/buscar_model.php';
require_once 'model/postulante_model.php';
require_once 'model/inventariobebidas_model.php';

require_once 'model/caja_model.php';
require_once 'model/cocina_model.php';
require_once 'model/venta_model.php';

$plantilla = new ControllerPlantilla();
$plantilla->ctrPlantilla();