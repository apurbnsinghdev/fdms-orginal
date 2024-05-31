<?php

return [
	'mode' => 'utf-8',
	'format' => 'A4',
	'author' => '',
	'subject' => '',
	'keywords' => '',
	'creator' => 'mipellim',
	'display_mode' => 'fullpage',
	'tempDir' => storage_path('fonts/'),
	'font_path' => public_path('fonts/'),
	'font_data' => [
		'bangla' => [
			'R' => 'SolaimanLipi.ttf', // regular font
			'B' => 'SolaimanLipi.ttf', // optional: bold font
			'I' => 'SolaimanLipi.ttf', // optional: italic font
			'BI' => 'SolaimanLipi.ttf', // optional: bold-italic font
			'useOTL' => 0xFF, // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75, // required for complicated langs like Persian, Arabic and Chinese
		],
		'bangla-bold' => [
			'R' => 'SolaimanLipi_Bold.ttf', // regular font
			'B' => 'SolaimanLipi_Bold.ttf', // optional: bold font
			'I' => 'SolaimanLipi_Bold.ttf', // optional: italic font
			'BI' => 'SolaimanLipi_Bold.ttf', // optional: bold-italic font
			'useOTL' => 0xFF, // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75, // required for complicated langs like Persian, Arabic and Chinese
		],
		'english' => [
			'R' => 'roboto.ttf', // regular font
			'B' => 'roboto.ttf', // optional: bold font
			'I' => 'roboto.ttf', // optional: italic font
			'BI' => 'roboto.ttf', // optional: bold-italic font
			'useOTL' => 0xFF, // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75, // required for complicated langs like Persian, Arabic and Chinese
		],
		// ...add as many as you want.
	],
];