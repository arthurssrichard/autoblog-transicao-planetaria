@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main class="container mx-auto px-5 flex flex-grow">
    <div class="mb-10">
        <h2 class="mt-16 mb-5 text-3xl text-yellow-900 font-bold">Novo post</h2>
        <form action="/posts" method="POST">
            @csrf
            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border"
                value="{{isset($title) ? $title : ''}}">
            </div>
            <div>
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="bg-gray-50 border"
                value="{{isset($slug) ? $slug : ''}}">
            </div>
            <textarea name="body">
              @if(isset($mensagem))
                {{$mensagem}}
              @endif
            </textarea>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Adicionar</button>
        </form>
    </div>

</main>
<script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_API_KEY')}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    branding: false,
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Dec 22, 2024:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      // Early access to document converters
      'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    content_style: 'body {text-align: justify;',
    language: 'pt_BR',
    language_url: 'js/tinymce/langs/pt_BR.js',
    browser_spellcheck: true,
    spellchecker_language: 'pt_BR'
  });
</script>
@endsection