<?php
    require_once __DIR__.'/Config/database.php';

    // ========== PARA EL CORRECTO REDIRECCIONAMIENTO ==========
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    // Construir el nombre del archivo y clase del controlador
    $controllerFile = 'Controllers/' . ucfirst($controller) . 'Controller.php';
    $controllerName = ucfirst($controller) . 'Controller';

    // Verificar que el archivo del controlador exista
    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        // Verificar que la clase del controlador exista
        if (class_exists($controllerName)) {
            $objController = new $controllerName();

            // Verificar que el método (acción) exista en la clase
            if (method_exists($objController, $action)) {
                call_user_func([$objController, $action]);
            } else {
                error_log("Método $action no existe en $controllerName");
            }
        } else {
            error_log("Clase $controllerName no existe");
        }
    } else {
        error_log("Archivo $controllerFile no existe");
    }
            
?>