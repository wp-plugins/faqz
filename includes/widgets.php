<?php

/**
 * FAQz search widget class
 */
class FAQz_Widget_Search extends WP_Widget {

	function __construct() {
		$widget_ops = array(	
			'classname'   => 'faqz-widget-search',
			'description' => __( 'An FAQ search form', 'faqz' )
		);
		parent::__construct( 'faqz_search', __( 'FAQz Search', 'faqz' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		// Use current theme search form if it exists
		faq_get_search_form();

		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'faqz' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '' ) );
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

}

/**
 * Register FAQz widgets.
 */
function faqz_widgets_init() {
	register_widget( 'FAQz_Widget_Search' );
}

add_action( 'widgets_init', 'faqz_widgets_init' );

?>