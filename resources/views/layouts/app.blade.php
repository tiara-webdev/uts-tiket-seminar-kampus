<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tiket Seminar Kampus')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        nav {
            background: #1f3a5f;
            color: #fff;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a,
        nav button {
            color: #fff;
            background: none;
            border: 0;
            cursor: pointer;
            font-size: 14px;
            margin-left: 12px;
            text-decoration: none;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
        }

        .container.wide {
            max-width: 720px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }

        button.primary {
            margin-top: 16px;
            width: 100%;
            padding: 10px;
            background: #1f3a5f;
            color: #fff;
            border: 0;
            border-radius: 4px;
            cursor: pointer;
        }

        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .alert-error {
            background: #fdecea;
            color: #b71c1c;
        }

        .alert-success {
            background: #e8f5e9;
            color: #1b5e20;
        }
    </style>
</head>

<body>
    <nav>
        <strong>Tiket Seminar Kampus</strong>
        <div>
            @auth
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container @yield('wide')">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:18px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>
