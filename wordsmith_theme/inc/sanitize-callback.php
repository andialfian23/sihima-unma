<?php

function wordsmith_sanitize_choice($input, $settings){
    
    $input = sanitize_key( $input );

		$choices = $settings->manager->get_control($settings->id)->choices;

		return(array_key_exists($input, $choices) ? $input:$settings->default);
}

?>