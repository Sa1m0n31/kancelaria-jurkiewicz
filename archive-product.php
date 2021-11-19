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

            <h3 class="section__header section__header--small">
                E-booki
            </h3>
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

            <h3 class="section__header section__header--small">
                Szkolenia
            </h3>
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
                    <section class="section__afterTrainings">
                        <h2 class="section__header section__header--small">
                            Nielimitowany dostęp do wiedzy
                        </h2>
                        <p class="section__trainings__item__text">
                            Zdobywaj wiedzę kiedy i gdzie tylko masz na to ochotę. Format PDF umożliwia otwarcie publikacji na niemalże każdym urządzeniu. Wersje cyfrowe cechują się także zdecydowaną trwałością - bez ryzyka zniszczenia czy zgubienia, jak w przypadku standardowych książek. Dzięki temu zyskujesz nieograniczony i wygodny dostęp do wiedzy, którą przekazujemy Ci w naszych eBookach.
                        </p>
                        <h3 class="section__header--secondary">
                            Zalety eBooków
                        </h3>
                        <main class="afterTrainings__main flex">
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img afterTrainings__item__img--access" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/reka.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Łatwy dostęp
                                </h4>
                                <p class="afterTrainings__text">
                                    eBooki można uruchamiać na każdym urządzeniu, wystarczy posiadać kopię pliku, zapisaną np. na mailu lub w chmurze.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/rozwoj.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Troska o środowisko
                                </h4>
                                <p class="afterTrainings__text">
                                    eBooków nie trzeba drukować, co w szerszej perspektywie jest oszczędnością wielu setek, a nawet tysięcy kartek.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/copy.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Łatwość kopiowania
                                </h4>
                                <p class="afterTrainings__text">
                                    Dzięki formacie PDF, możesz tworzyć nieograniczoną ilość kopii elektronicznych książek, oczywiście na własny użytek.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/lupa.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Szukanie
                                </h4>
                                <p class="afterTrainings__text">
                                    To bardzo wygodna cecha. Dzięki funkcji przeszukiwania, możesz szybko dotrzeć do docelowego fragmentu w eBooku.
                                </p>
                            </section>
                        </main>
                    </section>
                    <section class="section section--contact" id="kontakt">
                        <h2 class="section__header">
                            Kontakt
                        </h2>
                        <div class="map">
                            <?php echo do_shortcode('[wpgmza id="1"]'); ?>
                        </div>
                        <main class="contact__main">
                            <h3 class="contact__main__header">
                                Kancelaria Prawna Moniki Jurkiewicz
                            </h3>
                            <h4 class="contact__main__header__item">
                                <img class="contact__main__header__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/home.svg'; ?>" alt="adres" />
                                ul. Warszawska 4/5, 87-100 Toruń
                            </h4>
                            <h4 class="contact__main__header__item">
                                <img class="contact__main__header__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/phone.svg'; ?>" alt="adres" />
                                tel. +48 56 622 09 77
                            </h4>
                            <h4 class="contact__main__header__item">
                                <img class="contact__main__header__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/mail.svg'; ?>" alt="adres" />
                                email: biuro@kancelaria-jurkiewicz.pl
                            </h4>
                        </main>
                    </section>
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
                    <section class="section__afterTrainings">
                        <h2 class="section__header section__header--small">
                            Zdobywaj wiedzę i doświadczenie
                        </h2>
                        <p class="section__trainings__item__text">
                            Tworzymy szkolenia, w których przekazujemy wiedzę opartą na naszych doświadczeniach i umiejętnościach, które wypracowaliśmy sobie przez lata prowadzenia kancelarii. Dzięki naszym warsztatom dowiesz się, jak uniknąć błędów, które my popełniliśmy i zyskasz wartościową wiedzę, którą będziesz mógł wykorzystać na Twojej ścieżce zawodowej. Prowadzimy szkolenia stacjonarnie, online, a także udostępniamy materiały wideo na stałe naszym Klientom.
                        </p>
                        <h3 class="section__header--secondary">
                            Zalety szkoleń - co zyskujesz?
                        </h3>
                        <main class="afterTrainings__main flex">
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/head.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Rozwój osobisty
                                </h4>
                                <p class="afterTrainings__text">
                                    Poprzez rozwój osobisty i zawodowy unikniesz rutyny i będziesz mógł poszukiwać nowych wyzwań w karierze.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/learning.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Praktyka i teoria
                                </h4>
                                <p class="afterTrainings__text">
                                    Na organizowanych przez nas szkoleniach nabierzesz zarówno praktyki, jak i posiądziesz wiedzę teoretyczną z danego zakresu.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/portfolio.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Możliwości zatrudnienia
                                </h4>
                                <p class="afterTrainings__text">
                                    Dzięki pozyskanym kwalifikacjom, możemy spodziewać się zwiększenia szansy na zatrudnienie.
                                </p>
                            </section>
                            <section class="afterTrainings__item">
                                <figure class="afterTrainings__item__imgWrapper">
                                    <img class="afterTrainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/circles.svg'; ?>" alt="rozwoj-osobisty" />
                                </figure>
                                <h4 class="afterTrainings__header">
                                    Interakcja
                                </h4>
                                <p class="afterTrainings__text">
                                    Jesteśmy w stałym kontakcie z uczestnikami naszych szkoleń i reagujemy, gdy tylko pojawi się jakiś problem lub pytanie.
                                </p>
                            </section>
                        </main>
                    </section>
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
