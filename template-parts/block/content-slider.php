<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$fields = get_fields();
$slider = $fields['slider'] ?: false;
$textMobile = $fields['textmobile'] ?: false;

if($slider){
	echo '<div class="block-slider acf-block swiper-container">
			<div class="swiper-wrapper">';
				foreach($slider as $slide){
				$photo = !empty($slide['foto']) ? $slide['foto'] : false;
				$url = !empty($slide['url']) ? $slide['url'] : false;
				$text = !empty($slide['text']) ? $slide['text'] : false;
				$bgrStyle = !empty($photo) ? 'style="background-image:url('. esc_url($photo) .')"' : '';

				echo '<div class="swiper-slide" '. wp_kses_post($bgrStyle) .'>';

					echo $url ? '<a href="'. esc_url($url) .'" class="swiper-link">' : '';

						echo $text ? '<div class="swiper-text">'. wp_kses_post($text) .'</div>' : '';

						echo $url ? '</a>' : '';

					echo '</div>';

				}

				echo'</div>

		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>';

		if($textMobile) echo '<div class="slider-text-mobile">'. wp_kses_post($textMobile) .'</div>';
		

	echo '</div>';
}


?>
