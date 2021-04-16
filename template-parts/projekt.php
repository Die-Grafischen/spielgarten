<?php
/**
 * The default template for displaying projekt content
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WPBlank
 * @since WPBlank 1.0
 */

?>
<?php 
    $fields = get_fields();
    $title = get_the_title();
    $info = !empty($fields['projektinfo']) ? $fields['projektinfo'] : false;
    $ort = !empty($fields['ort']) ? $fields['ort'] : false;
    $fotos = !empty($fields['projektgalerie']) ? $fields['projektgalerie'] : false;
    $taxObj = get_the_terms(get_the_ID(), 'kategorie');
    $categories = '';
    $cat = '';
    if ( ! empty( $taxObj ) && ! is_wp_error( $taxObj ) ) {
        $categories = wp_list_pluck( $taxObj, 'name' );
        $cat = strtolower(join($categories));
        $catName = join($categories);
    }
?>

<div class="projekt <?php echo esc_attr($cat); ?> alleprojekte">
	<?php 
        echo '<div class="projekt-slider swiper-container"
        	style="background-image: url('. esc_url($fotos[0]['sizes']['medium_large']) .');">

            <div class="swiper-wrapper">';
                foreach ($fotos as $foto){
                    $fotoURL = $foto['sizes']['medium_large'];
                    echo '<div class="projekt-slide swiper-slide"
                    	style="background-image: url('. esc_url($fotoURL) .');"></div>';
                }
            echo '</div>

            <div class="swiper-button-prev swiper-btn"></div>
            <div class="swiper-button-next swiper-btn"></div>
                
        </div>';

        echo '<div class="projekt-meta">

            <div class="close"></div>

            <h2 class="name">'. get_the_title() .'</h2>';

            if($ort){
                echo '<span class="projekt-ort">'. esc_html($ort) .'</span>';
            }

            if($info){
                echo '<div class="projekt-info">'. wp_kses_post($info) .'</div>';
            }

            echo '<div class="projekt-category">'. esc_html($catName) .'</div>';

        echo '</div>';
        
        // galery photos skip first image
        $counter = 0;
        foreach($fotos as $foto){
            if ($counter++ == 0) continue;
            echo '<div class="projekt-foto" data-foto="'. esc_url($foto['sizes']['medium_large']) .'"></div>';
        }

    ?>
</div>
