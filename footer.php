		<!--  FOOTER  -->
		<footer class="footer " >  
				<div id="footer-widgets" class="pageWidth">
					<div id="area-widgets" class="pageWidth">
					<div class="container">
					<div class="row">
						<div id="footer-texto" class="col-md-4">
						<h3>Pocket<span>video</span></h3>
						<p>O pocket video tem como objetivo ensinar as empresas e pessoas a produzirem seus videos online de maneira fácil e gratuita</p>
						</div>
						<div  id="footer-twitter" class="col-md-4">
						<?php if ( dynamic_sidebar('menu-social') ) : else : endif; ?>
						</div>
					</div>
					</div>
					</div>
					
				<div id="footer-imagem" class="pageWidth">
					<div class="container">
					<div class="row">
						<div id="image-footer" class="col-md-4">
						<img src="<?php echo get_template_directory_uri(); ?>/images/imagembolso.png" class="img-responsive img-centered">';
						</div>
						<div id="social-footer" class="col-md-4">
						<?php if ( dynamic_sidebar('nos-encontre') ) : else : endif; ?>
						</div>
					</div>
					</div>
				</div>
					</div>
			<?php echo sambatech_chamado_footer('',''); ?>


		 </footer>
		 <!--  FOOTER  -->
		<?php wp_footer(); ?>
	</body>
</html>

