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

	    $i = 0;
	    foreach ( $images as $image ) {
		    $file = wfLocalFile( Title::newFromText( $image, NS_FILE ) );
		    if ( $file && $file->exists() ) {
			    $file->getFullUrl();
		        $slidesHtml .=
		        '<div data-p="144.50" style="'.(($i > 0) ? "display: none;" : '').'">
                	<img data-u="image" src="'.$file->getFullUrl().'" />
                	<img data-u="thumb" src="'.$file->createThumb(72).'" />
            	</div>';
		        $i++;
		    }
	    }
        
        $parser->getOutput()->addModules('ext.jssorgallery.foo');

	    $sliderHeight = 365;
	    if( array_key_exists('height', $args) ) {
	    	$sliderHeight = $args['height'];
	    }
	    $sliderHeightContainer = $sliderHeight + 100;
	    $sliderWidth = 800;
	    if( array_key_exists('width', $args) ) {
		    $sliderWidth = $args['width'];
	    }

        $template = file_get_contents(dirname(__FILE__).'/templates/default.mustache');
        $template = str_replace('{{ img_path }}', $wgScriptPath.'/extensions/JssorGallery/modules/', $template);
        $template = str_replace('{{ slides }}', $slidesHtml, $template);
        $template = str_replace('{{ height }}', $sliderHeight, $template);
        $template = str_replace('{{ height_container }}', $sliderHeightContainer, $template);
        $template = str_replace('{{ width }}', $sliderWidth, $template);

        $html .= $parser->insertStripItem($template);
        
        return array(
                $html,
                'markerType' => 'nowiki'
            );
    }
    
}