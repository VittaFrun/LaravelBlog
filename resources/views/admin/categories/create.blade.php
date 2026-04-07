<x-layouts::app :title="__('Nueva Categoría')">
    <div class="max-w-md mx-auto py-12 px-4">
        <div class="premium-card-compact p-8 space-y-6">
            <div class="flex items-center justify-between border-b border-zinc-100 dark:border-zinc-800 pb-4">
                <flux:heading size="md" class="font-black">Nueva Categoría</flux:heading>
                <flux:button href="{{ route('admin.categories.index') }}" variant="ghost" size="xs" icon="x-mark" />
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <flux:field>
                    <flux:label>Nombre</flux:label>
                    <flux:input name="name" placeholder="Ej. Tecnología" required id="name-input" size="sm" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Slug (Identificador)</flux:label>
                    <flux:input name="slug" placeholder="tecnologia" required id="slug-input" size="sm" />
                    <flux:error name="slug" />
                </flux:field>

                <div class="pt-4 flex justify-end">
                    <flux:button type="submit" variant="primary" size="sm" class="premium-gradient border-none px-8 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/20">
                        Crear Categoría
                    </flux:button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('name-input').addEventListener('input', function() {
            document.getElementById('slug-input').value = this.value
                .toLowerCase()
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        });
    </script>
</x-layouts::app>