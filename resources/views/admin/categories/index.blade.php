<x-layouts::app.sidebar title="Categorías">
    <flux:main>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <flux:heading size="xl" class="font-black tracking-tight text-zinc-900 dark:text-white">Categorías</flux:heading>
                <flux:subheading class="text-zinc-500 dark:text-zinc-400">Organiza y segmenta el contenido de tu blog con etiquetas descriptivas.</flux:subheading>
            </div>
            
            <flux:button href="{{ route('admin.categories.create') }}" variant="primary" icon="plus" class="bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-500/20">
                Nueva Categoría
            </flux:button>
        </div>

        @if (session('info'))
            <flux:card class="mb-6 bg-emerald-50/50 border-emerald-100 dark:bg-emerald-950/10 dark:border-emerald-900/30 flex items-center gap-3">
                <div class="size-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                <span class="text-xs font-medium text-emerald-800 dark:text-emerald-400">{{ session('info') }}</span>
            </flux:card>
        @endif

        <div class="premium-card overflow-hidden">
            @if ($categories->isEmpty())
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="mb-8 size-20 flex items-center justify-center rounded-3xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-100 dark:border-zinc-800">
                        <flux:icon icon="tag" class="size-10 text-zinc-300" />
                    </div>
                    <flux:heading size="lg" class="mb-2">Sin categorías registradas</flux:heading>
                    <flux:subheading class="max-w-xs mx-auto mb-8">Empieza por crear una clasificación para tus artículos de blog.</flux:subheading>
                    <flux:button href="{{ route('admin.categories.create') }}" variant="primary" icon="plus">
                        Crear mi primera categoría
                    </flux:button>
                </div>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column class="pl-10 w-20">#</flux:table.column>
                        <flux:table.column>Nombre</flux:table.column>
                        <flux:table.column class="hidden md:table-cell">Identificador</flux:table.column>
                        <flux:table.column class="text-center">Artículos</flux:table.column>
                        <flux:table.column align="end" class="pr-10">Gestionar</flux:table.column>
                    </flux:table.columns>
    
                    <flux:table.rows>
                        @foreach ($categories as $category)
                            <flux:table.row class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-900/30 transition-colors">
                                <flux:table.cell class="pl-10">
                                    <span class="text-[10px] font-mono text-zinc-400">0{{ $loop->iteration }}</span>
                                </flux:table.cell>
                                
                                <flux:table.cell>
                                    <div class="flex items-center gap-4">
                                        <div class="size-10 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/30 dark:text-indigo-400 transition-all group-hover:scale-105 group-hover:shadow-sm">
                                            <flux:icon icon="tag" class="size-5" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-zinc-900 dark:text-white">{{ $category->name }}</span>
                                            <span class="text-[10px] text-zinc-400 uppercase tracking-widest font-medium">Categoría Activa</span>
                                        </div>
                                    </div>
                                </flux:table.cell>
                                
                                <flux:table.cell class="hidden md:table-cell">
                                    <span class="px-2 py-1 rounded bg-zinc-100 dark:bg-zinc-800 text-[10px] font-mono text-zinc-500 tracking-tight">/{{ $category->slug }}</span>
                                </flux:table.cell>
    
                                <flux:table.cell>
                                    <div class="flex flex-col items-center">
                                        <span class="text-sm font-black text-zinc-700 dark:text-zinc-300">{{ $category->posts_count ?? $category->posts()->count() }}</span>
                                        <span class="text-[8px] text-zinc-400 uppercase font-black tracking-tighter mt-0.5">Posts</span>
                                    </div>
                                </flux:table.cell>
                                
                                <flux:table.cell align="end" class="pr-10">
                                    <div class="flex justify-end gap-1">
                                        <flux:button href="{{ route('admin.categories.edit', $category) }}" variant="ghost" size="sm" icon="pencil-square" class="hover:bg-zinc-100 dark:hover:bg-zinc-800" />
                                        
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Confirmas que deseas eliminar esta categoría?')">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" variant="ghost" size="sm" icon="trash" color="red" class="hover:bg-red-50 dark:hover:bg-red-950/30 text-red-500" />
                                        </form>
                                    </div>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
    
                @if ($categories->hasPages())
                    <div class="px-10 py-6 border-t border-zinc-100 dark:border-zinc-800 bg-zinc-50/30 dark:bg-zinc-900/30">
                        {{ $categories->links() }}
                    </div>
                @endif
            @endif
        </div>
    </flux:main>
</x-layouts::app.sidebar>
app.sidebar>