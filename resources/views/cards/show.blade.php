<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->full_name }} - Danh Thiếp Điện Tử</title>
    <meta property="og:title" content="{{ $card->full_name }}">
    <meta property="og:description" content="{{ $card->job_title }} {{ $card->company ? '· '.$card->company : '' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Be Vietnam Pro',sans-serif; background:linear-gradient(135deg,#e8f0fe,#c7d9f7); min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:2rem 1rem; }
        .public-card { background:white; border-radius:20px; width:100%; max-width:400px; overflow:hidden; box-shadow:0 20px 60px rgba(37,99,235,.2); }
        .pc-header { background:linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa); padding:2.5rem 2rem; text-align:center; position:relative; }
        .pc-dots { position:absolute; top:.8rem; right:1rem; display:grid; grid-template-columns:repeat(4,5px); gap:4px; }
        .pc-dots span { width:5px; height:5px; border-radius:50%; background:rgba(255,255,255,.2); display:block; }
        .pc-avatar { width:96px; height:96px; border-radius:50%; border:4px solid rgba(255,255,255,.5); background:rgba(255,255,255,.2); margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; color:white; font-weight:800; font-size:2.5rem; overflow:hidden; }
        .pc-avatar img { width:100%; height:100%; object-fit:cover; }
        .pc-name { color:white; font-weight:800; font-size:1.2rem; letter-spacing:.5px; margin-bottom:.3rem; }
        .pc-job { color:rgba(255,255,255,.85); font-size:.85rem; margin-bottom:.15rem; }
        .pc-company { color:rgba(255,255,255,.7); font-size:.8rem; }
        .pc-wave { height:24px; background:white; clip-path:ellipse(60% 100% at 50% 100%); margin-top:-1px; }
        .pc-body { padding:1rem 1.5rem 1.5rem; }
        .pc-contact { display:flex; flex-direction:column; gap:.5rem; margin-bottom:1rem; }
        .pc-row { display:flex; align-items:center; gap:.7rem; padding:.55rem .8rem; background:#f8faff; border-radius:10px; font-size:.85rem; color:#1e293b; text-decoration:none; transition:background .15s; }
        .pc-row:hover { background:#eff6ff; }
        .pc-row i { color:#2563eb; width:16px; text-align:center; flex-shrink:0; }
        .pc-socials { display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1.2rem; }
        .pc-soc { flex:1; min-width:90px; display:flex; align-items:center; justify-content:center; gap:.4rem; padding:.6rem; border-radius:10px; text-decoration:none; color:white; font-weight:700; font-size:.8rem; transition:opacity .2s; }
        .pc-soc:hover { opacity:.88; }
        .save-btn { width:100%; padding:.85rem; background:#2563eb; color:white; border:none; border-radius:10px; font-size:.95rem; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.5rem; font-family:inherit; transition:background .2s; }
        .save-btn:hover { background:#1d4ed8; }
        .pc-footer-links { display:flex; justify-content:center; gap:1.2rem; padding-top:1rem; border-top:1px solid #f1f5f9; }
        .pc-footer-links a { font-size:.75rem; color:#94a3b8; text-decoration:none; }
        .pc-footer-links a:hover { color:#2563eb; }
        .powered { text-align:center; margin-top:1rem; font-size:.75rem; color:rgba(255,255,255,.6); }
        .powered a { color:rgba(255,255,255,.8); text-decoration:none; font-weight:600; }
    </style>
</head>
<body>
    <div class="public-card">
        <div class="pc-header">
            <div class="pc-dots">@for($i=0;$i<12;$i++)<span></span>@endfor</div>
            <div class="pc-avatar">
                @if($card->avatar)
                    <img src="{{ Storage::url($card->avatar) }}" alt="{{ $card->full_name }}">
                @else
                    {{ strtoupper(substr($card->full_name,0,1)) }}
                @endif
            </div>
            <div class="pc-name">{{ strtoupper($card->full_name) }}</div>
            @if($card->job_title)<div class="pc-job">{{ $card->job_title }}</div>@endif
            @if($card->company)<div class="pc-company">{{ $card->company }}</div>@endif
        </div>
        <div class="pc-wave"></div>

        <div class="pc-body">
            <div class="pc-contact">
                @if($card->phone)
                <a href="tel:{{ $card->phone }}" class="pc-row">
                    <i class="fa-solid fa-phone"></i> {{ $card->phone }}
                </a>
                @endif
                @if($card->email)
                <a href="mailto:{{ $card->email }}" class="pc-row">
                    <i class="fa-regular fa-envelope"></i> {{ $card->email }}
                </a>
                @endif
                @if($card->address)
                <div class="pc-row">
                    <i class="fa-solid fa-location-dot"></i> {{ $card->address }}
                </div>
                @endif
                @if($card->website)
                <a href="{{ $card->website }}" target="_blank" class="pc-row">
                    <i class="fa-solid fa-globe"></i> {{ $card->website }}
                </a>
                @endif
            </div>

            @if($card->facebook_url || $card->zalo_url || $card->linkedin_url)
            <div class="pc-socials">
                @if($card->facebook_url)
                <a href="{{ $card->facebook_url }}" target="_blank" class="pc-soc" style="background:#1877f2">
                    <i class="fa-brands fa-facebook-f"></i> Facebook
                </a>
                @endif
                @if($card->zalo_url)
                <a href="{{ $card->zalo_url }}" target="_blank" class="pc-soc" style="background:#0d9488">
                    <span style="font-weight:900">Zalo</span>
                </a>
                @endif
                @if($card->linkedin_url)
                <a href="{{ $card->linkedin_url }}" target="_blank" class="pc-soc" style="background:#0077b5">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                @endif
            </div>
            @endif

            <button class="save-btn" onclick="saveContact()">
                <i class="fa-solid fa-address-book"></i> Lưu danh bạ
            </button>

            <div class="pc-footer-links" style="margin-top:1rem">
                <a href="{{ url('/') }}">Tạo danh thiếp của bạn</a>
                <a href="#">Chia sẻ</a>
            </div>
        </div>
    </div>

    <div class="powered">Được tạo bởi <a href="{{ url('/') }}">Danh Thiếp Điện Tử</a></div>

    <script>
    function saveContact() {
        const vcard = [
            'BEGIN:VCARD', 'VERSION:3.0',
            'FN:{{ $card->full_name }}',
            @if($card->job_title) 'TITLE:{{ $card->job_title }}', @endif
            @if($card->company) 'ORG:{{ $card->company }}', @endif
            @if($card->phone) 'TEL:{{ $card->phone }}', @endif
            @if($card->email) 'EMAIL:{{ $card->email }}', @endif
            @if($card->website) 'URL:{{ $card->website }}', @endif
            @if($card->address) 'ADR:;;{{ $card->address }}', @endif
            'END:VCARD'
        ].join('\n');
        const blob = new Blob([vcard], {type:'text/vcard'});
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = '{{ Str::slug($card->full_name) }}.vcf';
        a.click();
    }
    </script>
</body>
</html>
