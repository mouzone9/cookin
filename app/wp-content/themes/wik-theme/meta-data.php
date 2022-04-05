<?php
class metaData
{
    private string $key;
    private string $ingredient;

    public function __construct(string $key)
    {
        $this->ingredient = $key . '_ingredient';
        $this->key = $key;
        $this->wik();
    }

    public function wik()
    {
        add_action('add_meta_boxes', [$this, 'wik_add_metabox']);
        add_action('save_post', [$this, 'wik_save_metabox']);
    }

    function wik_add_metabox()
    {
        add_meta_box(
            'list',
            'Wik contenu',
            [$this, 'wik_metabox_render'],
            'post',
            'side'
        );
    }


    function wik_metabox_render()
    {
?>
        <label>Ingrédients</label>
        <textarea name="ingredient"></textarea>

        <label>Notes</label>
        <input type="number" name="notes" />
<?php
    }

    function wik_save_metabox($post_id)
    {
        if ($_POST['ingredient'] !== '') {
            update_post_meta($post_id, 'wik_ingredient', $_POST['ingredient']);
        } else {
            delete_post_meta($post_id, 'wik_ingredient');
        }

        if ($_POST['notes'] !== '') {
            update_post_meta($post_id, 'wik_notes', $_POST['notes']);
        } else {
            delete_post_meta($post_id, 'wik_notes');
        }
    }
}
