<?php

class metaData {
	private string $key;
	private string $ingredient;

	public function __construct( string $key ) {
		$this->ingredient = $key . '_ingredient';
		$this->key        = $key;
		$this->wik();
	}

	public function wik() {
		add_action( 'add_meta_boxes', [ $this, 'wik_add_metabox' ] );
		add_action( 'save_post', [ $this, 'wik_save_metabox' ] );
	}

	function wik_add_metabox() {
		add_meta_box(
			'list',
			'Wik contenu',
			[ $this, 'wik_metabox_render' ],
			'recipe'
		);
	}


	function wik_metabox_render() {
		$ingredients = get_post_meta( $_GET['post'], "wik_ingredient", true );
		$price = get_post_meta( $_GET['post'], "wik_price", true ) ;
		$note = get_post_meta( $_GET['post'], "wik_notes", true );
		?>
        <div class="metabox">
            <label>Ingrédients</label>
            <textarea name="ingredients"><?php echo $ingredients ?></textarea>

            <label>Notes</label>
            <input type="number" name="notes" value="<?= $note ?>"/>

            <label>Prix</label>
            <input type="number" name="price" value="<?= $price ?>"/>
        </div>
		<?php
	}

	function wik_save_metabox( $post_id ) {
		if (isset( $_POST['ingredients'] ) && $_POST['ingredients'] !== '' ) {
			update_post_meta( $post_id, 'wik_ingredient', $_POST['ingredients'] );
		}

		if ( isset( $_POST['notes'] ) && $_POST['notes'] !== '' ) {
			update_post_meta( $post_id, 'wik_notes', $_POST['notes'] );
		}

		if (isset( $_POST['price'] ) && $_POST['price'] !== '' ) {
			update_post_meta( $post_id, 'wik_price', $_POST['price'] );
		}
	}
}
