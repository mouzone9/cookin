<form role="search" method="get" class="form-inline search-form my-2 my-lg-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'wik-theme' ); ?></span>
	<input class="form-control mr-sm-2" type="search" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'wik-theme' ); ?>" value="<?php the_search_query(); ?>" aria-label="Search" name="s">
    <?php wp_dropdown_categories('show_option_none=Select category'); ?>
    <input type="hidden" name="post_type" value="recipe" />
    <label for="prix-mini">Prix minimum</label>
	<input type="number" name="minprice" min="0" value="<?php 
	if ( isset( $_GET['prix-mini'] ) && $_GET['prix-mini'] ) {
		echo intval( $_GET['prix-mini'] );
	} ?>" id="prix-mini">
    <label for="prix-maxi">Prix maximum</label>
	<input type="number" name="maxprice" min="0" value="<?php 
	if ( isset( $_GET['prix-maxi'] ) && $_GET['prix-maxi'] ) {
		echo intval( $_GET['prix-maxi'] );
	} ?>" id="prix-maxi">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo esc_attr_x( 'Search', 'submit button', 'wik-theme' ); ?></button>
</form>