/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
var base_url_cke = "http://" + document.location.hostname + "/j-office/assets/ckeditor/";
CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.height = '500px';
    config.filebrowserBrowseUrl = base_url_cke + 'filemanager/index.html';
    config.filebrowserImageBrowseUrl = base_url_cke + 'filemanager/index.html?Type=Images';
    config.filebrowserFlashBrowseUrl = base_url_cke + 'filemanager/index.html?Type=Flash';
    config.filebrowserUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Flash';
};
