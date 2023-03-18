<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

function dd($var) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

$code = $_POST['code'];

if(!empty(getenv('DETA_PROJECT_ID')) && !empty(getenv('DETA_PROJECT_KEY'))) {
	$deta = new Deta(getenv('DETA_PROJECT_ID'), getenv('DETA_PROJECT_KEY'));
	$deta->setBase('sandbox');
	$deta->update('history', $code);
}

echo '<div class="script-result">';
$ts = microtime(true);

$response = @eval($code);

$t = sprintf('%f', microtime(true)-$ts);

echo '<div class="script-stats">';
echo 'Script took '.$t.' sec to complete | PHP version: '.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'.'.PHP_RELEASE_VERSION;
echo '</div>';

echo '</div>';

