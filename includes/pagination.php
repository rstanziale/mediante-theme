<?php
// TODO: https://developer.wordpress.org/reference/functions/paginate_links/
$total_post_count = wp_count_posts();
$published_post_count = $total_post_count->publish;
$total_pages = ceil($published_post_count / $posts_per_page); ?>
<?php if ($total_pages > 1) : ?>
    <?php
    $pages = '';
    $range = 2;
    $showitems = ($range * 2) + 1;
    global $paged;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;

        if (!$pages)
            $pages = 1;
    }

    if (1 != $pages) { ?>
        <div class="row justify-content-center border-top border-light pt-4">
            <?php
            echo '<nav aria-label="Page navigation" role="navigation">';
            echo '<span class="sr-only">Page navigation</span>';
            echo '<ul class="pagination pagination-sm justify-content-center ft-wpbs mb-4">';


            if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
                echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link(1) . '" aria-label="First Page">&laquo;</a></li>';

            if ($paged > 1 && $showitems < $pages)
                echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link($paged - 1) . '" aria-label="Previous Page">&lsaquo;</a></li>';

            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems))
                    $page = $paged == 0 ? $paged + 1 : $paged;
                echo ($page == $i) ? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>' . $i . '</span></li>' : '<li class="page-item"><a class="page-link" href="' . get_pagenum_link($i) . '"><span class="sr-only">Page </span>' . $i . '</a></li>';
            }

            if ($paged < $pages && $showitems < $pages)
                echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link(($paged === 0 ? 1 : $paged) + 1) . '" aria-label="Next Page">&rsaquo;</a></li>';

            if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages)
                echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link($pages) . '" aria-label="Last Page">&raquo;</a></li>';

            echo '</ul>';
            echo '</nav>';
            // Uncomment this if you want to show [Page 2 of 30]
            // echo '<div class="pagination-info mb-5 text-center">[ <span class="text-muted">Page</span> ' . $paged . ' <span class="text-muted">of</span> ' . $pages . ' ]</div>';
            ?>
        </div>
    <?php  } ?>
<?php endif; ?>