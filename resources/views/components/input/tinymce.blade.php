<div
    x-data="{ 
    value: @entangle($attributes->wire('model')),
    isDarkMode: window.matchMedia('(prefers-color-scheme: dark)').matches
     }"
    x-init="
        const updateEditorTheme = () => isDarkMode ? 'oxide-dark' : 'oxide';

        tinymce.init({
            target: $refs.tinymce,
            themes: 'modern',
            height: 200,
            menubar: false,
            branding: false,
            skin: updateEditorTheme(),
            content_css: isDarkMode ? 'dark' : '',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })
                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })
                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }
                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            }
        })
    "
    wire:ignore
>
    <div>
        <input
            class="dark:bg-neutral-900"
            x-ref="tinymce"
            type="textarea"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
</div>
