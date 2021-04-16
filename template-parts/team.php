<?php
/**
 * The default template for displaying team members content
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
    $position = !empty($fields['position']) ? $fields['position'] : false;
    $text = !empty($fields['text']) ? $fields['text'] : false;
    $fotos = !empty($fields['fotos']) ? $fields['fotos'] : false;
    $foto1Id = !empty($fotos['0']) ? $fotos['0']['id']: false;
    $foto1URL = !empty($fotos['0']) ? $fotos['0']['sizes']['large'] : false;
    $foto2Id = !empty($fotos['1']) ? $fotos['1']['id']: false;
    $foto2URL = !empty($fotos['1']) ? $fotos['1']['sizes']['large'] : false;
    $foto3Id = !empty($fotos['2']) ? $fotos['2']['id']: false;
    $foto3URL = !empty($fotos['2']) ? $fotos['2']['sizes']['large'] : false;
?>

<div class="team-member">
	<?php 
        echo '<div class="team-member-feat team-member-media">

            <div class="team-member-info">

                <div class="close"></div>

                <h2 class="name">'. get_the_title() .'</h2>';

                if($position){
                    echo '<span class="positon">'. esc_html($position) .'</span>';
                }

                if($text){
                    echo '<div class="text">'. wp_kses_post($text) .'</div>';
                }

                echo '<div class="team-fotos">

                    <div class="member-img" style="background-image:url('. esc_url($foto2URL) .')"></div>

                    <div class="member-img" style="background-image:url('. esc_url($foto3URL) .')"></div>

                </div>

            </div>';

            if($foto1Id){
                echo'<div class="feat-img member-img" style="background-image:url('. esc_url($foto1URL) .')"></div>';
            }
        echo '</div>';
        ?>
</div>
