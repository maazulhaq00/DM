<?php
/**
 * Register a menu metabox.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

if ( boombox_plugin_management_service()->is_plugin_active( 'buddypress/bp-loader.php' ) ) {
	return;
}

class Boombox_Walker_Nav_Menu_Checklist extends Walker_Nav_Menu {

	/**
	 * Constructor.
	 *
	 * @see Walker_Nav_Menu::__construct() for a description of parameters.
	 *
	 * @param array|bool $fields See {@link Walker_Nav_Menu::__construct()}.
	 */
	public function __construct( $fields = false ) {
		if ( $fields ) {
			$this->db_fields = $fields;
		}
	}

	/**
	 * Create the markup to start a tree level.
	 *
	 * @see Walker_Nav_Menu::start_lvl() for description of parameters.
	 *
	 * @param string $output See {@Walker_Nav_Menu::start_lvl()}.
	 * @param int    $depth  See {@Walker_Nav_Menu::start_lvl()}.
	 * @param array  $args   See {@Walker_Nav_Menu::start_lvl()}.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='children'>\n";
	}

	/**
	 * Create the markup to end a tree level.
	 *
	 * @see Walker_Nav_Menu::end_lvl() for description of parameters.
	 *
	 * @param string $output See {@Walker_Nav_Menu::end_lvl()}.
	 * @param int    $depth  See {@Walker_Nav_Menu::end_lvl()}.
	 * @param array  $args   See {@Walker_Nav_Menu::end_lvl()}.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent</ul>";
	}

	/**
	 * Create the markup to start an element.
	 *
	 * @see Walker::start_el() for description of parameters.
	 *
	 * @param string       $output Passed by reference. Used to append additional
	 *                             content.
	 * @param object       $item   Menu item data object.
	 * @param int          $depth  Depth of menu item. Used for padding.
	 * @param object|array $args   See {@Walker::start_el()}.
	 * @param int          $id     See {@Walker::start_el()}.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_nav_menu_placeholder;

		$_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval( $_nav_menu_placeholder ) - 1 : -1;
		$possible_object_id = isset( $item->post_type ) && 'nav_menu_item' == $item->post_type ? $item->object_id : $_nav_menu_placeholder;
		$possible_db_id = ( ! empty( $item->ID ) ) && ( 0 < $possible_object_id ) ? (int)$item->ID : 0;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$output .= $indent . '<li>';
		$output .= '<label class="menu-item-title">';
		$output .= '<input type="checkbox" class="menu-item-checkbox';

		if ( property_exists( $item, 'label' ) ) {
			$title = $item->label;
		}

		$output .= '" name="menu-item[' . $possible_object_id . '][menu-item-object-id]" value="' . esc_attr( $item->object_id ) . '" /> ';
		$output .= isset( $title ) ? esc_html( $title ) : esc_html( $item->title );
		$output .= '</label>';

		if ( empty( $item->url ) ) {
			$item->url = $item->guid;
		}

		// Menu item hidden fields.
		$output .= '<input type="hidden" class="menu-item-db-id" name="menu-item[' . $possible_object_id . '][menu-item-db-id]" value="' . $possible_db_id . '" />';
		$output .= '<input type="hidden" class="menu-item-object" name="menu-item[' . $possible_object_id . '][menu-item-object]" value="' . esc_attr( $item->object ) . '" />';
		$output .= '<input type="hidden" class="menu-item-parent-id" name="menu-item[' . $possible_object_id . '][menu-item-parent-id]" value="' . esc_attr( $item->menu_item_parent ) . '" />';
		$output .= '<input type="hidden" class="menu-item-type" name="menu-item[' . $possible_object_id . '][menu-item-type]" value="custom" />';
		$output .= '<input type="hidden" class="menu-item-title" name="menu-item[' . $possible_object_id . '][menu-item-title]" value="' . esc_attr( $item->title ) . '" />';
		$output .= '<input type="hidden" class="menu-item-url" name="menu-item[' . $possible_object_id . '][menu-item-url]" value="' . esc_attr( $item->url ) . '" />';
		$output .= '<input type="hidden" class="menu-item-target" name="menu-item[' . $possible_object_id . '][menu-item-target]" value="' . esc_attr( $item->target ) . '" />';
		$output .= '<input type="hidden" class="menu-item-attr_title" name="menu-item[' . $possible_object_id . '][menu-item-attr_title]" value="' . esc_attr( $item->attr_title ) . '" />';
		$output .= '<input type="hidden" class="menu-item-classes" name="menu-item[' . $possible_object_id . '][menu-item-classes]" value="' . esc_attr( implode( ' ', $item->classes ) ) . '" />';
		$output .= '<input type="hidden" class="menu-item-xfn" name="menu-item[' . $possible_object_id . '][menu-item-xfn]" value="' . esc_attr( $item->xfn ) . '" />';
	}
}

/**
 * Get menu pages for logged in user
 * @return array
 */
