<?php

$image = 'svg,png,jpg,jpeg,gif,webp';
$doc = 'pdf,doc,docx,txt,odt';

return [
	'wordFormat' => 'extensions:' . $doc . ',zip',
	'wordMimes' => 'mimes:' . $doc . ',zip',
	'imageFormat' => 'extensions:' . $image . '',
	'imageMimes' => 'mimes:' . $image . '',
	'zipPlusImageFormat' => 'extensions:' . $image . ',zip',
	'zipPlusImageMimes' => 'mimes:' . $image . ',zip',
	'zipPlusFileFormat' => 'extensions:' . $image . ',' . $doc . ',zip',
	'zipPlusFileMimes' => 'mimes:' . $image . ',' . $doc . ',zip',
	'coverImage' => 'required|image|max:3100|dimensions:max_width=800,max_height=400',
	'bulkFilesSize' => 'max:42000',
	'mediaKitBriefCharacters' => 'max:550',

	'profileImage' => 'nullable|image|max:3100|dimensions:max_width=400,max_height=400,ratio=1/1',
];
