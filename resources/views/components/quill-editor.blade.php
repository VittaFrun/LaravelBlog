@props(['name', 'value' => '', 'label' => null])

<div class="space-y-2" 
     x-data="{ 
        content: @js($value),
        initQuill() {
            const quill = new Quill($refs.editor, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            quill.on('text-change', () => {
                this.content = quill.root.innerHTML;
            });
        }
     }" 
     x-init="initQuill">
    
    @if($label)
        <flux:label>{{ $label }}</flux:label>
    @endif

    <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-900">
        <div x-ref="editor" class="min-h-[200px] text-zinc-900 dark:text-zinc-100">
            {!! $value !!}
        </div>
    </div>

    <input type="hidden" name="{{ $name }}" :value="content">

    @pushonce('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            .ql-toolbar {
                border-top: none !important;
                border-left: none !important;
                border-right: none !important;
                border-bottom: 1px solid #e5e7eb !important;
                background: #f9fafb !important;
                border-radius: 0.5rem 0.5rem 0 0 !important;
            }
            .dark .ql-toolbar {
                background: #18181b !important;
                border-bottom: 1px solid #3f3f46 !important;
            }
            .ql-container {
                border: none !important;
                font-family: inherit !important;
                font-size: 0.875rem !important;
            }
            .dark .ql-snow .ql-stroke { stroke: #d4d4d8 !important; }
            .dark .ql-snow .ql-fill { fill: #d4d4d8 !important; }
            .dark .ql-snow .ql-picker { color: #d4d4d8 !important; }
            .dark .ql-snow .ql-picker-options { background-color: #18181b !important; border: 1px solid #3f3f46 !important; }
        </style>
    @endpushonce

    @pushonce('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    @endpushonce
</div>
