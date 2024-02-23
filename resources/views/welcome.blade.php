<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EvalSis</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        body {
            background-color: #02bf8f;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding-top: 100px;
            color: #ffffff;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.5em;
            margin-bottom: 40px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #ffffff;
            color: #02bf8f;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #f2f2f2;
        }
        /* Estilos personalizados para los enlaces de login y register */
        .auth-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .auth-links a {
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 5px;
            color: #02bf8f;
            background-color: #ffffff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .auth-links a:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="container">
        <h1>Bienvenido a EvalSis</h1>
        <p>El mejor lugar para aprender y desarrollarte.</p>
        <!-- Enlaces de login y register personalizados -->
        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/admin') }}" class="text-sm">Home</a>
                @else
                    <a href="{{ route('voyager.login') }}" class="text-sm">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</div>
</body>
</html>
