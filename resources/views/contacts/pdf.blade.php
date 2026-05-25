<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportación de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Directorio de Contactos</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Categoría</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contactos as $contacto)
                <tr>
                    <td>{{ $contacto->nombres }} {{ $contacto->apellidos }}</td>
                    <td>{{ $contacto->telefonos->first()->numero ?? 'No registrado' }}</td>
                    <td>{{ $contacto->email ?: 'No registrado' }}</td>
                    <td>{{ $contacto->categoria->nombre ?? 'No registrado' }}</td>
                    <td>{{ $contacto->direccion ?: 'No registrado' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay contactos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i:s') }}
    </div>

</body>
</html>
