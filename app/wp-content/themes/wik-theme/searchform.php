<form role="search" method="get" class="form-inline search-form my-2 my-lg-0"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'wik-theme' ); ?></span>
    <div class="input-group">
        <label for="s">Recherche</label>
        <input class="form-control mr-sm-2 input" type="search"
               placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'wik-theme' ); ?>"
               value="<?php the_search_query(); ?>" aria-label="Search" name="s">
    </div>
    <div class="input-group">
        <label for="cat">Catégorie</label>
        <?php wp_dropdown_categories( [
            'taxonomy' => 'category',
            "hide_if_empty" => true,
            "show_option_none" => "Sélectionner catégorie"
        ] ); ?>
    </div>
    <input type="hidden" name="post_type" value="recipe"/>
    <div class="input-group">
        <label for="prix-mini">Prix minimum</label>
        <input type="number" class="input" name="minprice" min="0" value="<?php
        if ( isset( $_GET['prix-mini'] ) && $_GET['prix-mini'] ) {
            echo intval( $_GET['prix-mini'] );
        } ?>" id="prix-mini">
    </div>
    <div class="input-group">
        <label for="prix-maxi">Prix maximum</label>
        <input type="number" class="input" name="maxprice" min="0" value="<?php
        if ( isset( $_GET['prix-maxi'] ) && $_GET['prix-maxi'] ) {
            echo intval( $_GET['prix-maxi'] );
        } ?>" id="prix-maxi">
    </div>
    <button class="button" type="submit"><?php echo esc_attr_x( 'Search', 'submit button', 'wik-theme' ); ?></button>
</form>