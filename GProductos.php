<?php

$inventario = [
    ["nombre" => "Laptop", "precio" => 1200],
    ["nombre" => "Smartphone", "precio" => 800]

];

function mostrarMenu() {
    echo "\nMenú de Inventario:\n";
    echo "1. Mostrar todos los productos\n";
    echo "2. Agregar un nuevo producto\n";
    echo "3. Calcular el precio total de los productos\n";
    echo "4. Buscar un producto por su nombre\n";
    echo "5. Encontrar el producto más caro\n";
    echo "6. Salir\n";
    echo "Elige una opción: ";
}

function mostrarProductos($inventario) {
    if (empty($inventario)) {
        echo "No hay productos en el inventario.\n";
    } else {
        echo "Productos en inventario:\n";
        foreach ($inventario as $producto) {
            echo "Producto: {$producto['nombre']}, Precio: \${$producto['precio']}\n";
        }
    }
}

function agregarProducto(&$inventario) {
    echo "Ingrese el nombre del producto: ";
    $nombre = trim(fgets(STDIN));
    
    if (empty($nombre)) {
        echo "El nombre del producto no puede estar vacío.\n";
        return;
    }

    echo "Ingrese el precio del producto: ";
    $precio = trim(fgets(STDIN));

    if (!is_numeric($precio) || $precio <= 0) {
        echo "El precio debe ser un número positivo.\n";
        return;
    }

    $inventario[] = ["nombre" => $nombre, "precio" => (float)$precio];
    echo "Producto agregado exitosamente.\n";
}

function calcularPrecioTotal($inventario) {
    $total = 0;
    foreach ($inventario as $producto) {
        $total += $producto['precio'];
    }
    echo "El precio total de todos los productos es: \$$total\n";
}

function buscarProducto($inventario) {
    echo "Ingrese el nombre del producto que desea buscar: ";
    $nombreBuscado = trim(fgets(STDIN));
    
    foreach ($inventario as $producto) {
        if (strcasecmp($producto['nombre'], $nombreBuscado) == 0) {
            echo "Producto encontrado: {$producto['nombre']}, Precio: \${$producto['precio']}\n";
            return;
        }
    }
    echo "Producto no encontrado.\n";
}

function productoMasCaro($inventario) {
    if (empty($inventario)) {
        echo "No hay productos en el inventario.\n";
        return;
    }

    $productoMasCaro = $inventario[0];
    foreach ($inventario as $producto) {
        if ($producto['precio'] > $productoMasCaro['precio']) {
            $productoMasCaro = $producto;
        }
    }

    echo "El producto más caro es: {$productoMasCaro['nombre']}, Precio: \${$productoMasCaro['precio']}\n";
}


do {
    mostrarMenu();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            mostrarProductos($inventario);
            break;
        case 2:
            agregarProducto($inventario);
            break;
        case 3:
            calcularPrecioTotal($inventario);
            break;
        case 4:
            buscarProducto($inventario);
            break;
        case 5:
            productoMasCaro($inventario);
            break;
        case 6:
            echo "Saliste del programa...\n";
            break;
        default:
            echo "Opción inválida. Por favor, elige una opción válida.\n";
            break;
    }
} while ($opcion != 6);

?>
