<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

/* Enqueue scripts */
function jurkiewicz_scripts() {
    wp_enqueue_style( 'css-mobile', get_template_directory_uri() . '/mobile.css', array(), _S_VERSION );
    wp_enqueue_style( 'css-style', get_template_directory_uri() . '/my-style.css', array(), _S_VERSION );

    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('siema', 'gsap', 'geowidget'), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'jurkiewicz_scripts' );

/* Header */
function remove_header_actions() {
    remove_all_actions('storefront_header');
    remove_all_actions('storefront_content_top');
}
add_action('wp_head', 'remove_header_actions');

function jurkiewicz_header() {
    ?>
	<header class="header flex">
		<!-- DESKTOP -->
		<a class="header__logoWrapper" href="<?php echo home_url(); ?>">
			<img class="header__logoImg" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/kancelaria-jurkiewicz-logo.png' ?>" alt="kancelaria-jurkiewicz" />
		</a>
		<menu class="header__menu d-desktop">
			<ul class="header__menu__list flex">
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href="<?php echo home_url(); ?>">
						Strona główna
					</a>
				</li>
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href=".">
						E-booki
					</a>
				</li>
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href=".">
						Szkolenia
					</a>
				</li>
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href=".">
						O kancelarii
					</a>
				</li>
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href=".">
						Kontakt
					</a>
				</li>
				<li class="header__menu__list__item">
					<a class="header__menu__list__link" href=".">
						Kancelaria Jurkiewicz
					</a>
				</li>
			</ul>
		</menu>
		<a class="header__cart" href=".">
			<img class="header__cart__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/cart.png' ?>" alt="koszyk" />
			<span class="d-desktop">Koszyk (1)</span>
			<span class="d-mobile">1</span>
		</a>

		<!-- MOBILE -->
		<button class="hamburgerMenu d-mobile" onclick="openMobileMenu()">
			<img class="btn__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/hamburger-menu.svg' ?>" alt="menu" />
		</button>
		<menu class="mobileMenu d-mobile">
			<button class="closeMenuBtn" onclick="closeMobileMenu()">
				<img class="btn__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/close.svg' ?>" alt="zamknij" />
			</button>
			<a class="mobileMenu__logo" href="">
				<img class="btn__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/kancelaria-jurkiewicz-logo.png' ?>" alt="logo" />
			</a>
			<ul class="mobileMenu__list">
				<li class="mobileMenu__list__item">
					<a class="mobileMenu__list__link" href="<?php echo home_url(); ?>">
						Strona główna
					</a>
				</li>
				<li class="mobileMenu__list__item">
					<a class="mobileMenu__list__link" href=".">
						E-booki
					</a>
				</li>
				<li class="mobileMenu__list__item">
					<a class="mobileMenu__list__link" href=".">
						Szkolenia
					</a>
				</li>
				<li class="mobileMenu__list__item">
					<a class="mobileMenu__list__link" href=".">
						Kontakt
					</a>
				</li>
				<li class="mobileMenu__list__item">
					<a class="mobileMenu__list__link" href=".">
						Kancelaria Jurkiewicz
					</a>
				</li>
			</ul>
			<a class="header__cart" href=".">
				<img class="header__cart__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/cart.png' ?>" alt="koszyk" />
				<span>Koszyk (1)</span>
			</a>
		</menu>
	</header>
<?php
}

add_action('storefront_before_content', 'jurkiewicz_header', 10);

