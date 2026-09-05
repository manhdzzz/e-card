<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ECARD NALA' }}</title>
    
    @php
        $logo = \App\Models\SiteSetting::get('site_logo');
        $faviconUrl = $logo ? (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
    @endphp
    <link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
    
    <!-- UIkit & Styles from ecard.vn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />

    <style>
        :root {
            --e-navy: #052542;
            --e-gold: #FFC107;
            --e-bg: #f4f7f9;
        }
        body { font-family: 'Be Vietnam Pro', sans-serif; background: var(--e-bg); color: #333; }
        
        .main-content { padding: 40px 0; min-height: calc(100vh - 400px); }
        .card-custom { background: #fff; border-radius: 12px; border: 1px solid #e0e6ed; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; }
        
        /* Alerts */
        .uk-alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; border-radius: 8px; }
        .uk-alert-danger { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; border-radius: 8px; }
    </style>
    @stack('styles')
</head>
<body>

@include('partials.header')

<main class="main-content">
    <div class="uk-container uk-container-center">
        @if(session('success'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>
            <i class="ti ti-circle-check" style="margin-right: 10px;"></i> {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>
            <i class="ti ti-circle-x" style="margin-right: 10px;"></i> {{ session('error') }}
        </div>
        @endif

        {{ $slot }}
    </div>
</main>

@include('partials.homepage.footer')

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/sticky.min.js"></script>
@stack('scripts')

</body>
</html>
