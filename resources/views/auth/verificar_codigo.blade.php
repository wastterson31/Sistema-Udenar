<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .error-message {
            color: #d9534f;
            background-color: #f9d6d5;
            border: 1px solid #d9534f;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #28a745;
        }

        button {
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .error-list {
            list-style-type: none;
            padding: 0;
        }

        .error-list li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ingresa tu código de verificación</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('verificarCodigo') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="verification_code" class="form-label">Código de verificación:</label>
                <input type="text" id="verification_code" name="verification_code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Verificar</button>
        </form>
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Animación al cargar la página -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                '{{ asset('img/udenar.jpg') }}',
                '{{ asset('img/udenar1.jpg') }}',
                '{{ asset('img/udenar2.jpg') }}',
                '{{ asset('img/udenar3.jpg') }}',
                '{{ asset('img/udenar4.jpg') }}',
                '{{ asset('img/udenar5.jpg') }}',
            ];

            let currentImageIndex = 0;
            const changeBackground = () => {
                document.body.style.backgroundImage = `url('${images[currentImageIndex]}')`;
                currentImageIndex = (currentImageIndex + 1) % images.length;
            };

            changeBackground();
            setInterval(changeBackground, 5000);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.querySelector(".container");
            container.style.opacity = 0;
            container.style.transform = "translateY(-20px)";
            setTimeout(() => {
                container.style.transition = "opacity 0.5s ease, transform 0.5s ease";
                container.style.opacity = 1;
                container.style.transform = "translateY(0)";
            }, 100);
        });
    </script>
</body>

</html>