function boombox_nav_menu_get_loggedout_pages() {
	$pages = array(
		array(
			'name' => __( 'Log Out', 'boombox' ),
			'slug' => 'logout',
			'link' => wp_logout_url( home_url() ),
		),
	);

	$page_args = array();
	foreach ( $pages as $page ) {
		$page_args[ $page[ 'slug' ] ] = (object)array(
			'ID'             => -1,
			'post_title'     => $page[ 'name' ],
			'post_author'    => 0,
			'post_date'      => 0,
			'post_excerpt'   => $page[ 'slug' ],
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'guid'           => $page[ 'link' ],
		);
	}

	return $page_args;
}

/**
 * Render meta box content
 */
function boombox_admin_do_wp_nav_menu_meta_box() {
	global $nav_menu_selected_id;

	$walker = new Boombox_Walker_Nav_Menu_Checklist( false );
	$args = array( 'walker' => $walker );

	$post_type_name = 'boombox';

	$tabs = array(
		'loggedout' => array(
			'label' => __( 'Logged-Out', 'boombox' ),
			'pages' => boombox_nav_menu_get_loggedout_pages(),
		),
	);

	?>

	<div id="boombox-admin-menu" class="posttypediv">
		<h4><?php _e( 'Logged-Out', 'buddypress' ) ?></h4>
		<p><?php _e( '<em>Logged-Out</em> links are not visible to users who are logged in.', 'buddypress' ) ?></p>

		<div id="tabs-panel-posttype-<?php echo $post_type_name; ?>-loggedout" class="tabs-panel tabs-panel-active">
			<ul id="boombox-admin-menu-checklist-loggedout" class="categorychecklist form-no-clear">
				<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $tabs[ 'loggedout' ][ 'pages' ] ), 0, (object)$args ); ?>
			</ul>
		</div>

		<?php
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
		?>

		<p class="button-controls">
			<span class="list-controls">
				<a href="<?php
				echo esc_url( add_query_arg(
					array(
						$post_type_name . '-tab' => 'all',
						'selectall'              => 1,
					),
					remove_query_arg( $removed_args )
				) );
				?>#buddypress-menu" class="select-all"><?php _e( 'Select All', 'buddypress' ); ?></a>
			</span>
			<span class="add-to-menu">
				<input type="submit"<?php if ( function_exists( 'wp_nav_menu_disabled_check' ) ) : wp_nav_menu_disabled_check( $nav_menu_selected_id ); endif; ?>
				       class="button-secondary submit-add-to-menu right"
				       value="<?php esc_attr_e( 'Add to Menu', 'buddypress' ); ?>" name="add-custom-menu-item"
				       id="submit-boombox-admin-menu"/>
				<span class="spinner"></span>
			</span>
		</p>
	</div><!-- /#buddypress-menu -->

	<?php
}

/**
 * Register Meta Box
 */
add_action( 'load-nav-menus.php', 'boombox_wp_nav_menu_meta_box' );
function boombox_wp_nav_menu_meta_box() {
	add_meta_box(
		'add-boombox-nav-menu',
		__( 'Boombox', 'buddypress' ),
		'boombox_admin_do_wp_nav_menu_meta_box',
		'nav-menus',
		'side',
		'default'
	);
}