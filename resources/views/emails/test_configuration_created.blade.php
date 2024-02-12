<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }}</title>
    <style>
        /* Estilos CSS para el correo electrónico */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>{{ $testConfiguration->name }} de tu curso {{ $course->name }}</h2>
        <p>Tienes un nuevo test progrmado para el :{{ $testConfiguration->date }}; recuerda que el test estara activo hasta las <strong>23:59 pm</strong></p>
        <p><strong>Duración:</strong> {{ $testConfiguration->time }}</p>
        <p class="footer">Este es un correo electrónico automático, por favor no responda a este mensaje.</p>
    </div>
</body>

</html>
