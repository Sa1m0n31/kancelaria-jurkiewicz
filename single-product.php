<?php
get_header();
?>
<aside class="backBtnWrapper section">
    <a class="backBtn" href="<?php echo home_url(); ?>">
        <img class="backBtn__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/arrow-left.svg'; ?>" alt="wroc" />
        Powrót
    </a>
</aside>
<main class="singleProduct flex">
    <?php
        global $product;
        $productObj = new WC_Product(get_page_by_path( $product, OBJECT, 'product' )->ID);
    ?>
    <figure class="singleProduct__imgWrapper">
        <img class="singleProduct__img" src="<?php echo wp_get_attachment_url( $productObj->get_image_id() ); ?>" />
    </figure>
    <article class="singleProduct__content">
        <section class="singleProduct__firstLine flex">
            <h2 class="singleProduct__title">
                <?php echo $productObj->get_title(); ?>
            </h2>
            <h3 class="singleProduct__price">
                <?php echo $productObj->get_price_html(); ?>
            </h3>
        </section>
        <h4 class="singleProduct__header">
            Opis produktu
        </h4>
        <section class="singleProduct__desc">
            <?php echo $productObj->get_description(); ?>
        </section>
        <h4 class="singleProduct__header">
            Specyfikacja produktu
        </h4>
        <section class="singleProduct__header--keyValue">
               <?php echo get_field('specyfikacja'); ?>
        </section>
        <h4 class="singleProduct__header">
            Wysyłka
        </h4>
        <p class="singleProduct__desc">
            Na stronę z możliwością pobrania produktu zostaniesz przeniesiony bezpośrednio po opłaceniu zamówienia.
        </p>
        <?php
            $id = get_the_ID();
            echo do_shortcode( '[add_to_cart id='.$id.']' );
        ?>
    </article>
</main>
<section class="ebooks__crosssells">
    <?php
        $terms = get_the_terms($product->get_id(), 'product_cat' );
        if(count($terms)) {
            if($terms[0]->name == "Szkolenia") {
                ?>
                <h3 class="section__header section__header--small">
                    Jak zapisać się na szkolenie?
                </h3>
                <section class="section--instruction">
                    <section class="section__instruction__item">
                        <div class="section__instruction__number">
                            1
                        </div>
                        <p class="section__instruction__description">
                            Kiedy wybrałeś już szkolenie, które chcesz zakupić, kliknij przycisk "Dodaj do koszyka". Strona poprowadzi Cię do następnego etapu, gdzie będziesz musiał wypełnić formularz.
                        </p>
                    </section>
                    <section class="section__instruction__item">
                        <div class="section__instruction__number">
                            2
                        </div>
                        <p class="section__instruction__description">
                            Wypełnij formularz zamówienia, a następnie opłać szkolenie wybraną metodą płatności.
                        </p>
                    </section>
                    <section class="section__instruction__item">
                        <div class="section__instruction__number">
                            3
                        </div>
                        <p class="section__instruction__description">
                            Zostaniesz przekierowany na stronę, gdzie będziesz miał możliwość pobrania zakupionych szkoleń. W razie problemów skontaktuj się z nami mailowo - pomożemy!
                        </p>
                    </section>
                </section>

                <h3 class="section__header section__header--small">
                    Polecane szkolenia
                </h3>
                <main class="section__trainings flex">
                    <?php
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 2,
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
                                        <img class="section__trainings__item__img" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
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
            else {
                ?>
                <h3 class="section__header section__header--small">
                    Polecane eBooki
                    <?php

                    ?>
                </h3>
                <main class="section__ebooks flex">
                    <?php
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
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
                                        <img class="section__ebooks__item__img" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
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
        }
    ?>
</section>
<?php
get_footer();
?>
