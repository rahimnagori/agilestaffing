<script src="https://cdn.tiny.cloud/1/<?=$this->config->item("TINYKEY");?>/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
tinymce.init({
    menubar: false,
    branding: false,
    statusbar: false,
    selector: '.textarea',
    height: 200,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});

function update_tiny(textarea_selector) {
    tinymce.init({
        menubar: false,
        branding: false,
        statusbar: false,
        selector: '.' + textarea_selector,
        height: 200,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
}

function update_editor(text) {
    const testContent = tinymce.activeEditor.insertContent(text);
}
</script>