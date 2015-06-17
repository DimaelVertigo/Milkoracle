<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Milkoracle
 */
?>

</div>
	<!-- /.container -->
<?php if (is_404()){ ?>
<?php } else {?>
<footer class="site-footer container">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-6 col-md-4 about">
			<a href="/about" class="link-about"><h4>About <br>the Project</h4></a>
			<p>Confessions from the Lunatic Fringe. <br>Follow us at <a href="https://twitter.com/milkoracle" class="twitter" target="_blank">@MilkOracle</a></p>
		</div>
		<div class="col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-6 col-md-4 email">
			<span>E-mail us</span>
			<a href="mailto:contact@milkoracle.org">contact@milkoracle.org</a>
		</div>
		<div class="col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-6 col-md-4 copyright">
			<span>© MILKORACLE, ltd 2015.</span>
			<p>All work copyright their respective creators</p>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- wrap -->
<?php } ?>
<?php wp_footer(); ?>

</body>
</html>