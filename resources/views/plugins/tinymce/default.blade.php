<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea.bodyfield',
        heigth: 300,
        menubar: false,
        statusbar: false,
        plugins: ['link', 'table', 'image', 'autoresize', 'lists'],
        toolbar: 'undo redo | bold italic backcolor | alignleft aligncenter alignright alignjustify ',
        content_css: [
            '{{ asset('assets/css/content.css') }}'
        ],
        images_upload_credentials: false,
        convert_urls: false,
    });
</script>

<style>
    .tox-notifications-container {
        display: none !important;
    }
</style>
