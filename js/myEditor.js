/********************** KindEditor ***********************/
KindEditor.ready(function (K) {
    window.editor = K.create('#editor_1', {
        cssPath: '../plugins/code/prettify.css',
        uploadJson: '/posts/upload',
        fileManagerJson: '../php/file_manager_json.php',
        allowFileManager: true
    });
});