<?php

function shortcode_yescontent_button($atts)
{
    $default = [
        'url' => '#',
        'target' => '_blank',
        'rel' => 'noreferrer noopener',
        'text' => 'Découvrir l’offre',
    ];
    $a = shortcode_atts($default, $atts);

    return '<div class="is-layout-flex wp-block-buttons">
    <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' .
        $a['url'] .
        '" target="' .
        $a['target'] .
        '" rel="' .
        $a['rel'] .
        '">' .
        $a['text'] .
        '</a>
        </div>
    </div>';
}

add_shortcode('yescontent_button', 'shortcode_yescontent_button');
