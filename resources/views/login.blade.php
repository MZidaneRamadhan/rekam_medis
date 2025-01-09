<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex p-4 bg-white border border-gray-200 rounded-lg shadow-lg w-[50vw]">
        <div class="flex items-center justify-center w-1/2 rounded-lg bg-sky-300">
            <img src="{{ asset('login1.png') }}" alt="Login Illustration" class="w-full">
        </div>
        <div class="flex flex-col items-center justify-center w-1/2 p-6">
            <h2 class="text-2xl font-bold text-center text-gray-700">Selamat Datang</h2>
            <h2 class="mb-6 text-2xl font-bold text-center text-gray-700">Login</h2>
            <form action="/login-action" method="POST" class="w-full">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow @error('email') border-red-500 @enderror focus:ring-blue-500 "
                        placeholder="Masukkan email" required>
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-2 transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                        placeholder="Masukkan password" required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('message'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-center',
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

</body>

</html>
