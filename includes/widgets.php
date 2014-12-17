<?php

/**
 * FAQz search widget class
 */
class FAQz_Widget_Search extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'faqz-widget-search',
			'description' => __( 'An FAQ search form', 'faqz' )
		);

		parent::__construct( 'faqz_search', __( 'FAQz Search', 'faqz' ), $widget_ops );

	}

	/**
	 * Widget Output
	 *
	 * @param   array  $args      Widget args.
	 * @param   array  $instance  Widget instance args.
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// Search form
		faqz_get_search_form();

		echo $after_widget;

	}

	/**
	 * Widget Admin Form
	 *
	 * @param  array  $instance  Widget instance.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];

		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'faqz' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>

		<?php

	}

	/**
	 * Update Widget Settings
	 *
	 * @param   array  $new_instance  Widget settings.
	 * @param   array  $old_instance  Old widget settings.
	 * @return  array                 Updated widget settings.
	 */
	public function update( $new_instance, $old_instance ) {

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
