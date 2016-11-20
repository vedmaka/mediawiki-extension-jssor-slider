<?php

class JssorGallery {
    
    public static function render( $input, array $args, Parser $parser, PPFrame $frame ) {
        $html = '';
        
        $parser->getOutput()->addModules('ext.jssorgallery.foo');
        
        $template = file_get_contents(dirname(__FILE__).'/templates/default.mustache');
        $template = str_replace('{{ img_path }}', '/extensions/JssorGallery/modules/', $template);
        
        $html .= $parser->insertStripItem($template);
        
        return array(
                $html,
                'markerType' => 'nowiki'
            );
    }
    
}