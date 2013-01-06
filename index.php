<?php

$stations = array(
	'radio1',
	'radio2',
	//'radio3',
	'6music',
);

$artists = array();

foreach ($stations as $station) {
	$url = sprintf('http://www.bbc.co.uk/%s/nowplaying/latest.json', $station);
	$json = file_get_contents($url);
	$data = json_decode($json, true);

	if (!is_array($data) || !is_array($data['nowplaying'])) {
		continue;
	}

	$artist = $data['nowplaying'][0]['artist'];

	if ($artist && !in_array($artist, $artists)) {
		$artists[] = $artist;
	}
}

$url = 'http://git.macropus.org/reco/?';

foreach ($artists as $artist) {
	$url .= '&artist=' . urlencode($artist);
}

header('Location: ' . $url);
