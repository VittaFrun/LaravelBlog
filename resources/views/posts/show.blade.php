<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }} — LaravelBlog</title>
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
            .bg-grid-white { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cpath d='M0 40L40 0M0 0L40 40' fill='none' stroke='%23ffffff' stroke-opacity='0.02' stroke-width='1'/%3E%3C/svg%3E"); }
            .content-area p { margin-bottom: 1.5rem; line-height: 1.7; color: #a1a1aa; }
            .content-area h2 { font-size: 1.25rem; font-weight: 900; margin-top: 2.5rem; margin-bottom: 1rem; color: #fff; letter-spacing: -0.02em; }
        </style>
    </head>
    <body class="antialiased overflow-x-hidden selection:bg-red-500 selection:text-white">
        <div class="fixed inset-0 bg-grid-white pointer-events-none opacity-40"></div>
        
        <!-- Reader Navbar -->
        <nav class="sticky top-0 z-50 bg-zinc-950/50 backdrop-blur-md border-b border-white/5">
            <div class="max-w-4xl mx-auto px-6 h-14 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-red-500 group-hover:translate-x--1 transition-transform">←</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-zinc-500 group-hover:text-white transition-colors">Volver al inicio</span>
                </a>
                <div class="flex items-center gap-3">
                    <div class="size-6 bg-red-600 rounded flex items-center justify-center text-white font-black text-[10px]">L</div>
                </div>
            </div>
        </nav>

        <article class="relative z-10">
            <!-- Header Section -->
            <header class="pt-12 pb-12 px-6 max-w-2xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <span class="px-2 py-0.5 rounded bg-red-600/10 border border-red-600/20 text-red-500 text-[8px] font-black uppercase tracking-widest">
                        {{ $post->category?->name ?? 'Tendencias' }}
                    </span>
                    <span class="text-[10px] font-bold text-zinc-600 uppercase tracking-widest">
                        {{ $post->published_at?->format('d M, Y') }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-[1.1] text-white mb-8">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5">
                    <div class="size-10 bg-red-600/20 border border-red-600/30 rounded-xl flex items-center justify-center text-red-500 font-black">
                        {{ substr($post->user?->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black uppercase tracking-widest text-zinc-300">Escrito por {{ $post->user?->name }}</span>
                        <span class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest">Editor de LaravelBlog</span>
                    </div>
                </div>
            </header>

            <!-- Main Image -->
            <div class="max-w-3xl mx-auto px-6 mb-16 animate-in fade-in slide-in-from-bottom-4 duration-1000">
                <div class="aspect-video md:aspect-[21/9] rounded-[1.5rem] overflow-hidden border border-white/5 shadow-2xl">
                    <img src="{{ $post->image_url }}" class="w-full h-full object-cover" />
                </div>
            </div>

            <!-- Main Content Reader -->
            <main class="max-w-xl mx-auto px-6 pb-32">
                <!-- Excerpt as intro -->
                <div class="text-lg italic text-zinc-400 mb-10 border-l-2 border-red-600 pl-6 py-2">
                    {{ $post->excerpt }}
                </div>

                <!-- Content with premium typography -->
                <div class="content-area text-zinc-300 text-base leading-relaxed antialiased">
                    {!! $post->content !!}
                </div>

                <!-- Tags list -->
                @if($post->tags->isNotEmpty())
                    <div class="mt-12 flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="px-3 py-1 rounded-full bg-white/5 border border-white/5 text-[9px] font-bold text-zinc-500 uppercase tracking-widest">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Footer of Artile -->
                <div class="mt-20 pt-10 border-t border-white/5 flex flex-col items-center text-center">
                    <div class="size-10 bg-zinc-900 rounded-full flex items-center justify-center border border-white/5 mb-4">
                        <flux:icon icon="share" class="size-4 text-zinc-500" />
                    </div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-zinc-700 mb-8">Gracias por leer hasta el final.</h4>
                    
                    <a href="{{ route('home') }}" class="px-8 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">
                        Explorar más historias
                    </a>
                </div>
            </main>
        </article>

        <!-- Footer Footer -->
        <footer class="bg-zinc-950/50 py-20 border-t border-white/5">
            <div class="max-w-4xl mx-auto px-6 text-center">
                 <div class="text-[10px] font-black uppercase tracking-widest text-zinc-800">
                     &copy; {{ date('Y') }} LaravelBlog ENGINE &bull; Publicación de alta fidelidad.
                 </div>
            </div>
        </footer>
    </body>
</html>
