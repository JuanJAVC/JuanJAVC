<?php

$empleados = [
    ["id" => 1, 
    "Nombre" => "Carlos", 
    "Edad" => 35, 
    "Sueldo Base" => 1800,
    "Años de Experiencia" => 12, 
    "Sueldo con Bonificación" => 2070],
    ["id" => 2, 
    "Nombre" => "Ana", 
    "Edad" => 28, 
    "Sueldo Base" => 1500, 
    "Años de Experiencia" => 6, 
    "Sueldo con Bonificación" => 1650],
    ["id" => 3, 
    "Nombre" => "Pedro", 
    "Edad" => 40, 
    "Sueldo Base" => 2500, 
    "Años de Experiencia" => 15, 
    "Sueldo con Bonificación" => 2875]
];

function mostrarMenu() {
    echo "\nBienvenido a gestión de empleados:\n";
    echo "1. Agregar un nuevo empleado\n";
    echo "2. Mostrar todos los empleados y sus sueldos con bonificación\n";
    echo "3. Calcular el total a pagar en sueldos con bonificación\n";
    echo "4. Buscar un empleado por nombre\n";
    echo "5. Eliminar un empleado por nombre\n";
    echo "6. Mostrar empleados con sueldos mayores a \$2000 (con bonificación)\n";
    echo "7. Salir\n";
    echo "Elija una opción: ";
}


function agregarEmpleado() {
    global $empleados;

    do {
        echo "Ingrese el nombre del empleado: ";
        $nombre = trim(fgets(STDIN));

        if (empty($nombre)) {
            echo "Error: El nombre del empleado no puede estar vacío.\n";
        }
    } while (empty($nombre));

    do {
        echo "Ingrese su edad: ";
        $edad = (int) trim(fgets(STDIN));

        if ($edad < 18) {
            echo "Error: La edad debe ser mayor o igual a 18 años.\n";
        }
    } while ($edad < 18);

    do {
        echo "Ingrese sueldo base: ";
        $sueldo_base = (float) trim(fgets(STDIN));

        if ($sueldo_base <= 0) {
            echo "Error: El sueldo base debe ser mayor a 0.\n";
        }
    } while ($sueldo_base <= 0);

    do {
        echo "Ingrese años de experiencia: ";
        $experiencia = (int) trim(fgets(STDIN));

        if ($experiencia > ($edad - 18)) {
            echo "Error: Los años de experiencia no pueden ser mayores que la edad de 18 años.\n";
        }
    } while ($experiencia > ($edad - 18));

    $bonificacion = calcularBonificacion($sueldo_base, $experiencia);
    $sueldo_bonificado = $sueldo_base + $bonificacion;

    $empleado_nuevo = [
        "id" => count($empleados) + 1,
        "Nombre" => $nombre,
        "Edad" => $edad,
        "Sueldo Base" => $sueldo_base,
        "Años de Experiencia" => $experiencia,
        "Sueldo con Bonificación" => $sueldo_bonificado
    ];

    $empleados[] = $empleado_nuevo;

    echo "Empleado agregado correctamente. Sueldo con bonificación: \${$sueldo_bonificado}\n";
}

function calcularBonificacion($sueldo_base, $experiencia) {
    if ($experiencia > 10) {
        return $sueldo_base * 0.15;
    } elseif ($experiencia >= 5) {
        return $sueldo_base * 0.10;
    } else {
        return $sueldo_base * 0.05;
    }
}


function mostrarEmpleados() {
    global $empleados;

    if (empty($empleados)) {
        echo "No hay empleados registrados.\n";
    } else {
        echo "Lista de empleados:\n";
        foreach ($empleados as $empleado) {
            echo "Empleado: {$empleado['Nombre']}, Edad: {$empleado['Edad']}, Sueldo Base: \${$empleado['Sueldo Base']}, Años de experiencia: {$empleado['Años de Experiencia']}, Sueldo con bonificación: \${$empleado['Sueldo con Bonificación']}\n";
        }
    }
}

function calcularTotal() {
    global $empleados;

    $total = 0;
    foreach ($empleados as $empleado) {
        $total += $empleado['Sueldo con Bonificación'];
    }

    echo "El total a pagar en sueldos con bonificación es: \$$total\n";
}

function buscarEmpleado() {
    global $empleados;

    echo "Ingrese el nombre del empleado que desea buscar: ";
    $nombre = trim(fgets(STDIN));

    $encontrado = false;
    foreach ($empleados as $empleado) {
        if (strtolower($empleado['Nombre']) === strtolower($nombre)) {
            echo "Empleado encontrado: {$empleado['Nombre']}, Sueldo con bonificación: \${$empleado['Sueldo con Bonificación']}\n";
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        echo "Empleado no encontrado.\n";
    }
}

function eliminarEmpleado() {
    global $empleados;

    echo "Ingrese el nombre del empleado que desea eliminar: ";
    $nombre = trim(fgets(STDIN));

    foreach ($empleados as $id => $empleado) {
        if (strtolower($empleado['Nombre']) === strtolower($nombre)) {
            unset($empleados[$id]);
            echo "Empleado eliminado correctamente.\n";
            return;
        }
    }

    echo "Empleado no encontrado.\n";
}

function mostrarEmpleadosConBonificacion() {
    global $empleados;

    echo "Empleados con sueldo con bonificación mayor a \$2000:\n";
    foreach ($empleados as $empleado) {
        if ($empleado['Sueldo con Bonificación'] > 2000) {
            echo "Empleado: {$empleado['Nombre']}, Sueldo con bonificación: \${$empleado['Sueldo con Bonificación']}\n";
        }
    }
}

do {
    mostrarMenu();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            agregarEmpleado();
            break;
        case 2:
            mostrarEmpleados();
            break;
        case 3:
            calcularTotal();
            break;
        case 4:
            buscarEmpleado();
            break;
        case 5:
            eliminarEmpleado();
            break;
        case 6:
            mostrarEmpleadosConBonificacion();
            break;
        case 7:
            echo "Saliendo del programa...\n";
            break;
        default:
            echo "La opción no esválida, intente nuevamente.\n";
            break;
    }

} while ($opcion != 7);

?>
