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
    $catName = '';
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

            echo '<div class="projekt-category">
                <span class="projekt-ca" data-ca="'. esc_attr($catName).'">Kategorie: '. esc_html($catName) .'</span><br>
                <span class="projekt-back">< zurück</span>
            </div>';

        echo '</div>';
        
        // gallery photos skip first image
        $counter = 0;
        foreach($fotos as $foto){
            if ($counter++ == 0) continue;
            echo '<div class="projekt-foto" data-foto="'. esc_url($foto['sizes']['medium_large']) .'"></div>';
        }

    ?>
	<div class="to-the-top">
		<svg xmlns="http://www.w3.org/2000/svg" width="32.845" height="14.574" viewBox="0 0 32.845 14.574">
			<path data-name="Path 403"
				d="M160.507,71.107l-11.99-14.919a.846.846,0,0,0-1.407,0,1.428,1.428,0,0,0,0,1.755L158.4,71.985,147.109,86.026a1.428,1.428,0,0,0,0,1.755.933.933,0,0,0,.7.376.884.884,0,0,0,.7-.376l11.99-14.919a1.36,1.36,0,0,0,.3-.878A1.284,1.284,0,0,0,160.507,71.107Z"
				transform="translate(-55.562 161.058) rotate(-90)" stroke="#000" stroke-width="0.5" />
		</svg>
	</div>

</div>
