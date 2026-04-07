<x-layouts::app :title="__('Gestión de Historias')">
    <div class="max-w-6xl mx-auto py-6 space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
            <div>
                <flux:heading size="xl" class="font-black tracking-tight">Historias</flux:heading>
                <flux:subheading class="text-[11px] font-medium uppercase tracking-wider text-zinc-400">Control editorial y métricas de publicación</flux:subheading>
            </div>
            
            <flux:button href="{{ route('admin.posts.create') }}" variant="primary" icon="plus" class="premium-gradient border-none text-[10px] font-black uppercase tracking-widest py-5 px-6 shadow-lg shadow-indigo-500/20">
                Nueva Historia
            </flux:button>
        </div>

        @if (session('info'))
            <flux:card class="mx-2 bg-emerald-50/50 border-emerald-100 dark:bg-emerald-950/10 dark:border-emerald-900/30 flex items-center gap-3 py-3 px-4">
                <div class="size-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                <span class="text-[10px] font-bold uppercase tracking-wide text-emerald-800 dark:text-emerald-400">{{ session('info') }}</span>
            </flux:card>
        @endif

        <!-- Table Container -->
        <div class="premium-card-compact overflow-hidden mx-2">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column class="pl-8 w-20"></flux:table.column>
                    <flux:table.column class="font-black uppercase tracking-widest text-[9px] px-4">Artículo</flux:table.column>
                    <flux:table.column class="hidden md:table-cell font-black uppercase tracking-widest text-[9px] px-4">Categoría</flux:table.column>
                    <flux:table.column class="font-black uppercase tracking-widest text-[9px] px-4">Estado</flux:table.column>
                    <flux:table.column align="end" class="font-black uppercase tracking-widest text-[9px] pr-8">Acciones</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($posts as $post)
                        <flux:table.row :key="$post->id" class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-900/30 transition-colors">
                            <flux:table.cell class="pl-8 py-5">
                                <div class="img-container size-10 shrink-0 group-hover:scale-105 transition-transform duration-500">
                                    <img src="{{ $post->image_url }}" class="img-contain" alt="{{ $post->title }}">
                                </div>
                            </flux:table.cell>

                            <flux:table.cell class="px-4 py-5">
                                <div class="flex flex-col min-w-0">
                                    <span class="font-bold text-zinc-900 dark:text-white truncate text-sm group-hover:text-indigo-600 transition-colors">{{ $post->title }}</span>
                                    <span class="text-[8px] text-zinc-400 font-mono tracking-tighter truncate opacity-70">/{{ $post->slug }}</span>
                                </div>
                            </flux:table.cell>

                            <flux:table.cell class="hidden md:table-cell px-4 py-5">
                                <span class="px-2 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-[9px] font-black uppercase tracking-widest text-zinc-500">
                                    {{ $post->category?->name ?? 'General' }}
                                </span>
                            </flux:table.cell>

                            <flux:table.cell class="px-4 py-5">
                                <div class="flex items-center gap-2">
                                    <div class="size-1.5 rounded-full {{ $post->is_published ? 'bg-emerald-500 shadow-[0_0_5px_rgba(16,185,129,0.4)]' : 'bg-zinc-300' }}"></div>
                                    <span class="text-[9px] font-black uppercase tracking-widest {{ $post->is_published ? 'text-zinc-600 dark:text-zinc-300' : 'text-zinc-400' }}">
                                        {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                                    </span>
                                </div>
                            </flux:table.cell>

                            <flux:table.cell align="end" class="pr-8 py-5">
                                <div class="flex items-center justify-end gap-1">
                                    <flux:button href="{{ route('admin.posts.edit', $post) }}" variant="ghost" size="sm" icon="pencil-square" class="text-zinc-400 hover:text-indigo-600" />
                                    
                                    <flux:modal.trigger :name="'delete-' . $post->id">
                                        <flux:button variant="ghost" size="sm" icon="trash" class="text-zinc-400 hover:text-red-500" />
                                    </flux:modal.trigger>

                                    <flux:modal :name="'delete-' . $post->id" class="max-w-xs p-6">
                                        <div class="space-y-4 text-center">
                                            <div class="size-12 bg-red-50 dark:bg-red-950/20 text-red-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                                <flux:icon icon="exclamation-triangle" class="size-6" />
                                            </div>
                                            <flux:heading size="lg" class="font-black tracking-tight">¿Eliminar historia?</flux:heading>
                                            <p class="text-xs text-zinc-500 leading-relaxed">Esta acción no se puede deshacer.</p>
                                            <div class="flex gap-2 pt-2">
                                                <flux:modal.close class="flex-1"><flux:button variant="ghost" size="sm" class="w-full text-[10px] font-bold uppercase tracking-widest">Cancelar</flux:button></flux:modal.close>
                                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="flex-1">
                                                    @csrf @method('DELETE')
                                                    <flux:button type="submit" variant="danger" size="sm" class="w-full text-[10px] font-bold uppercase tracking-widest">Confirmar</flux:button>
                                                </form>
                                            </div>
                                        </div>
                                    </flux:modal>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="5" class="py-16 text-center">
                                <div class="text-zinc-200 mb-2">
                                    <flux:icon icon="newspaper" class="size-10 mx-auto" />
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-zinc-300">No se encontraron artículos</span>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>

            @if($posts->hasPages())
                <div class="px-6 py-4 border-t border-zinc-100 dark:border-zinc-800">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>