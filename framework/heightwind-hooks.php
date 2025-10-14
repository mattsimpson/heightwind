<?php
/**
 * HeightWind Hooks
 * Action hooks used in the HeightWind theme
 * @package heightwind
 * @since 2.0.0
 */


/**
 * HeightWind before html action
 * @since 2.0.0
 */
function heightwind_html_before() {
    do_action( 'heightwind_html_before' );
    tha_html_before();
}


/**
 * HeightWind body top action
 * @since 2.0.0
 */
function heightwind_body_top() {
    do_action( 'heightwind_body_top' );
    tha_body_top();
}


/**
 * HeightWind body bottom action
 * @since 2.0.0
 */
function heightwind_body_bottom() {
    do_action( 'heightwind_body_bottom' );
    tha_body_bottom();
}


/**
 * HeightWind head top action
 * @since 2.0.0
 */
function heightwind_head_top() {
    do_action( 'heightwind_head_top' );
    tha_head_top();
}


/**
 * HeightWind head bottom action
 * @since 2.0.0
 */
function heightwind_head_bottom() {
    do_action( 'heightwind_head_bottom' );
    tha_head_bottom();
}


/**
 * HeightWind before header wrapper action
 * @since 2.0.0
 */
function heightwind_header_before() {
    do_action( 'heightwind_header_before' );
    tha_header_before();
}


/**
 * HeightWind after header wrapper action
 * @since 2.0.0
 */
function heightwind_header_after() {
    do_action( 'heightwind_header_after' );
    tha_header_after();
}


/**
 * HeightWind header action
 * @since 2.0.0
 */
function heightwind_header() {
	tha_header_top();
    do_action( 'heightwind_header' );
    tha_header_bottom();
}


/**
 * HeightWind before content wrapper action
 * @since 2.0.0
 */
function heightwind_content_before() {
    do_action( 'heightwind_content_before' );
    tha_content_before();
}


/**
 * HeightWind after content wrapper action
 * @since 2.0.0
 */
function heightwind_content_after() {
    do_action( 'heightwind_content_after' );
    tha_content_after();
}


/**
 * HeightWind before content action
 * @since 2.0.0
 */
function heightwind_content_top() {
    do_action( 'heightwind_content_top' );
    tha_content_top();
}


/**
 * HeightWind after content action
 * @since 2.0.0
 */
function heightwind_content_bottom() {
    do_action( 'heightwind_content_bottom' );
    tha_content_bottom();
}


/**
 * HeightWind content header top action
 * @since 2.0.0
 */
function heightwind_content_header_top() {
    do_action( 'heightwind_content_header_top' );
}


/**
 * HeightWind content header bottom action
 * @since 2.0.0
 */
function heightwind_content_header_bottom() {
    do_action( 'heightwind_content_header_bottom' );
}


/**
 * HeightWind content entry top action
 * @since 2.0.0
 */
function heightwind_content_entry_top() {
    do_action( 'heightwind_content_entry_top' );
}


/**
 * HeightWind content entry bottom action
 * @since 2.0.0
 */
function heightwind_content_entry_bottom() {
    do_action( 'heightwind_content_entry_bottom' );
}


/**
 * HeightWind before entry wrapper action
 * @since 2.0.0
 */
function heightwind_entry_before() {
    do_action( 'heightwind_entry_before' );
    tha_entry_before();
}


/**
 * HeightWind after entry wrapper action
 * @since 2.0.0
 */
function heightwind_entry_after() {
    do_action( 'heightwind_entry_after' );
    tha_entry_after();
}


/**
 * HeightWind entry top action
 * @since 2.0.0
 */
function heightwind_entry_top() {
    do_action( 'heightwind_entry_top' );
    tha_entry_top();
}


/**
 * HeightWind entry bottom action
 * @since 2.0.0
 */
function heightwind_entry_bottom() {
    do_action( 'heightwind_entry_bottom' );
    tha_entry_bottom();
}


/**
 * HeightWind before comments action
 * @since 2.0.0
 */
function heightwind_comments_before() {
    do_action( 'heightwind_comments_before' );
    tha_comments_before();
}


/**
 * HeightWind after comments wrapper action
 * @since 2.0.0
 */
function heightwind_comments_after() {
    do_action( 'heightwind_comments_after' );
    tha_comments_after();
}


/**
 * HeightWind before sidebar action
 * @since 2.0.0
 */
function heightwind_sidebar_before() {
    do_action( 'heightwind_sidebar_before' );
    tha_sidebars_before();
}


/**
 * HeightWind after sidebar wrapper action
 * @since 2.0.0
 */
function heightwind_sidebar_after() {
    do_action( 'heightwind_sidebar_after' );
    tha_sidebars_after();
}


/**
 * HeightWind sidebar top
 * @since 2.0.0
 */
function heightwind_sidebar_top() {
    do_action( 'heightwind_sidebar_top' );
    tha_sidebar_top();
}


/**
 * HeightWind sidebar bottom
 * @since 2.0.0
 */
function heightwind_sidebar_bottom() {
    do_action( 'heightwind_sidebar_bottom' );
    tha_sidebar_bottom();
}


/**
 * HeightWind before footer wrapper action
 * @since 2.0.0
 */
function heightwind_footer_before() {
    do_action( 'heightwind_footer_before' );
    tha_footer_before();
}


/**
 * HeightWind after footer wrapper action
 * @since 2.0.0
 */
function heightwind_footer_after() {
    do_action( 'heightwind_footer_after' );
    tha_footer_after();
}


/**
 * HeightWind footer action
 * @since 2.0.0
 */
function heightwind_footer() {
	tha_footer_top();
    do_action( 'heightwind_footer' );
    tha_footer_bottom();
}
