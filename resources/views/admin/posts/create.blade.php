<x-layouts::app :title="__('Nueva Historia')">
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="premium-card-compact p-6 space-y-6">
            <!-- Header Compact -->
            <div class="flex items-center justify-between border-b border-zinc-100 dark:border-zinc-800 pb-4">
                <flux:heading size="md" class="font-black">Nueva Historia</flux:heading>
                <flux:button href="{{ route('admin.posts.index') }}" variant="ghost" size="xs" icon="x-mark" />
            </div>

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ useUrl: false, preview: '' }">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:field>
                        <flux:label>Título</flux:label>
                        <flux:input name="title" placeholder="..." required size="sm" id="title-input" />
                        <flux:error name="title" />
                    </flux:field>
                    
                    <flux:field>
                        <flux:label>Categoría</flux:label>
                        <flux:select name="category_id" size="sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="category_id" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:field>
                        <flux:label>URL (Slug)</flux:label>
                        <flux:input name="slug" placeholder="url-del-post" size="sm" id="slug-input" />
                        <flux:error name="slug" />
                    </flux:field>
                    
                    <flux:field>
                        <flux:label>Fecha Programada</flux:label>
                        <flux:input type="datetime-local" name="published_at" size="sm" value="{{ now()->format('Y-m-d\TH:i') }}" />
                        <flux:error name="published_at" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Extracto</flux:label>
                    <flux:textarea name="excerpt" rows="1" placeholder="Resumen corto..." size="sm" />
                    <flux:error name="excerpt" />
                </flux:field>

                <flux:field>
                    <flux:label>Contenido</flux:label>
                    <flux:textarea name="content" rows="6" placeholder="Escribe aquí..." size="sm" />
                    <flux:error name="content" />
                </flux:field>

                <!-- Image Selector Compact -->
                <div class="space-y-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center justify-between">
                        <flux:label class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Portada del Post</flux:label>
                        <div class="flex p-0.5 bg-zinc-100 dark:bg-zinc-800 rounded-md">
                            <button type="button" @click="useUrl = false" :class="!useUrl ? 'bg-white dark:bg-zinc-700 shadow-xs' : ''" class="px-2 py-0.5 text-[8px] font-bold uppercase rounded-sm transition-all">Upload</button>
                            <button type="button" @click="useUrl = true" :class="useUrl ? 'bg-white dark:bg-zinc-700 shadow-xs' : ''" class="px-2 py-0.5 text-[8px] font-bold uppercase rounded-sm transition-all">URL</button>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="size-20 bg-zinc-50 dark:bg-zinc-900 rounded-lg flex items-center justify-center border border-zinc-100 dark:border-zinc-800 shrink-0 overflow-hidden">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <flux:icon icon="photo" class="size-6 text-zinc-300" />
                            </template>
                        </div>

                        <div class="flex-1">
                            <template x-if="!useUrl">
                                <div class="flex items-center gap-3">
                                    <input type="file" name="image" id="image-upload" class="hidden" accept="image/*" @change="let reader = new FileReader(); reader.onload = (e) => { preview = e.target.result }; reader.readAsDataURL($event.target.files[0])">
                                    <flux:button onclick="document.getElementById('image-upload').click()" variant="ghost" size="xs" class="border-zinc-200">
                                        <div class="flex items-center gap-2">
                                            <flux:icon icon="arrow-up-tray" class="size-3" />
                                            <span class="text-[9px] uppercase font-black">Elegir Archivo</span>
                                        </div>
                                    </flux:button>
                                    <span class="text-[9px] text-zinc-400">JPG/PNG máx 2MB</span>
                                </div>
                            </template>

                            <template x-if="useUrl">
                                <flux:input name="img_path_url" placeholder="Pegar URL de la imagen aquí..." @input="preview = $event.target.value" size="sm" />
                            </template>
                            <flux:error name="image" />
                            <flux:error name="img_path_url" />
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <flux:checkbox name="is_published" label="Publicar" class="scale-90" />
                    <flux:button type="submit" variant="primary" size="sm" class="premium-gradient border-none px-8 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/20">
                        Crear Post
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>