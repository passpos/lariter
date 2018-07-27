
var E = window.wangEditor;
// 一个参数时，编辑菜单和输入框在一块
// 连个参数时，第一个是编辑菜单，第二个是文本框
var editor = new E('#editormenu', '#content');
// 或者 var editor = new E( document.getElementById('editor') )

editor.customConfig.uploadImgServer = '/posts/upload';
editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024;
editor.customConfig.uploadImgMaxLength = 5;
editor.customConfig.uploadImgTimeout = 3000;
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};
editor.create();



