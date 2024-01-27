<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
    
        header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1em 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height:140px;
        }
    
        #una {
            width: 80px;
            height: auto;
            margin-left: -500px;
            margin-top: 20px;
        }

        #epis {
            width: 80px;
            height: auto;
            margin-left: 500px;
            margin-top:-85px;
        }

    
        header h1 {
            margin-top: -40; /* Elimina el margen predeterminado del h1 */
            display: flex;
            align-items: center;
        }
    
        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
    
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    
        th {
            background-color: #343a40;
            color: white;
        }
    
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    
    <header>
        <div>
            <img id="una" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Logo_UNAP.png/554px-Logo_UNAP.png">
        </div>
        <h1>Reporte de Usuarios</h1>
        <div>
            <img id="epis" src="https://drive.usercontent.google.com/download?id=1GBKiLyVetFCeJ7i_5ymhN3Xjwgzq2y9t">
        </div>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellido }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} TALLER DE DESARROLLO DE SOFTWARE</p>
    </footer>

</body>
</html>
