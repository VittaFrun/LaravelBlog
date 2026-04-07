<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LaravelBlog — Historias de Tecnología</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { 
                font-family: 'Outfit', sans-serif; 
                background-color: #09090b !important;
                color: #fafafa !important;
            }
            .bg-grid-white { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cpath d='M0 40L40 0M0 0L40 40' fill='none' stroke='%23ffffff' stroke-opacity='0.03' stroke-width='1'/%3E%3C/svg%3E"); }
            .premium-gradient { 
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                display: inline-block;
            }
            .glass-card { 
                background: rgba(24, 24, 27, 0.4); 
                backdrop-filter: blur(12px); 
                border: 1px solid rgba(255, 255, 255, 0.05); 
            }
            .hero-glow {
                background: radial-gradient(circle at 50% 50%, rgba(220, 38, 38, 0.05) 0%, transparent 70%);
            }
        </style>
    </head>
    <body class="antialiased overflow-x-hidden selection:bg-red-500 selection:text-white">
        <!-- Glow effect in background -->
        <div class="fixed inset-0 hero-glow pointer-events-none"></div>
        <div class="fixed inset-0 bg-grid-white pointer-events-none opacity-40"></div>
        
        <!-- Navbar Minimal -->
        <nav class="sticky top-0 z-50 bg-zinc-950/80 backdrop-blur-md border-b border-white/5">
            <div class="max-w-7xl mx-auto px-8 h-12 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="size-5 bg-red-600 rounded flex items-center justify-center text-white font-black text-[9px]">L</div>
                    <span class="text-[11px] font-black tracking-tight text-white uppercase">Laravel<span class="font-normal italic text-zinc-500">Blog</span></span>
                </a>
                
                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-[8px] font-black uppercase tracking-widest text-zinc-500 hover:text-white transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-1 rounded-md bg-red-600 text-white text-[8px] font-black uppercase tracking-widest hover:bg-red-700 shadow-lg shadow-red-600/20 transition-all">Acceder</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="relative z-10">
            <!-- New Hero Structure -->
            <header class="pt-20 pb-16 text-center max-w-4xl mx-auto px-8">
                <div class="flex justify-center mb-6">
                    <div class="px-2 py-0.5 rounded bg-white/5 border border-white/10 text-red-500 text-[7px] font-black uppercase tracking-[0.3em]">
                        The Digital Pulse
                    </div>
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-none text-white mb-6">
                    Historias que definen <br> <span class="premium-gradient">el futuro digital.</span>
                </h1>
                <p class="text-zinc-500 text-xs md:text-sm max-w-xl mx-auto leading-relaxed mb-10">
                    Exploramos la intersección entre ingeniería, diseño y minimalismo a través de contenido curado para la comunidad Laravel.
                </p>
                
                <!-- Category Quick Nav -->
                <div class="flex flex-wrap justify-center gap-2">
                    @php $cats = \App\Models\Category::take(5)->get(); @endphp
                    @foreach($cats as $cat)
                        <a href="#" class="px-3 py-1 rounded-full bg-white/5 border border-white/5 hover:border-red-500/30 text-[8px] font-black uppercase tracking-widest text-zinc-500 hover:text-red-500 transition-all">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </header>

            <section class="max-w-7xl mx-auto px-8 pb-32">
                @if($posts->isNotEmpty())
                    @php $featured = $posts->first(); $others = $posts->skip(1); @endphp
                    
                    <!-- Featured Post: Better Frame -->
                    <div class="mb-24">
                        <article class="glass-card rounded-2xl overflow-hidden grid grid-cols-1 md:grid-cols-12 items-stretch group shadow-2xl max-w-5xl mx-auto border-white/5 bg-zinc-900/10">
                            <div class="md:col-span-7 h-48 md:h-[350px] overflow-hidden relative">
                                 <img src="{{ $featured->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90 group-hover:opacity-100" />
                            </div>
                            <div class="md:col-span-5 p-10 flex flex-col justify-center space-y-4">
                                <span class="text-[7px] font-black uppercase tracking-[0.4em] text-red-500">Destacado</span>
                                <h2 class="text-2xl md:text-3xl font-black tracking-tight text-white leading-tight">
                                    {{ $featured->title }}
                                </h2>
                                <p class="text-zinc-500 text-[11px] leading-relaxed line-clamp-3">
                                    {{ $featured->excerpt ?? 'Explora el contenido completo en la nueva vista de lectura premium.' }}
                                </p>
                                
                                <div class="pt-6">
                                    <a href="{{ route('posts.show', $featured->slug) }}" class="inline-flex items-center gap-3 px-6 py-3 rounded-xl bg-red-600 text-white text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 group-hover:scale-105">
                                        Leer Historia <span class="text-base">→</span>
                                    </a>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-white/5 mt-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-5 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-[7px]">{{ substr($featured->user?->name ?? 'A', 0, 1) }}</div>
                                        <span class="text-[8px] font-bold text-zinc-500 uppercase tracking-widest">{{ $featured->user?->name }}</span>
                                    </div>
                                    <span class="text-[8px] font-black uppercase text-zinc-700 tracking-widest">{{ $featured->published_at?->format('d M, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Compact Grid: Higher density -->
                    <div class="space-y-8">
                        <div class="flex items-center gap-4 px-2">
                            <span class="text-[8px] font-black uppercase tracking-[0.5em] text-zinc-600">Explorar Recientes</span>
                            <div class="h-px flex-1 bg-white/5"></div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @forelse($others as $post)
                                <article class="glass-card rounded-xl overflow-hidden group hover:bg-zinc-800/10 transition-all duration-500 flex flex-col">
                                    <div class="h-36 overflow-hidden relative">
                                        <img src="{{ $post->image_url }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-1000" />
                                        <div class="absolute top-2 left-2">
                                            <span class="px-1.5 py-0.5 rounded bg-zinc-950/80 backdrop-blur-md text-[6px] font-black uppercase tracking-widest border border-white/5 text-red-500">
                                                {{ $post->category?->name ?? 'General' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col space-y-3">
                                        <h4 class="text-sm font-bold tracking-tight text-zinc-100 leading-snug group-hover:text-red-500 transition-colors line-clamp-2">
                                            {{ $post->title }}
                                        </h4>
                                        <div class="flex-1"></div>
                                        <div class="pt-4 border-t border-white/5 flex flex-col gap-4">
                                            <div class="flex items-center justify-between">
                                                <span class="text-[7px] font-bold text-zinc-600 uppercase">{{ $post->published_at?->format('d/m/Y') }}</span>
                                                <span class="text-[7px] font-black uppercase text-zinc-500">{{ $post->user?->name }}</span>
                                            </div>
                                            <a href="{{ route('posts.show', $post->slug) }}" class="w-full py-2 rounded-lg bg-white/5 border border-white/10 text-white text-[8px] font-black uppercase tracking-widest text-center hover:bg-red-600 hover:border-red-600 transition-all shadow-sm">
                                                Leer Historia
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="col-span-full py-12 text-center text-zinc-600">
                                    <p class="text-[10px] font-black uppercase tracking-widest italic">Cargando más historias...</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="py-32 text-center glass-card rounded-2xl max-w-xl mx-auto">
                         <div class="size-12 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
                            <flux:icon icon="newspaper" class="size-6 text-zinc-800" />
                         </div>
                         <h3 class="text-xl font-black text-zinc-400 mb-2">Página en Blanco.</h3>
                         <p class="text-[10px] text-zinc-600 uppercase tracking-widest font-bold">Estamos redactando nuevas historias para ti.</p>
                    </div>
                @endif
            </section>

        </main>

        <footer class="border-t border-white/5 bg-zinc-950 py-20 relative z-10">
            <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="size-4 bg-red-600 rounded-sm"></div>
                    <span class="text-[10px] font-black text-white uppercase tracking-tighter">LaravelBlog</span>
                    <span class="text-[10px] text-zinc-700 font-bold ml-2 uppercase">&copy; {{ date('Y') }} ENGINE</span>
                </div>
                <div class="flex gap-8">
                    <a href="#" class="text-[9px] font-black uppercase tracking-widest text-zinc-600 hover:text-red-500 transition-colors">Twitter</a>
                    <a href="#" class="text-[9px] font-black uppercase tracking-widest text-zinc-600 hover:text-red-500 transition-colors">Instagram</a>
                    <a href="#" class="text-[9px] font-black uppercase tracking-widest text-zinc-600 hover:text-red-500 transition-colors">Github</a>
                </div>
            </div>
        </footer>
    </body>
</html>
