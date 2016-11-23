<?php

class JssorGallery {
    
    public static function render( $input, array $args, Parser $parser, PPFrame $frame ) {

    	global $wgScriptPath;

    	if( empty($input) ) {
    		return 'JssorGallery: error, no input provided.';
	    }

	    $html = '';
    	$slidesHtml = '';

	    $images = explode("\n", trim($input));
	    foreach ( $images as $image ) {
		    $file = wfLocalFile( Title::newFromText( $image, NS_FILE ) );
		    if ( $file && $file->exists() ) {
			    $file->getFullUrl();
		        $slidesHtml .=
		        '<div data-p="144.50">
                	<img data-u="image" src="'.$file->getFullUrl().'" />
                	<img data-u="thumb" src="'.$file->createThumb(72).'" />
            	</div>';

		    }
	    }
        
        $parser->getOutput()->addModules('ext.jssorgallery.foo');
        
        $template = file_get_contents(dirname(__FILE__).'/templates/default.mustache');
        $template = str_replace('{{ img_path }}', $wgScriptPath.'/extensions/JssorGallery/modules/', $template);
        $template = str_replace('{{ slides }}', $slidesHtml, $template);

        $html .= $parser->insertStripItem($template);
        
        return array(
                $html,
                'markerType' => 'nowiki'
            );
    }
    
}