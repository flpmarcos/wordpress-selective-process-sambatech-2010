<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
 
<div id="list-content" class="f-left"> 
<?php if ( have_posts() ) : ?>
		<div>
			<h3>Ressultado de busca para: <?php echo get_search_query(); ?></h3>
			<?php
			/* Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called loop-search.php and that will be used instead.
			 */
				 
		while (have_posts()) : the_post();
			$titlesearch = get_the_title();
			$resumo = get_the_excerpt();
		?>
			<p><a href="<?php the_permalink() ?>"><span class="estante-chamada"><?php echo $titlesearch; ?>:</span> <?php echo $resumo; ?></p></a>
		<?php
		endwhile;
		//		 get_template_part( 'loop', 'search' );
		?>
		</div>
<?php else : ?>
					<h2>Resultado da busca</h2>
					<p>Desculpe, mas n&atilde;o foram encontrados resultados para sua busca. Por favor, tente novamente com palavras-chave diferentes.</p>
					<BR><?php get_search_form(); ?>
<?php endif; ?>
</div> <?php /*** Fim list-content ***/ ?>

<?php get_footer(); ?>
