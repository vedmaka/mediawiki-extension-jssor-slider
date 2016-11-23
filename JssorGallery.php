<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( version_compare( $wgVersion, '1.17', '<' ) ) {
	die( '<b>Error:</b> This version of NatureSlider requires MediaWiki 1.17 or above.' );
}

$wgJssorGalleryDir = dirname( __FILE__ );

$wgAutoloadClasses['JssorGallery'] = $wgJssorGalleryDir . '/JssorGallery.class.php';
$wgAutoloadClasses['JssorGalleryHooks'] = $wgJssorGalleryDir . '/JssorGallery.hooks.php';
$wgExtensionMessagesFiles['JssorGalleryMagic'] = $wgJssorGalleryDir . '/JssorGallery.i18n.alias.php';

/* Credits page */
$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'JssorGallery',
	'version' => '0.1',
	'author' => 'Jon',
	'url' => '',
	'descriptionmsg' => 'jssorgallery-desc'
);

/* Resource modules */
$wgResourceModules['ext.jssorgallery.foo'] = array(
	'localBasePath' => dirname( __FILE__ ) . '/',
	'remoteExtPath' => 'JssorGallery/',
	'group' => 'ext.JssorGallery',
	'scripts' => array(
		"modules/jssor.slider-21.1.6.min.js",
		"modules/script.js"
	),
	'styles' => array(
		"modules/style.css"
	)
);

$wgHooks['BeforePageDisplay'][] = 'JssorGalleryHooks::onBeforePageDisplay';
$wgHooks['ParserFirstCallInit'][] = 'JssorGalleryHooks::onParserFirstCallInit';