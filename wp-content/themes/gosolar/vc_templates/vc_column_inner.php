<?php
/**
 * @var $width
$width = wpb_translateColumnWidthToSpan( $width );
$css_classes = array(
if ( vc_shortcode_custom_css_has_property( $css, array(
	'background',
	$css_classes[] = 'vc_col-has-fill';
// Custom Typography
// Custom Background Style
// Animation
$wrapper_attributes = array();
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';