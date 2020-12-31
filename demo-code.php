<!-- This example will simply add a tab that is added to each product. -->
<?php

/**
 * Add the custom tab
 * changes
 */
function my_simple_custom_product_tab( $tabs ) {

	$tabs['my_custom_tab'] = array(
		'title'    => __( 'Custom Tab', 'textdomain' ),
		'callback' => 'my_simple_custom_tab_content',
		'priority' => 50,
	);

	return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'my_simple_custom_product_tab' );

/**
 * Function that displays output for the shipping tab.
 */
function my_simple_custom_tab_content( $slug, $tab ) {

	?><h2><?php echo wp_kses_post( $tab['title'] ); ?></h2>
	<p>Tab Content</p><?php

}



<!--Here’s a example that adds shipping information to only your physical products: -->
<?php

function my_custom_physical_product_tab( $tabs ) {

	global $product;

	// Ensure it doesn't show for virtual products
	if ( ! $product->is_virtual() ) {
		$tabs['shipping'] = array(
			'title'    => __( 'Shipping', 'textdomain' ),
			'callback' => 'my_custom_shipping_tab',
			'priority' => 50,
		);
	}

	return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'my_custom_physical_product_tab' );

/**
 * Function that displays output for the shipping tab.
 */
function my_custom_shipping_tab( $slug, $tab ) {

	?><h2><?php echo wp_kses_post( $tab['title'] ); ?></h2>
	<p>This tab contains shipping information</p><?php

}

<!-- Change the existing tab position
Description	10
Additional information	20
Reviews	30

-->

<?php

// Copy from here to your (child) themes functions.php

function my_custom_product_tabs_order( $tabs ) {
	
	// Double check to make sure the default tabs exist and are not removed at some point.
	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['priority'] = 30;
	}
	
	if ( isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['priority'] = 20;
	}
	
	if ( isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['priority'] = 10;
	}
	
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'my_custom_product_tabs_order' );
