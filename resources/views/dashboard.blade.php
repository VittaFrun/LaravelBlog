<x-layouts::app :title="__('Panel Principal')">
    <div class="max-w-5xl mx-auto py-8 px-4 space-y-10">
        <!-- Welcome Header -->
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" class="font-black tracking-tight text-zinc-900 dark:text-zinc-100">Hola, {{ explode(' ', auth()->user()->name)[0] }}</flux:heading>
                <flux:subheading class="text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400">Resumen general del blog</flux:subheading>
            </div>
            <div class="flex items-center gap-3">
                <flux:button href="{{ route('admin.posts.index') }}" variant="ghost" size="sm" class="text-[10px] font-black uppercase tracking-widest">Ver Posts</flux:button>
                <flux:button href="{{ route('admin.posts.create') }}" variant="primary" size="sm" icon="plus" class="premium-gradient border-none px-6 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/20">Redactar</flux:button>
            </div>
        </div>

        <!-- KPI Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Posts KPI -->
            <div class="premium-card-compact p-6 flex items-center gap-6 border-l-4 border-l-indigo-500">
                <div class="size-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600">
                    <flux:icon icon="newspaper" class="size-6" />
                </div>
                <div>
                    <div class="text-3xl font-black tracking-tighter text-zinc-900 dark:text-white leading-none">{{ $postCount }}</div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-zinc-400 mt-1">Historias</div>
                </div>
            </div>

            <!-- Categories KPI -->
            <div class="premium-card-compact p-6 flex items-center gap-6 border-l-4 border-l-emerald-500">
                <div class="size-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center text-emerald-600">
                    <flux:icon icon="tag" class="size-6" />
                </div>
                <div>
                    <div class="text-3xl font-black tracking-tighter text-zinc-900 dark:text-white leading-none">{{ $categoryCount }}</div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-zinc-400 mt-1">Categorías</div>
                </div>
            </div>

            <!-- Contributors KPI -->
            <div class="premium-card-compact p-6 flex items-center gap-6 border-l-4 border-l-zinc-900 dark:border-l-white">
                <div class="size-12 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-900 dark:text-white">
                    <flux:icon icon="users" class="size-6" />
                </div>
                <div>
                    <div class="text-3xl font-black tracking-tighter text-zinc-900 dark:text-white leading-none">{{ $userCount }}</div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-zinc-400 mt-1">Colaboradores</div>
                </div>
            </div>
        </div>

        <!-- Clean Quick Actions -->
        <flex class="items-center gap-4 flex-wrap px-2">
            <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400 mr-2">Quick:</span>
            
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 transition-colors shadow-sm">
                <flux:icon icon="plus" class="size-3 text-zinc-900 dark:text-white" />
                <span class="text-[11px] font-bold text-indigo-600">Redactar</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 transition-colors shadow-sm">
                <flux:icon icon="folder-plus" class="size-3 text-zinc-400" />
                <span class="text-[11px] font-bold text-zinc-600 dark:text-zinc-300">Categorías</span>
            </a>

            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 transition-colors shadow-sm">
                <flux:icon icon="magnifying-glass" class="size-3 text-zinc-400" />
                <span class="text-[11px] font-bold text-zinc-600 dark:text-zinc-300">Explorar</span>
            </a>

            <a href="/" target="_blank" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 transition-colors shadow-sm">
                <flux:icon icon="arrow-top-right-on-square" class="size-3 text-zinc-400" />
                <span class="text-[11px] font-bold text-zinc-600 dark:text-zinc-300">Web</span>
            </a>
        </flex>
    </div>
</x-layouts::app>
