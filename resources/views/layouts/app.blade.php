<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        
        <!-- Viteで管理されるアセットへのリンクに変更 -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!--イチサンフォーム-->
        <script src="https://ichisan.jp/form/lib/ichisanForm.min.js"></script>
        <link rel="stylesheet" href="https://ichisan.jp/form/lib/ichisanForm.min.css"/>

        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <!--ヘッダー-->
            @include('components.header')
            
            <!-- コンテンツ -->
            <main>
                @yield('slot')
            </main>
            
            <!--フッター-->
            @include('components.footer')
        </div>
    </body>
</html>
