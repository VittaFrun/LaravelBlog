<x-layouts::app.sidebar title="Etiquetas">
    <flux:main>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <flux:heading size="xl" class="font-black tracking-tight text-zinc-900 dark:text-white">Etiquetas</flux:heading>
                <flux:subheading class="text-zinc-500 dark:text-zinc-400">Administra las etiquetas para organizar tus publicaciones.</flux:subheading>
            </div>
            
            <flux:button href="{{ route('admin.tags.create') }}" variant="primary" icon="plus" class="bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-500/20">
                Nueva Etiqueta
            </flux:button>
        </div>

        @if (session('info'))
            <flux:card class="mb-6 bg-emerald-50/50 border-emerald-100 dark:bg-emerald-950/10 dark:border-emerald-900/30 flex items-center gap-3">
                <div class="size-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                <span class="text-xs font-medium text-emerald-800 dark:text-emerald-400">{{ session('info') }}</span>
            </flux:card>
        @endif

        <div class="premium-card overflow-hidden">
            @if ($tags->isEmpty())
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="mb-8 size-20 flex items-center justify-center rounded-3xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-100 dark:border-zinc-800">
                        <flux:icon icon="hashtag" class="size-10 text-zinc-300" />
                    </div>
                    <flux:heading size="lg" class="mb-2">Sin etiquetas registradas</flux:heading>
                    <flux:subheading class="max-w-xs mx-auto mb-8">Empieza por crear etiquetas para tus artículos.</flux:subheading>
                    <flux:button href="{{ route('admin.tags.create') }}" variant="primary" icon="plus">
                        Crear mi primera etiqueta
                    </flux:button>
                </div>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column class="pl-10 w-20">#</flux:table.column>
                        <flux:table.column>Nombre</flux:table.column>
                        <flux:table.column class="hidden md:table-cell">Identificador</flux:table.column>
                        <flux:table.column align="end" class="pr-10">Gestionar</flux:table.column>
                    </flux:table.columns>
    
                    <flux:table.rows>
                        @foreach ($tags as $tag)
                            <flux:table.row class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-900/30 transition-colors">
                                <flux:table.cell class="pl-10">
                                    <span class="text-[10px] font-mono text-zinc-400">{{ $loop->iteration }}</span>
                                </flux:table.cell>
                                
                                <flux:table.cell>
                                    <div class="flex items-center gap-4">
                                        <div class="size-10 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/30 dark:text-indigo-400 transition-all group-hover:scale-105 group-hover:shadow-sm">
                                            <flux:icon icon="hashtag" class="size-5" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-zinc-900 dark:text-white">{{ $tag->name }}</span>
                                        </div>
                                    </div>
                                </flux:table.cell>
                                
                                <flux:table.cell class="hidden md:table-cell">
                                    <span class="px-2 py-1 rounded bg-zinc-100 dark:bg-zinc-800 text-[10px] font-mono text-zinc-500 tracking-tight">{{ $tag->slug }}</span>
                                </flux:table.cell>
    
                                <flux:table.cell align="end" class="pr-10">
                                    <div class="flex justify-end gap-1">
                                        <flux:button href="{{ route('admin.tags.edit', $tag) }}" variant="ghost" size="sm" icon="pencil-square" class="hover:bg-zinc-100 dark:hover:bg-zinc-800" />
                                        
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('¿Confirmas que deseas eliminar esta etiqueta?')">
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
    
                @if ($tags->hasPages())
                    <div class="px-10 py-6 border-t border-zinc-100 dark:border-zinc-800 bg-zinc-50/30 dark:bg-zinc-900/30">
                        {{ $tags->links() }}
                    </div>
                @endif
            @endif
        </div>
    </flux:main>
</x-layouts::app.sidebar>
