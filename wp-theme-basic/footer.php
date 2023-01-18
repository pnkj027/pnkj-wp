<footer class="fullwidth footer-bg"> 
    <div class="main-footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="footer-col-1">
                    <div class="footer-logo mb-4">
                        <a href="<?php echo site_url(); ?>">
                            <?php if (get_field('footer_logo', 'option')): ?>
                                <img src="<?php the_field('footer_logo', 'option'); ?>" alt="logo">  
                            <?php else: ?>
                                <img src="<?php the_field('header_logo', 'option'); ?>" alt="logo">  
                            <?php endif; ?> 
                        </a>
                    </div> 
                    <?php if (get_field('footer_description', 'option')): ?>
                        <div class="footer_description">
                            <?php the_field('footer_description', 'option'); ?>
                        </div>
                    <?php endif; ?> 
                </div>
                
                <div class="footer-col-2">
                    <div class="title uc"> Important links </div>
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'Important links', // Do not fall back to first non-empty menu.
                        'menu_class' => 'menu-footer',
                        'theme_location' => 'footer',
                        'container' => false,
                    ));
                    ?>
                </div>
                <div class="footer-col-3">
                    <div class="title uc">Contact Us</div>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-bg fullwidth"> 
        <div class="container">
            <div class="copyright text-center"> 
                
            </div>
        </div>
    </div>
</footer>
<script>
    (function () {
        var fonts = document.createElement('link');
        fonts.href = 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap';
        fonts.rel = 'stylesheet';
        fonts.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(fonts);
    })();
</script>
<?php wp_footer(); ?>
</body>
</html>