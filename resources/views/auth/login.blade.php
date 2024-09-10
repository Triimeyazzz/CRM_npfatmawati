<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    
    <div class="bg-gray-100 flex justify-center items-center ">
        <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('./images/Reverse.png');"></div>

        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2 relative z-10">
            <form action="{{ route('login') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="flex justify-center mb-8">
                    <img src="./images/logo color.png" alt="Logo" class="h-20 w-auto" />
                </div>
                <h1 class="text-2xl font-semibold mb-4 text-center">Login</h1>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-purple-500"
                        value="{{ old('email') }}"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-600">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-purple-500"
                        required
                    />
                </div>

                <div class="mb-4 flex items-center">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <label for="remember" class="text-gray-600 ml-2">Remember Me</label>
                </div>

                @if ($canResetPassword)
                    <div class="mb-6 text-blue-500">
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Forgot your password?
                        </a>
                    </div>
                @endif

                <button
                    type="submit"
                    class="bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-md py-2 px-4 w-full"
                >
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>