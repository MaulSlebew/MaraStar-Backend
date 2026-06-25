<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', config('app.name', 'BLABLABLA'))</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                            display: ['Space Grotesk', 'Inter', 'sans-serif'],
                        },
                    },
                },
            };
        </script>
        <!-- Class lama (.button, .card, dst) tetap dipakai di halaman Kategori/Produk/Size -->
        <style>
            * { box-sizing: border-box; }
            body { font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
            a { text-decoration: none; }

            .card { background:#fff; border:1px solid #e4e4e7; border-radius:0.4rem; padding:1.5rem; }
            .table { width:100%; border-collapse:collapse; margin-top:1rem; }
            .table th, .table td { padding:0.85rem 0.75rem; border-bottom:1px solid #e4e4e7; text-align:left; }
            .table th { font-size:0.7rem; text-transform:uppercase; letter-spacing:0.08em; color:#71717a; }
            .table tbody tr:hover { background:#fafafa; }
            .button { display:inline-flex; align-items:center; justify-content:center; gap:0.35rem; border-radius:999px; padding:0.65rem 1.2rem; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; border:1px solid #09090b; background:#09090b; color:#fff; cursor:pointer; transition:all .15s ease; }
            .button:hover { background:#f97316; border-color:#f97316; }
            .button.secondary { background:transparent; color:#18181b; border-color:#d4d4d8; }
            .button.secondary:hover { border-color:#18181b; background:#18181b; color:#fff; }
            .button.danger { background:#b91c1c; border-color:#b91c1c; }
            .button.small { padding:0.45rem 0.9rem; font-size:0.68rem; }
            .badge { display:inline-flex; align-items:center; gap:0.4rem; padding:0.3rem 0.7rem; border-radius:999px; background:#18181b; color:#fafafa; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; }
            .form-field { display:grid; gap:0.5rem; margin-bottom:1.1rem; }
            .form-field label { font-weight:700; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.05em; color:#3f3f46; }
            .form-field input, .form-field select, .form-field textarea { width:100%; border:1px solid #d4d4d8; border-radius:0.3rem; padding:0.8rem 0.9rem; font-size:0.95rem; color:#18181b; }
            .form-field input:focus, .form-field select:focus, .form-field textarea:focus { outline:none; border-color:#18181b; }
            .form-field textarea { min-height:120px; resize:vertical; }
            .form-actions { display:flex; flex-wrap:wrap; gap:0.75rem; margin-top:1rem; }
            .small-text { color:#71717a; font-size:0.9rem; }
            .corner-tag { position:absolute; top:-1px; right:1.25rem; background:#09090b; color:#fafafa; font-size:0.65rem; padding:0.25rem 0.6rem; letter-spacing:0.05em; border-radius:0 0 0.3rem 0.3rem; }
            ul.plain-list { list-style:none; padding:0; margin:0; }
            ul.plain-list li { padding:0.9rem 0; border-bottom:1px solid #f4f4f5; display:flex; align-items:flex-start; gap:0.75rem; }
            ul.plain-list li:last-child { border-bottom:none; }
        </style>
    </head>
    <body class="bg-zinc-50 text-zinc-900">
        <div class="flex min-h-screen">
            {{-- ===================== SIDEBAR ===================== --}}
            <aside class="hidden w-64 flex-shrink-0 flex-col bg-zinc-950 text-zinc-50 lg:flex">
                <div class="flex items-center gap-2 px-6 py-6">
                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                    <span class="font-display text-lg font-bold tracking-tight">BLABLABLA</span>
                </div>

                <p class="px-6 pb-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-zinc-500">
                    Menu
                </p>

                <nav class="flex flex-col gap-1 px-3">
                    @php
                        $navItems = [
                            ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
                            ['label' => 'Kategori', 'route' => 'categories.index', 'active' => 'categories.*'],
                            ['label' => 'Produk', 'route' => 'products.index', 'active' => 'products.*'],
                            ['label' => 'Size', 'route' => 'sizes.index', 'active' => 'sizes.*'],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs($item['active']) ? 'bg-zinc-50 text-zinc-950' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-50' }}"
                        >
                            <span class="h-1.5 w-1.5 rounded-full {{ request()->routeIs($item['active']) ? 'bg-zinc-950' : 'bg-zinc-600' }}"></span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-auto px-6 py-6">
                    <p class="text-[11px] text-zinc-600">© {{ date('Y') }} BLABLABLA Admin</p>
                </div>
            </aside>

            {{-- ===================== MAIN ===================== --}}
            <div class="flex min-h-screen flex-1 flex-col">
                {{-- TOPBAR --}}
                <header class="sticky top-0 z-20 flex items-center justify-between gap-4 border-b border-zinc-200 bg-zinc-50/90 px-4 py-4 backdrop-blur-sm md:px-8">
                    <div class="flex items-center gap-3 lg:hidden">
                        <span class="font-display text-base font-bold">BLABLABLA</span>
                    </div>

                    <div class="hidden max-w-md flex-1 items-center gap-2 rounded-full border border-zinc-200 bg-white px-4 py-2 md:flex">
                        <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                        <input type="text" placeholder="Cari produk, kategori..." class="w-full border-none bg-transparent text-sm text-zinc-700 placeholder-zinc-400 focus:outline-none" />
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="relative rounded-full border border-zinc-200 p-2 text-zinc-500 hover:text-zinc-900">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                        </button>
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-900 text-xs font-bold text-zinc-50">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="hidden text-sm font-medium text-zinc-700 sm:inline">
                                {{ Auth::user()->name ?? 'Admin' }}
                            </span>
                        </div>
                    </div>
                </header>

                {{-- CONTENT --}}
                <main class="flex-1 px-4 py-6 md:px-8 md:py-8">
                    @if (session('success'))
                        <div class="mb-6 flex items-center gap-2 rounded-lg bg-zinc-900 px-4 py-3 text-sm font-medium text-zinc-50">
                            <span class="text-orange-400">✓</span>
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>