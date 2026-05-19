{{-- Main Application Layout: Handles global wrapper, navbar, and core CSS integrations --}}
<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Global Meta and Fonts --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overclock Hub | High-Performance PC Components</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
                :root {
            --bg-main: #060608;
            --bg-card: #0d0f12;
            --bg-alt: #13161c;
            --accent: #00f0ff;
            --accent-dim: rgba(0, 240, 255, 0.1);
            --accent-hover: #33f3ff;
            --text-main: #ffffff;
            --text-muted: #8b949e;
            --border: #1f242d;
            --danger: #ff3333;
            --success: #0f6;
            --warning: #ffcc00;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-main); color: var(--text-main); line-height: 1.5; -webkit-font-smoothing: antialiased; }
        h1, h2, h3, h4 { font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
        a { text-decoration: none; }

        .section-title { text-align: left; margin: 4rem 0 2rem 0; font-size: 2.2rem; border-bottom: 2px solid var(--border); padding-bottom: 0.5rem; }
        .section-title span { color: var(--accent); }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .grid-7 { display: grid; grid-template-columns: repeat(7, 1fr); gap: 1rem; }
        .w-100 { width: 100%; }

        nav { background-color: var(--bg-main); padding: 0 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 1000; height: 70px; }
        .logo { font-size: 1.6rem; font-weight: 900; letter-spacing: 2px; cursor: pointer; text-transform: uppercase; color: var(--text-main); text-decoration: none; }
        .logo span { color: var(--accent); }

        .nav-links { display: flex; gap: 2rem; align-items: center; height: 100%; }
        .nav-links > a { color: var(--text-main); text-decoration: none; cursor: pointer; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; display: flex; align-items: center; height: 100%; border-bottom: 2px solid transparent; }
        .nav-links > a:hover { color: var(--accent); border-bottom: 2px solid var(--accent); }

        .dropdown { position: relative; height: 100%; display: flex; align-items: center; }
        .dropdown > a { color: var(--text-main); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; height: 100%; display: flex; align-items: center; border-bottom: 2px solid transparent; transition: 0.2s; }
        .dropdown:hover > a { color: var(--accent); border-bottom: 2px solid var(--accent); }
        .dropdown-content { display: none; position: absolute; top: 100%; left: 0; background-color: var(--bg-card); width: 650px; border: 1px solid var(--border); border-top: none; padding: 2rem; grid-template-columns: repeat(4, 1fr); gap: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.8); }
        .dropdown:hover .dropdown-content { display: grid; }

        .cat-group h4 { color: var(--accent); font-size: 0.75rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; margin-bottom: 1rem; letter-spacing: 2px; }
        .cat-group a { display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.6rem; text-transform: uppercase; font-weight: 500; cursor: pointer; transition: all 0.2s ease; text-decoration: none; }
        .cat-group a:hover { color: var(--text-main); transform: translateX(4px); }

                .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1.5px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: center; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .btn:active { transform: scale(0.97); }
        .btn-primary { background-color: var(--accent); color: #000; }
        .btn-primary:hover { background-color: var(--accent-hover); box-shadow: 0 0 20px var(--accent-dim); transform: translateY(-2px); }
        .btn-outline { background-color: transparent; border: 1px solid var(--accent); color: var(--accent); }
        .btn-outline:hover { background-color: var(--accent); color: #000; transform: translateY(-2px); }
        .btn-danger { background-color: transparent; border: 1px solid var(--danger); color: var(--danger); }
        .btn-danger:hover { background-color: var(--danger); color: #fff; transform: translateY(-2px); }
        .btn-success { background-color: transparent; border: 1px solid var(--success); color: var(--success); }
        .btn-success:hover { background-color: var(--success); color: #000; transform: translateY(-2px); }

        .form-control { width: 100%; padding: 0.85rem 1rem; background-color: var(--bg-main); border: 1px solid var(--border); color: var(--text-main); margin-bottom: 1.2rem; border-radius: 0; font-family: monospace; font-size: 0.95rem; transition: border-color 0.2s ease; }
        .form-control:focus { outline: none; border-color: var(--accent); box-shadow: inset 2px 0 0 var(--accent); }
        textarea.form-control { resize: vertical; }
        select.form-control { appearance: auto; }

        
        .page-content { padding: 0 2rem 4rem 2rem; max-width: 1600px; margin: 0 auto; min-height: 85vh; animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .stagger-item { opacity: 0; transform: translateY(15px); transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        .stagger-item.is-visible { opacity: 1; transform: translateY(0); }

        .img-container { width: 100%; height: 220px; background-color: var(--bg-main); border: 1px solid var(--border); margin-bottom: 1.5rem; overflow: hidden; position: relative; display: block; }
        .img-container img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        .card:hover .img-container img { transform: scale(1.08); }
        .hero { margin: 0 -2rem 4rem -2rem; padding: 8rem 4rem; background: linear-gradient(90deg, rgba(10,10,12,1) 0%, rgba(10,10,12,0.7) 50%, rgba(10,10,12,0.2) 100%); border-bottom: 1px solid var(--border); position: relative; }
        .hero-about { background: linear-gradient(90deg, rgba(10,10,12,1) 0%, rgba(10,10,12,0.7) 60%, rgba(10,10,12,0.2) 100%); }
        .hero::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, var(--accent) 0%, transparent 100%); }
        .hero h1 { font-size: 4.5rem; letter-spacing: 2px; line-height: 1.1; margin-bottom: 1.5rem; max-width: 800px; }
        .hero p { color: var(--text-muted); font-size: 1.2rem; max-width: 600px; margin-bottom: 2.5rem; font-weight: 400; }
        
        .hero-video { position: absolute; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: 0; transform: translateX(-50%) translateY(-50%); object-fit: cover; opacity: 1; pointer-events: none; }
        .hero-overlay { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(6,6,8,1) 0%, rgba(6,6,8,0.7) 40%, transparent 100%); z-index: 1; }

                .card { background-color: var(--bg-card); border: 1px solid var(--border); padding: 1.5rem; text-align: left; display: flex; flex-direction: column; justify-content: space-between; position: relative; border-radius: 4px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .card::before { content: ''; position: absolute; top: 0; left: -1px; width: 3px; height: 100%; background-color: transparent; transition: 0.3s ease; }
        .card:hover::before { background-color: var(--accent); }
        .card:hover { border-color: var(--border); background-color: var(--bg-alt); transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0, 240, 255, 0.05); }

        .img-placeholder { width: 100%; height: 220px; background-color: var(--bg-main); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--border); font-size: 1rem; font-weight: 900; letter-spacing: 4px; }
        .card h3 { font-size: 1.1rem; margin-bottom: 0.5rem; height: 48px; overflow: hidden; letter-spacing: 0; }
        .price { font-family: monospace; font-size: 1.6rem; color: var(--text-main); font-weight: 700; margin: 1rem 0; padding-top: 1rem; border-top: 1px dashed var(--border); display: flex; align-items: center; }
        .price::before { content: 'MSRP'; font-size: 0.7rem; color: var(--text-muted); margin-right: 0.5rem; letter-spacing: 1px; font-family: 'Inter', sans-serif; }

        .cat-img-card { background-color: var(--bg-card); border: 1px solid var(--border); height: 120px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; position: relative; overflow: hidden; background-size: cover; background-position: center; text-decoration: none; }
        .cat-img-card::before { content: ''; position: absolute; inset: 0; background: rgba(10,10,12,0.85); z-index: 1; transition: background 0.2s ease; }
        .cat-img-card span { position: relative; z-index: 2; font-size: 0.85rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: var(--text-main); text-align: center; }
        .cat-img-card:hover::before { background: rgba(10,10,12,0.4); }
        .cat-img-card:hover { border-color: var(--accent); transform: translateY(-2px); box-shadow: 0 5px 15px var(--accent-dim); }

        .bg-cpu { background-image: url('/images/Processor.png'); }
        .bg-gpu { background-image: url('/images/Graphic.png'); }
        .bg-mobo { background-image: url('/images/Motherboard.png'); }
        .bg-ram { background-image: url('/images/Memory.png'); }
        .bg-ssd { background-image: url('/images/SSD.png'); }
        .bg-hdd { background-image: url('/images/HDD.png'); }
        .bg-psu { background-image: url('/images/Powersupply.png'); }
        .bg-cooler { background-image: url('/images/Cpu coolers.png'); }
        .bg-fans { background-image: url('/images/Case Fans.png'); }
        .bg-case { background-image: url('/images/PC case.png'); }
        .bg-monitor { background-image: url('/images/Monitors.png'); }
        .bg-key { background-image: url('/images/Keyboard.png'); }
        .bg-mouse { background-image: url('/images/Mice.png'); }
        .bg-audio { background-image: url('/images/Headset.png'); }

        .feature-box { text-align: left; padding: 2rem; border: 1px solid var(--border); background-color: var(--bg-card); transition: 0.2s ease; position: relative; }
        .feature-box:hover { border-color: var(--text-muted); }
        .feature-box h1 { font-size: 2rem; color: var(--accent); margin-bottom: 1rem; }
        .feature-box h3 { font-size: 1.1rem; }
        .feature-box p { color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem; }

        .cart-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start; }
        .checkout-panel { background-color: var(--bg-card); padding: 2.5rem; border: 1px solid var(--border); }

        table { width: 100%; border-collapse: collapse; background-color: var(--bg-card); border: 1px solid var(--border); }
        th, td { padding: 1.2rem; text-align: left; border-bottom: 1px solid var(--border); }
        th { color: var(--text-muted); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 2px; font-weight: 700; background-color: var(--bg-main); }
        td { font-size: 0.95rem; }

        .order-tabs { display: flex; border-bottom: 1px solid var(--border); margin-bottom: 2rem; }
        .order-tab { padding: 1rem 2.5rem; cursor: pointer; color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; border-bottom: 2px solid transparent; transition: all 0.2s ease; letter-spacing: 1px; text-decoration: none; }
        .order-tab:hover { color: var(--text-main); }
        .order-tab.active { color: var(--accent); border-bottom-color: var(--accent); background-color: var(--accent-dim); }
        .order-content { display: none; }
        .order-content.active { display: block; animation: quickFade 0.2s ease-out; }

        .status { padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; border: 1px solid currentColor; display: inline-block; }
        .status-warn { color: var(--warning); }
        .status-ok { color: var(--success); }

        footer { background-color: var(--bg-card); border-top: 1px solid var(--border); padding: 4rem 2rem; margin-top: 4rem; text-align: left; display: grid; grid-template-columns: 1fr 1fr; max-width: 1600px; margin-left: auto; margin-right: auto; }
        .footer-brand h2 { font-weight: 900; letter-spacing: 2px; margin-bottom: 0.5rem; }
        .footer-brand p { color: var(--text-muted); font-size: 0.9rem; }

        @keyframes quickFade { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .alert { padding: 1rem 1.5rem; margin-bottom: 1.5rem; font-family: monospace; font-size: 0.9rem; border: 1px solid; animation: quickFade 0.3s ease-out; position: relative; }
        .alert-success { color: var(--success); border-color: var(--success); background-color: rgba(0,255,102,0.05); }
        .alert-danger { color: var(--danger); border-color: var(--danger); background-color: rgba(255,51,51,0.05); }
        .alert-info { color: var(--accent); border-color: var(--accent); background-color: rgba(0,229,255,0.05); }
        
        
        .hover-bg-alt { transition: background-color 0.2s ease; }
        .hover-bg-alt:hover { background-color: rgba(255,255,255,0.02); }

        @yield('styles')
    </style>
</head>
<body>

    <nav>
        <a class="logo" href="{{ route('home') }}">OVERCLOCK<span>HUB</span></a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Terminal</a>
            <a href="{{ route('about') }}">About</a>              <a href="{{ route('gallery') }}">Gallery</a>            <div class="dropdown">
                <a>Hardware</a>
                <div class="dropdown-content">
                    <div class="cat-group">
                        <h4>Core</h4>
                        <a href="{{ route('catalog', 'cpu') }}">Processors (CPU)</a>
                        <a href="{{ route('catalog', 'gpu') }}">Graphics (GPU)</a>
                        <a href="{{ route('catalog', 'mobo') }}">Motherboards</a>
                        <a href="{{ route('catalog', 'ram') }}">Memory (RAM)</a>
                    </div>
                    <div class="cat-group">
                        <h4>Storage</h4>
                        <a href="{{ route('catalog', 'ssd') }}">NVMe SSD</a>
                        <a href="{{ route('catalog', 'hdd') }}">Enterprise HDD</a>
                    </div>
                    <div class="cat-group">
                        <h4>Power &amp; Cooling</h4>
                        <a href="{{ route('catalog', 'psu') }}">Power Supplies</a>
                        <a href="{{ route('catalog', 'cooler') }}">CPU Coolers</a>
                        <a href="{{ route('catalog', 'fans') }}">Case Fans</a>
                    </div>
                    <div class="cat-group">
                        <h4>Build &amp; Gear</h4>
                        <a href="{{ route('catalog', 'case') }}">PC Cases</a>
                        <a href="{{ route('catalog', 'monitor') }}">Monitors</a>
                        <a href="{{ route('catalog', 'keyboard') }}">Keyboards</a>
                        <a href="{{ route('catalog', 'mouse') }}">Mice</a>
                        <a href="{{ route('catalog', 'audio') }}">Headsets</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('contact') }}">Support</a>
            <a href="{{ route('policies') }}">Policies</a>

            <div style="display: flex; gap: 2rem; align-items: center; border-left: 1px solid var(--border); padding-left: 2rem; margin-left: 1rem;">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" style="color: var(--danger); font-family: monospace; font-weight: 700;">[ ROOT_ACCESS_GRANTED ]</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Terminate</button>
                        </form>
                    @else
                        <a href="{{ route('profile.edit') }}" style="border-right: 1px solid var(--border); padding-right: 1.5rem; color: var(--accent);"><span style="font-family: monospace;">[ OPERATOR: {{ strtoupper(Auth::user()->name) }} ]</span></a>
                        <a href="{{ route('cart.index') }}" style="color: var(--text-main); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Queue ({{ $cartCount }})</a>
                        <a href="{{ route('orders.index') }}" style="color: var(--text-main); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Telemetry</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="margin-left: 1rem;">Terminate</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-outline">Create Account</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Initialize Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        <div class="footer-brand">
            <h2>OVERCLOCK<span style="color:var(--accent);">HUB</span></h2>
            <p>Precision computing hardware for extreme performance operations.</p>
        </div>
        <div style="text-align: right;">
            <p style="font-family: monospace; color: var(--border); font-size: 0.85rem;">SYS_STATUS: ONLINE<br>V 3.0.0 Final</p>
        </div>
    </footer>

    <script>
        function switchOrderTab(tabId) {
            document.querySelectorAll('.order-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.order-content').forEach(c => c.classList.remove('active'));
            document.querySelector('[data-tab="' + tabId + '"]').classList.add('active');
            document.getElementById('tab-' + tabId).classList.add('active');
        }
    </script>
    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            
            const staggerItems = document.querySelectorAll('.stagger-item');
            staggerItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('is-visible');
                }, 50 * index); // 50ms stagger
            });
        });
    </script>
</body>

</html>
