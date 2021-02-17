<?php

/**
 * Article Page
 *
 * @package tri
 */
// Get data post
the_post();

$articlePage = new ArticlePage();
// Function for account how many access this post has
chr_setPostViews( get_the_ID() );

?>

<div id="article-page" class="page-content">
	<main id="main">
        <section class="image-post d-block" data-style data-background-image="url(<?= get_the_post_thumbnail_url(); ?>)"></section>

        <section class="_the-content">
            <div class='container'>
                <div class='row'>
                    <div class='col-12 col-lg-8 pt-6 pb-10'>
                        <h1 class="mb-4"> <?= get_the_title(); ?> </h1>
                        <div class="_the-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Sidebar -->
					<div class='col-12 col-lg-4'>
						<?php get_sidebar(); ?>
					</div>
                </div>
            </div>
        </section>
	</main>
</div>