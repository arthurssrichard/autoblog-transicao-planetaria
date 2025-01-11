@extends('layouts.admin')
@section('title','Novo post')
@section('content')
<main>
  <livewire:create-post :title="$title" :slug="$slug" :mensagem="$mensagem" :category_id="$category_id ?? null" :tags="$tags ?? null" :date="$date ?? null" :time="$time ?? null" :image="$imagePath ?? null" :post_id="$postId ?? null" />
</main>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<!-- <script>
  const initTinyMCE = () => {
    const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const updateEditorTheme = () => isDarkMode ? 'oxide-dark' : 'oxide';

    tinymce.init({
      selector: 'textarea#menubar',
      skin: updateEditorTheme(),
      content_css: isDarkMode ? 'dark' : '',
      promotion: false,
      height: 200,
      menubar: 'file edit view',
      branding: false,

      setup: function(editor) {
        editor.on('init change', function() {
          editor.save();
        });
      },
    });
  };
</script> -->
@endsection