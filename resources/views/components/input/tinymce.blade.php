<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        setTimeout(() => {
            const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const updateEditorTheme = () => isDarkMode ? 'oxide-dark' : 'oxide';

            tinymce.init({
                target: $refs.tinymce,
                skin: updateEditorTheme(),
                content_css: isDarkMode ? 'dark' : '',
                themes: 'modern',
                height: 200,
                menubar: false,
                branding: false,
                setup: function(editor) {
                    
                    editor.on('blur', function(e) {
                        value = editor.getContent();
                    });

                    editor.on('init', function(e) {
                    if(value !== null   ){
                        editor.setContent(value);
                    }
                    });

                    
                    $watch('value', function(newValue) {
                        if (newValue !== editor.getContent()) {
                            editor.setContent(newValue || '');
                        }
                    });
                }
            });
        }, 500);
    "
    wire:ignore>
    <div>
        <textarea
            x-ref="tinymce"
            {{ $attributes->whereDoesntStartWith('wire:model') }}></textarea>
    </div>
</div>