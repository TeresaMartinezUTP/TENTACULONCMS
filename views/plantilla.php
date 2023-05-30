<?php
session_start();
require_once 'views/modulos/header.php';
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
	require_once 'views/modulos/menu.php';

	if (isset($_GET['ruta'])) {
		if($_SESSION["tipo_trabajador"] == "Administrador General"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "Empleados" ||
				$_GET['ruta'] == "Postulantes" ||
				$_GET['ruta'] == "Usuarios" ||
				$_GET['ruta'] == "Local" ||
				$_GET['ruta'] == "Categoria-Platos" ||
				$_GET['ruta'] == "Platos" ||
				$_GET['ruta'] == "Bebidas" ||
				$_GET['ruta'] == "Local-Bebidas" ||
				$_GET['ruta'] == "Local-Mesa" ||
				$_GET['ruta'] == "Local-Platos" ||
				$_GET['ruta'] == "Local-Empleado" ||
				$_GET['ruta'] == "Clientefre" ||
				$_GET['ruta'] == "Inventario-Bebidas" ||
				$_GET['ruta'] == "Motorizado" ||
				$_GET['ruta'] == "Cocina" ||
				$_GET['ruta'] == "pedidos-entregados" ||
				$_GET['ruta'] == "Ventas" ||
				$_GET['ruta'] == "pedidosdelivery"||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		}else if($_SESSION["tipo_trabajador"] == "Administrador"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "Empleados" ||
				$_GET['ruta'] == "Postulantes" ||
				$_GET['ruta'] == "Usuarios" ||
				$_GET['ruta'] == "Local" ||
				$_GET['ruta'] == "Categoria-Platos" ||
				$_GET['ruta'] == "Platos" ||
				$_GET['ruta'] == "Bebidas" ||
				$_GET['ruta'] == "Local-Bebidas" ||
				$_GET['ruta'] == "Local-Mesa" ||
				$_GET['ruta'] == "Local-Platos" ||
				$_GET['ruta'] == "Local-Empleado" ||
				$_GET['ruta'] == "Clientefre" ||
				$_GET['ruta'] == "Inventario-Bebidas" ||
				$_GET['ruta'] == "Motorizado" ||
				$_GET['ruta'] == "caja" ||
				$_GET['ruta'] == "Cocina" ||
				$_GET['ruta'] == "pedidos-entregados" ||
				$_GET['ruta'] == "Upcaja" ||
				$_GET['ruta'] == "Ventas" ||
				$_GET['ruta'] == "pedidosdelivery"||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		} else if($_SESSION["tipo_trabajador"] == "Counte en caja"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "caja" ||
				$_GET['ruta'] == "Upcaja" ||
				$_GET['ruta'] == "Ventas" ||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		} else if($_SESSION["tipo_trabajador"] == "Jefe de Cocina"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "Cocina" ||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		} else if($_SESSION["tipo_trabajador"] == "Delivery motorizado"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "Motorizado" ||
				$_GET['ruta'] == "pedidos-entregados" ||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		} else if($_SESSION["tipo_trabajador"] == "Mozo/Azafata"){
			if (
				$_GET['ruta'] == "inicio" ||
				$_GET['ruta'] == "Upcaja" ||
				$_GET['ruta'] == "Ventas" ||
				$_GET['ruta'] == "caja" ||
				$_GET['ruta'] == "pedidosdelivery"||
				$_GET['ruta'] == "salir"
			) {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/" . $_GET['ruta'] . ".php";
			} else {
				echo '<div class="main-panel">';
				echo '<div class="content-wrapper">';
				include_once "views/modulos/404.php";
			}
		}
	} else {
		echo '<div class="main-panel">';
		echo '<div class="content-wrapper">';
		include_once "views/modulos/inicio.php";
	}
} else {
	if (isset($_GET['ruta'])) {
		if ($_GET['ruta'] == "login") {
			include_once "views/modulos/" . $_GET['ruta'] . ".php";
		} else {
			include_once "views/modulos/login.php";
		}
	} else {

		include_once "views/modulos/login.php";
	}
}
require_once 'views/modulos/footer.php';
