<?php 
require('conexion1.php');

// Inicializa la variable para el mensaje del formulario
$mensaje = "";
$planSalud = null;

// Si el formulario ha sido enviado, procesamos el número
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero']; // Obtener el número enviado desde el formulario
    $mensaje = "El número ingresado es: " . htmlspecialchars($numero);

    // Consulta SQL para obtener los datos de la tabla 'plan_salud' basado en el número ingresado
    $sql = "SELECT clavep_plan_salud, dieta, recomendaciones FROM plan_salud WHERE clavep_plan_salud = ?";
    
    // Preparar la consulta
    if ($stmt = $cn->prepare($sql)) {
        $stmt->bind_param('i', $numero); // Suponemos que 'clavep_plan_salud' es un número entero
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Si se encuentran resultados
        if ($result->num_rows > 0) {
            $planSalud = $result->fetch_assoc();
        } else {
            $mensaje = "No se encontró un plan de salud con ese número.";
        }
    } else {
        $mensaje = "Error en la consulta a la base de datos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Número y Plan de Salud</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        .form-container {
            width: 300px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Formulario de Número y Plan de Salud</h1>

    <!-- Formulario para ingresar el número -->
    <div class="form-container">
        <form action="" method="POST">
            <label for="numero">Ingresa un número (ID del plan de salud):</label>
            <input type="number" id="numero" name="numero" required>
            <button type="submit">Enviar</button>
        </form>

        <!-- Mostrar el mensaje del número ingresado -->
        <div class="result">
            <p><?php echo $mensaje; ?></p>
        </div>
    </div>

    <!-- Mostrar los datos de la base de datos si se encontró el plan -->
    <?php if ($planSalud): ?>
        <h2>Detalles del Plan de Salud</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Plan Salud</th>
                    <th>Dieta</th>
                    <th>Recomendaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $planSalud['clavep_plan_salud']; ?></td>
                    <td><?php echo $planSalud['dieta']; ?></td>
                    <td><?php echo $planSalud['recomendaciones']; ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

    <?php $cn->close(); ?>

</body>
</html>
