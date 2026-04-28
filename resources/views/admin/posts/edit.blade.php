<x-layouts::app :title="__('Editar Post')">
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="premium-card-compact p-6 space-y-6">
            <!-- Header Compact -->
            <div class="flex items-center justify-between border-b border-zinc-100 dark:border-zinc-800 pb-4">
                <flux:heading size="md" class="font-black">Editar: {{ $post->title }}</flux:heading>
                <flux:button href="{{ route('admin.posts.index') }}" variant="ghost" size="xs" icon="x-mark" />
            </div>

            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ useUrl: {{ str_starts_with($post->img_path, 'http') ? 'true' : 'false' }}, preview: '{{ $post->image_url }}' }">
                @csrf
                @method('PUT')

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:input name="title" label="Título" value="{{ old('title', $post->title) }}" placeholder="..." required size="sm" />
                    <flux:select name="category_id" label="Categoría" size="sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </flux:select>
                </div>

                <flux:textarea name="excerpt" label="Extracto" rows="1" placeholder="Resumen corto..." size="sm">{{ old('excerpt', $post->excerpt) }}</flux:textarea>
                
                <x-quill-editor name="content" label="Contenido" :value="old('content', $post->content)" />

                <!-- Tags Selection -->
                <div class="space-y-3 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                    <flux:label class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Etiquetas</flux:label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900 cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }} class="rounded border-zinc-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-xs font-medium text-zinc-700 dark:text-zinc-300">#{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Image Selector Compact -->
                <div class="space-y-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center justify-between">
                        <flux:label class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Imagen de Portada</flux:label>
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
                                            <span class="text-[9px] uppercase font-black">Actualizar Imagen</span>
                                        </div>
                                    </flux:button>
                                </div>
                            </template>

                            <template x-if="useUrl">
                                <flux:input name="img_path_url" placeholder="Pegar URL de la imagen aquí..." @input="preview = $event.target.value" value="{{ str_starts_with($post->img_path, 'http') ? $post->img_path : '' }}" size="sm" />
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-4">
                        <flux:checkbox name="is_published" :checked="$post->is_published" label="Visible" class="scale-90" />
                    </div>
                    <flux:button type="submit" variant="primary" size="sm" class="premium-gradient border-none px-8 text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/20">
                        Guardar Cambios
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>