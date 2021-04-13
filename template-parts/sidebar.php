<?php if(!is_front_page()) {

    $currentPageId = get_the_id();
    $parentPageId = wp_get_post_parent_id($currentPageId);

    $pageId = $parentPageId ? $parentPageId : $currentPageId;
    
    $pages = wp_list_pages( array(
        'child_of' => $pageId,
        'title_li' => false,
        'echo' => false
    ) );

    echo '<aside id="site-sidebar">
        <ul>
        '. wp_kses_post($pages) .'
        </ul>
    </aside>';
}?>
