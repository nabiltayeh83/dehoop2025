/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
   config.filebrowserBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=flash';
	
   config.extraPlugins = 'youtube';	
   config.youtube_responsive = true;
   config.youtube_related = true;
   config.youtube_autoplay = false;
   config.youtube_older = false;
   config.youtube_privacy = false;
   config.youtube_controls = true;
   config.youtube_width = '400';
   config.youtube_height = '300';
   
  CKEDITOR.editorConfig = function( config ) {
  config.extraPlugins = 'imageuploader';
};
   
}