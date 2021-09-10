<?php get_header(); ?>
<?php if (have_posts()) the_post();?> 
		<div class="pagina">
			<div id="titulo">
				<h1><?php echo get_the_title();?></h1>
			</div>
			<div id="conteudo">
				<?php echo the_content(); ?>
			</div>
		</div>
<?php get_footer(); ?>
