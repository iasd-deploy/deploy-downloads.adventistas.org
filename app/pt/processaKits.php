<?php
/** 
	PARA EXECUTAR O SCRIPT, RODE NO TERMINAL (com wpcli instalado): 
 	wp eval-file processaKits.php
 */

processaKits();

function processaKits() {
	ob_start();

	$args = array(
        'taxonomy' => 'xtt-pa-kits',
        'hide_empty' => false
	);
	$kits = get_terms($args);
	$count = 0;
	
	echo "\n\n";
	echo "KITS A PROCESSAR: ". count($kits);
	echo "\n\n";
	
	foreach ($kits as &$kit){
		//sleep(0.5);
		$count++;

        $id = $kit->term_id;
        $name = $kit->name;
        $description = $kit->description;
        $imageId = get_option('xtt_cat_info_' . 1339)["thumbnail_id"];
       

        $post_arr = array(
            'post_title'   => $name,
            'post_content' => $description,
            'post_status'  => 'publish',
            'post_type' => 'kit',
            'post_author'  => 136, // ID do usuario suporte.internet dsa - Isso deve mudar para o site ES
        );

        $post_id = wp_insert_post($post_arr);
        set_post_thumbnail($post_id, $imageId);

        $valor = array(
            'manual' => '',
            'sticky' => implode(',', get_posts_by_term($id))
        ); 

        update_field('downloads_kits', $valor, $post_id);

        echo $post_id .' - '. $name ."\n";

		ob_flush();
		flush();
	}

    echo 'Posts processados: ' . $count;
}

function get_posts_by_term($id_term){

    $args = array(
        'post_type' => 'post',
        'fields' => 'ids',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
            'taxonomy' => 'xtt-pa-kits',
            'field' => 'term_id',
            'terms' => $id_term
             )
          )
        );

        $query = get_posts($args);

        return $query;
}


