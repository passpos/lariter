/**
 * KindEditor
 * 
 * 创建编辑器时下面的配置也适用于NKEditor。
 */
KindEditor.ready(function (K) {
    window.editor = K.create('#editor_1', {
        cssPath: '../plugins/code/prettify.css',
        uploadJson: '/posts/upload',
        fileManagerJson: '../php/file_manager_json.php',
        allowFileManager: true,
        afterCreate: function () {
            var self = this;
            K.ctrl(document, 13, function () {
                self.sync();
                K('form[name=example]')[0].submit();
            });
            K.ctrl(self.edit.doc, 13, function () {
                self.sync();
                K('form[name=example]')[0].submit();
            });
        }
    });
    prettyPrint();
});

/**
 * NKEditor
 */
