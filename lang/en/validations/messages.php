<?php

$image = 'svg, png, jpg, jpeg, gif, webp, tif';
$doc = 'pdf, doc, docx, txt, odt';

return [
	'wordMimes' => 'The :attribute supports only ' . $doc . ' or zip format.',
	'image' => 'The :attribute supports only image.',
	'imageMimes' => 'The :attribute supports only ' . $image . '.',
	'zipPlusImageMimes' => 'The :attribute supports only ' . $image . ' or zip.',
	'coverImage' => [
		'max' => 'Maximum allowed size to upload :attribute 3MB.',
		'dimensions' => 'Maximum allowed dimension for the :attribute is 800x400px.',
	],
	'bulkFilesSize' => 'Maximum allowed size to upload :attribute is 40MB.',
	'mediaKitBriefCharacters' => 'The :attribute allows only 550 characters.',

	'profileImage' => [
		'max' => 'Maximum allowed size to upload :attribute 3MB.',
		'dimensions' => 'Maximum allowed dimension for the :attribute is 400x400px.',
	],

];
