<?php

return [
	'wordFormat' => 'extensions:pdf,doc,docx,txt,odt,zip',
	'wordMimes' => 'mimes:pdf,doc,docx,txt,odt,zip',
	'imageFormat' => 'extensions:svg,png,jpg,jpeg,gif,webp',
	'imageMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp',
	'zipPlusImageFormat' => 'extensions:svg,png,jpg,jpeg,gif,webp,zip',
	'zipPlusImageMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp,zip',
	'zipPlusFileFormat' => 'extensions:svg,png,jpg,jpeg,gif,webp,pdf,doc,docx,txt,odt,zip',
	'zipPlusFileMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp,pdf,doc,docx,txt,odt,zip',
	'coverImage' => 'required|image|max:3100|dimensions:max_width=800,max_height=400',
	'bulkFilesSize' => 'max:42000',
	'mediaKitBriefCharacters' => 'max:550',

	'profileImage' => 'nullable|image|max:3100|dimensions:max_width=400,max_height=400,ratio=1/1',
];
