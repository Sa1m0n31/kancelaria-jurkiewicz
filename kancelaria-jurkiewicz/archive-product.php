<?php
get_header();
?>
<?php
$cate = get_queried_object();
$category = $cate->name;
?>
<aside class="backBtnWrapper section">
    <a class="backBtn" href="<?php echo home_url(); ?>">
        <img class="backBtn__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/arrow-left.svg'; ?>" alt="wroc" />
        Powrót
    </a>
</aside>
<main class="shop__main">
    <?php
        if($category == 'product') {
            ?>
            <h2 class="section__header">
                Wszystkie produkty
            </h2>

        <?php
        }
        else {
            ?>
            <h2 class="section__header">
                <?php echo $category; ?>
            </h2>
            <?php
                if($category == 'E-booki') {
                    ?>
                        <main class="section__ebooks flex">
                            <?php
                            $loop = new WP_Query( array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 100,
                                'product_cat' => 'e-booki'
                            ));
                            if($loop->have_posts()) {
                                while($loop->have_posts()) {
                                    $loop->the_post();
                                    global $product;
                                    ?>
                                    <section class="section__ebooks__item">
                                        <a class="section__ebooks__item__inner" href="<?php echo get_permalink( $product->get_id() ); ?>">
                                            <figure class="section__ebooks__item__imgWrapper">
                                                <?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                                else echo '<img class="section__ebooks__item__img" src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />'; ?>
                                            </figure>
                                            <h3 class="section__ebooks__item__title">
                                                <?php echo the_title(); ?>
                                            </h3>
                                            <section class="section__ebooks__item__text">
                                                <?php echo $product->get_short_description(); ?>
                                            </section>
                                            <h4 class="section__ebooks__item__price">
                                                <?php echo $product->get_price_html(); ?>
                                            </h4>
                                        </a>
                                        <?php woocommerce_template_loop_add_to_cart($loop->post, $product); ?>
                                    </section>
                                    <?php
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </main>
                    <?php
                }
                else {
                    ?>
                        <main class="section__trainings flex">
                            <?php
                            $loop = new WP_Query( array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 100,
                                'product_cat' => 'szkolenia'
                            ));

                            if($loop->have_posts()) {
                                while($loop->have_posts()) {
                                    $loop->the_post();
                                    global $product;
                                    ?>
                                    <section class="section__trainings__item flex">
                                        <a class="section__trainings__item__inner" href="<?php echo get_permalink( $product->get_id() ); ?>">
                                            <figure class="section__trainings__item__imgWrapper">
                                                <?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                                else echo '<img class="section__ebooks__item__img" src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />'; ?>
                                            </figure>
                                            <article class="section__trainings__item__content">
                                                <h3 class="section__trainings__item__header">
                                                    <?php echo the_title(); ?>
                                                </h3>
                                                <p class="section__trainings__item__text">
                                                    <?php echo $product->get_short_description(); ?>
                                                </p>
                                                <h4 class="section__trainings__item__priceWrapper">
                                                    Cena szkolenia:
                                                    <span class="section__trainings__item__price">
                                        <?php echo $product->get_price_html(); ?>
                                    </span>
                                                </h4>
                                            </article>
                                        </a>
                                        <?php woocommerce_template_loop_add_to_cart($loop->post, $product); ?>
                                    </section>
                                    <?php
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </main>
                    <?php
                }
            ?>
    <?php
        }
    ?>
</main>
<?php
get_footer();
?>
