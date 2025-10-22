<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Tautan Tidak Ditemukan | Taut Pinang</title>
    <meta name="description" content="Tautan tidak ditemukan. Buat tautan profesional dengan Taut Pinang.">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="flex items-center justify-center min-h-screen px-4 bg-gradient-to-br from-blue-50 via-white to-emerald-50">
    <div class="w-full max-w-lg">
        <!-- Main Container -->
        <div class="p-6 bg-white shadow-xl rounded-2xl md:p-8">

            <!-- Logo Section -->
            <div class="mb-6 text-center">
                <div class="inline-block mb-4">
                    <img src="{{ asset('img/favicon.png') }}" alt="Taut Pinang Logo" class="w-20 h-20 rounded-lg">
                </div>

                <!-- 404 Text -->
                <div class="mb-4">
                    <h1
                        class="mb-2 text-5xl font-bold text-transparent md:text-6xl bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-emerald-600">
                        404
                    </h1>
                    <h2 class="text-xl font-bold text-gray-800 md:text-2xl">
                        Tautan Tidak Ditemukan
                    </h2>
                </div>
            </div>

            <!-- Message Section -->
            <div class="mb-6 text-center">
                <div class="p-4 mb-4 border rounded-lg bg-emerald-50 border-emerald-200">
                    <p class="text-emerald-700">
                        <i class="mr-2 fas fa-exclamation-triangle"></i>
                        Maaf, tautan yang Anda cari tidak ditemukan atau sudah tidak aktif
                    </p>
                </div>

                <!-- Simple Suggestions -->
                <div class="p-4 border border-blue-100 rounded-lg bg-blue-50">
                    <p class="text-sm text-blue-700">
                        <i class="mr-2 fas fa-info-circle"></i>
                        Periksa kembali URL atau hubungi pembuat tautan
                    </p>
                </div>
            </div>

            <!-- Footer Branding -->
            <div class="mt-6 text-center">
                <span
                    class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-emerald-600">
                    Taut Pinang
                </span>
                <p class="mt-1 text-sm text-gray-500">
                    Platform Tautan Profesional
                </p>
            </div>
        </div>
    </div>

</body>

</html>
