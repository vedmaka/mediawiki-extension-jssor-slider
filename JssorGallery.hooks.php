<?php

class JssorGalleryHooks {

    public static function onExtensionLoad() {

    }
    
    public static function onBeforePageDisplay( $out ) {
        return true;
    }

	/**
	 * @param Parser $parser
	 *
	 * @return bool
	 */
    public static function onParserFirstCallInit( $parser ) {
        $parser->setHook('jssorgallery', 'JssorGallery::render');
        return true;
    }
    
}