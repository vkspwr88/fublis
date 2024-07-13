<?php

return [
	'wordMimes' => 'mimes:pdf,doc,docx,txt,odt,zip',
	'imageMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp',
	'zipPlusImageMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp,zip',
	'zipPlusFileMimes' => 'mimes:svg,png,jpg,jpeg,gif,webp,pdf,doc,docx,txt,odt,zip',
	'coverImage' => 'required|image|max:3100|dimensions:max_width=800,max_height=400',
	'bulkFilesSize' => 'max:42000',
	'mediaKitBriefCharacters' => 'max:550',

	'profileImage' => 'nullable|image|max:3100|dimensions:max_width=400,max_height=400,ratio=1/1',
];
