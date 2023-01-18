<?php get_header(); ?>
<?php include get_template_directory() . '/inc/banners/banner-inner.php'; ?>
<div class="error-page section-pd  text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-9 m-auto error-left">
                <h1 class="heading"> Page Not Found </h1>
                <p>The page you are looking for can't be found. Contact us by filling the form below. We will get in touch with you shortly.</p>
                <div class="contact-form-wrap mt-4">
                    <?php echo do_shortcode('[contact-form-7 id="286" title="Error Page"]'); ?>  
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?> 