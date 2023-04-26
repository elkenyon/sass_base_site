<?php do_action( 'fl_content_close' ); ?>

	</div><!-- .fl-page-content -->
	<?php

	do_action( 'fl_after_content' );

	if ( FLTheme::has_footer() ) :

		?>
	<footer class="fl-page-footer-wrap"<?php FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/WPFooter"' ); ?>  role="contentinfo">
		<?php

		do_action( 'fl_footer_wrap_open' );
		do_action( 'fl_before_footer_widgets' );

		FLTheme::footer_widgets();

		do_action( 'fl_after_footer_widgets' );
		do_action( 'fl_before_footer' );

		FLTheme::footer();

		do_action( 'fl_after_footer' );
		do_action( 'fl_footer_wrap_close' );

		?>
	</footer>
	<?php endif; ?>
	<?php do_action( 'fl_page_close' ); ?>
</div><!-- .fl-page -->
<?php

wp_footer();

do_action( 'fl_body_close' );

FLTheme::footer_code();

?>
</body>
</html>

<script>
	const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
	const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
  
    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
    else {        document.documentElement.setAttribute('data-theme', 'light');
          localStorage.setItem('theme', 'light');
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);
</script>