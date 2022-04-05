<form role="search" method="get" class="form-inline search-form my-2 my-lg-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'aquila' ); ?></span>
	<input class="form-control mr-sm-2" type="search" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'wik-theme' ); ?>" value="<?php the_search_query(); ?>" aria-label="Search" name="s">
    <?php
                // for more information see http://codex.wordpress.org/Function_Reference/wp_dropdown_categories
                $swp_cat_dropdown_args = array(
                        'show_option_all'  => __( 'Any Category' ),
                        'name'             => 'swp_category_limiter',
                    );
                wp_dropdown_categories( $swp_cat_dropdown_args );
            ?>
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo esc_attr_x( 'Search', 'submit button', 'wik-theme' ); ?></button>
</form>