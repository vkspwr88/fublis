<?php

return [
	'wordMimes' => 'mimes:pdf,doc,docx,txt,odt,zip',
	'imageMimes' => 'mimes:svg,png,jpg,jpeg,gif',
	'zipPlusImageMimes' => 'mimes:svg,png,jpg,jpeg,gif,zip',
	'coverImage' => 'required|image|max:3100|dimensions:max_width=800,max_height=400',
	'bulkFilesSize' => 'max:4200',
	'mediaKitBriefCharacters' => 'max:550',

	'profileImage' => 'nullable|image|max:3100|dimensions:max_width=400,max_height=400,ratio=1/1',
];