function jurkiewicz_homepage() {
?>
    <main class="section hero">
        <h1 class="hero__header">
            Zdobywaj wiedzę i rozwijaj umiejętności Profesjonalne <span class="hero__header--orange">szkolenia i e-Booki</span>
        </h1>
        <section class="hero__items flex">
            <section class="hero__items__item">
                <figure class="hero__items__item__imgWrapper center">
                    <img class="hero__items__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/check.png'; ?>" alt="aktualne-tresci" />
                </figure>
                <h2 class="hero__items__item__header">
                    Zawsze aktualne treści
                </h2>
                <p class="hero__items__item__text">
                    Oferowane przez nas szkolenia oraz eBooki zawierają aktualne treści, zgodne z obecnymi rozporządzeniami czy trendami.
                </p>
            </section>
            <section class="hero__items__item">
                <figure class="hero__items__item__imgWrapper center">
                    <img class="hero__items__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/profesjonalisci.png'; ?>" alt="aktualne-tresci" />
                </figure>
                <h2 class="hero__items__item__header">
                    Zespół profesjonalistów
                </h2>
                <p class="hero__items__item__text">
                    Szkolenia i eBooki przygotowują profesjonaliści z doświadczeniem i odpowiednim poziomem wiedzy.
                </p>
            </section>
            <section class="hero__items__item">
                <figure class="hero__items__item__imgWrapper center">
                    <img class="hero__items__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/check.png'; ?>" alt="aktualne-tresci" />
                </figure>
                <h2 class="hero__items__item__header">
                    Zawsze aktualne treści
                </h2>
                <p class="hero__items__item__text">
                    Oferowane przez nas szkolenia oraz eBooki zawierają aktualne treści, zgodne z obecnymi rozporządzeniami czy trendami.
                </p>
            </section>
        </section>
        <section class="hero__buttons center">
            <a class="hero__button center" href="">
                Kup e-booka
            </a>
            <a class="hero__button center" href="">
                Zapisz się na szkolenie
            </a>
        </section>
    </main>
    <section class="section section--ebooks">
        <h2 class="section__header">
            eBooki
        </h2>
        <p class="section__text">
            Internetowe książki, które możesz mieć na wyciągnięcie ręki. Nasze eBooki są przygotowywane przez zespół profesjonalnych doradców, a treści są zawsze aktualne.
        </p>
        <main class="section__ebooks flex">
            <?php
                for($i=0; $i<4; $i++) {
                    ?>
                    <a class="section__ebooks__item" href=".">
                        <figure class="section__ebooks__item__imgWrapper">
                            <img class="section__ebooks__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/example.png'; ?>" alt="example" />
                        </figure>
                        <h3 class="section__ebooks__item__title">
                            Tytuł e-booka
                        </h3>
                        <p class="section__ebooks__item__text">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        </p>
                        <h4 class="section__ebooks__item__price">
                            99.99 PLN
                        </h4>
                        <button class="section__ebooks__item__button">
                            Do koszyka
                        </button>
                    </a>
                        <?php
                }
            ?>
        </main>
    </section>
    <section class="section section--trainings">
        <h2 class="section__header">
            Szkolenia
        </h2>
        <p class="section__text">
            Wybierz tematykę warsztatów, w których chcesz uczestniczyć, i zarezerwuj miejsce. Wszystkie nasze szkolenia prowadzone są przez wykwalifikowany personel.
        </p>
        <main class="section__trainings flex">
            <?php
                for($i=0; $i<2; $i++) {
                    ?>
                    <a class="section__trainings__item flex" href=".">
                        <figure class="section__trainings__item__imgWrapper">
                            <img class="section__trainings__item__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/example2.svg'; ?>" alt="example" />
                        </figure>
                        <article class="section__trainings__item__content">
                            <h3 class="section__trainings__item__header">
                                Nazwa szkolenia
                            </h3>
                            <p class="section__trainings__item__text">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam.
                            </p>
                            <h4 class="section__trainings__item__priceWrapper">
                                Cena szkolenia:
                                <span class="section__trainings__item__price">
                        120 PLN
                    </span>
                            </h4>
                        </article>
                        <button class="section__trainings__item__btn">
                            Zapisz się na szkolenie
                        </button>
                    </a>
                        <?php
                }
            ?>
        </main>
    </section>
    <section class="section section--aboutUs flex" id="o-nas">
        <figure class="aboutUs__imgWrapper">
            <img class="aboutUs__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/example3.svg'; ?>" alt="kancelaria-jurkiewicz" />
        </figure>
        <article class="aboutUs__content">
            <h2 class="aboutUs__header">
                O kancelarii
            </h2>
            <p class="aboutUs__text">
                Jako kancelaria prawna działamy na rynku od 2005 roku. Zebrane przez ten czas doświadczenie i pozyskane umiejętności stawiają nas dzisiaj w dobrej pozycji, aby doradztwo i pomoc prawna, jakiej udzielamy, były na jak najwyższym poziomie.
            </p>
            <p class="aboutUs__text">
                Chcemy dzielić się wiedzą i doświadczeniem, które posiadamy, aby pomagać naszym Klientom. Tworząc szkolenia i eBooki i udostępniając je Państwu na tej stronie, chcemy jeszcze bardziej podnieść poziom naszych usług.
            </p>
            <p class="aboutUs__text">
                Więcej o naszej ofercie kancelarii prawnej możecie znaleźć Państwo na naszej stronie internetowej. Prowadzimy usługi z zakresu doradztwa prawnego, prawa pracy czy windykacji. Rozwijamy się dla Państwa! Zapraszamy do skorzystania z naszej oferty doradztwa, a także do zakupu naszych szkoleń i eBooków.
            </p>
            <a class="aboutUs__btn center" rel="noreferrer" target="_blank" href="https://kancelaria-jurkiewicz.pl">
                kancelaria-jurkiewicz.pl
            </a>
        </article>
    </section>
    <section class="section section--contact">
        <h2 class="section__header">
            Kontakt
        </h2>
        <div class="map">

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
add_action('storefront_homepage', 'jurkiewicz_homepage', 12);

function jurkiewicz_footer() {
    ?>
    <footer class="footer flex">
        <section class="footer__col">
            <h4 class="footer__header">
                Informacje i dane kontaktowe
            </h4>
            <div class="footer__col__text">
                Kancelaria Prawna Monika Jurkiewicz<br/>
                ul. Warszawska 4/5,<br/>
                87-100 Toruń<br/>
                NIP: 8792132559<br/>
                tel. +48 56 622 09 77
            </div>
            <div class="footer__col__text">
                Pon. - Pt.: 9:00 - 16:00<br/>
                Po uprzednim kontakcie telefonicznym
            </div>
        </section>
        <section class="footer__col">
            <h4 class="footer__header">
                Linki
            </h4>
            <ul class="footer__col__list">
                <li class="footer__col__list__item">
                    <a class="footer__link" href=".">
                        Regulamin
                    </a>
                </li>
                <li class="footer__col__list__item">
                    <a class="footer__link" href=".">
                        Polityka prywatności
                    </a>
                </li>
            </ul>
        </section>
        <section class="footer__col">
            <h4 class="footer__header">
                Oferta
            </h4>
            <ul class="footer__col__list">
                <li class="footer__col__list__item">
                    <a class="footer__link" href=".">
                        E-booki
                    </a>
                </li>
                <li class="footer__col__list__item">
                    <a class="footer__link" href=".">
                        Szkolenia
                    </a>
                </li>
            </ul>
        </section>
        <section class="footer__col">
            <a class="footer__col__link" href=".">
                <img class="footer__col__link__img" src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/images/jurkiewicz/kancelaria-jurkiewicz-logo-duze.png'; ?>" />
            </a>
        </section>
        <h6 class="footer__copyright">
            © 2021 Kancelaria Prawna Jurkiewicz. Projekt i wykonanie: <a href="https://skylo.pl" rel="noreferrer" target="_blank">Skylo.pl</a>
        </h6>
    </footer>
    <?php
}
add_action('storefront_footer', 'jurkiewicz_footer', 14);