<?php get_header(); ?>

<!--  Conteudo da pagina  -->
		<div id="index-fundo" >
			<div id="index-controller"  >
				<section id="video-destaque"  >
					<div id="post-destaque" class="pageWidth" >
						<?php echo sambatech_posts_destaque('video-destaque ','vid','DESTAQUE',1); ?>
						
					</div>
				</section>
				
<!--  Sessão de classificados  -->

					<?php 
						$args = array('post_type'=>'videos', 'numberposts'=>4);
						$my_videos = get_posts( $args );
						if( $my_videos ):
					 ?>
						<div id="classificados-index">
						<div   class="container pageWidth ">
						<h4>Videos mais Rankeados</h4>
						<div class="row">
					
					<?php foreach ( $my_videos as $post ) : setup_postdata( $post ); ?>
						
						<?php
							$url_youtube = "//www.youtube.com/embed/";
							$url_vimeo = "//player.vimeo.com/video/";
							$url_video = "";

							$textDescription = get_field('link_youtube_vimeo');
							$parsed     = parse_url($textDescription);
							$hostname   = $parsed['host'];
							$query      = $parsed['query'];
							$path       = $parsed['path'];
							$Arr = explode('v=',$query);
							$videoIDwithString = $Arr[1];
							$videoID = substr($videoIDwithString,0,11); // 5sRDHnTApSw
								if( (isset($videoID)) && (isset($hostname)) && ($hostname=='www.youtube.com' || $hostname=='youtube.com')){
									
									$url_video = $url_youtube .  $videoID;
								}
								else  if((isset($hostname)) && $hostname=='vimeo.com'){
									$ArrV = explode('://vimeo.com/',$path);
									$videoID = substr($ArrV[0],1,9); 
									$vimdeoIDInt = intval($videoID); 
									
									$url_video = $url_vimeo . $vimdeoIDInt;
								}
							?>
							<!--  APARECER VIDEO COM TITULO E CATEGORIA  -->
							<div class="col-md-3 col-sm-6">
							<div id="classificados-controller">
							<iframe width="220" height="228" src="<?php echo $url_video; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
							<h5><?php the_title(); ?> </h5><div class="rating"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
</div>
							
							</div>
							</div>
			
					<?php endforeach; ?>
					</div>
					</div>
					</div>
					<?php else: ?>
						<p>Nenhum vídeo inserido.</p>
					<?php endif; ?>
				

<!--  Sessão de Recentes  -->
					
					<?php 
						$args = array('post_type'=>'videos', 'numberposts'=>4);
						$my_videos = get_posts( $args );
						if( $my_videos ):
					 ?>
					 <div id="recentes-index">
					<div   class="container pageWidth ">
					<h4><span class="colorido">Mais recentes</span> / Mais vistos</h4>
					<div class="row">
					
					<?php foreach ( $my_videos as $post ) : setup_postdata( $post ); ?>
						
						<?php
							$url_youtube = "//www.youtube.com/embed/";
							$url_vimeo = "//player.vimeo.com/video/";
							$url_video = "";

							$textDescription = get_field('link_youtube_vimeo');
							$parsed     = parse_url($textDescription);
							$hostname   = $parsed['host'];
							$query      = $parsed['query'];
							$path       = $parsed['path'];
							$Arr = explode('v=',$query);
							$videoIDwithString = $Arr[1];
							$videoID = substr($videoIDwithString,0,11); // 5sRDHnTApSw
								if( (isset($videoID)) && (isset($hostname)) && ($hostname=='www.youtube.com' || $hostname=='youtube.com')){
									
									$url_video = $url_youtube .  $videoID;
								}
								else  if((isset($hostname)) && $hostname=='vimeo.com'){
									$ArrV = explode('://vimeo.com/',$path);
									$videoID = substr($ArrV[0],1,9); 
									$vimdeoIDInt = intval($videoID); 
									
									$url_video = $url_vimeo . $vimdeoIDInt;
								}
							?>
							<!--  APARECER VIDEO COM TITULO E CATEGORIA  -->
							<div class="col-md-4">
							<div id="recentes-controller">
							<iframe width="300" height="250" src="<?php echo $url_video; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
							
							<h5><span class="colorido"><?php echo get_the_time('d/m/Y') ?>:</span>&nbsp<?php echo the_title() ?>  </h5>
							</div>
							</div>
			
					<?php endforeach; ?>
					</div>
					</div>
					</div>
					<?php else: ?>
						<p>Nenhum vídeo inserido.</p>
					<?php endif; ?>
				
				
<!--  Entre em contato  -->
				<section id="index-contato"  class="clear">
					<div class="container pageWidth">
					<div class="intro-text">
					<div class="contact-text">
					<div class="contact-lead-in">TEM INTERESSE EM <span class="textocolorido">CONVERSAR COM A GENTE?</span></div>
					<div class="contact-heading">Turbine o crescimento de sua empresa através da solução profissionais de videos onlines</div>
					<button type="button" class="btn btn-default btn-md">QUERO ALAVANCAR A MINHA ESTRATEGIA DE VIDEOS AGORA!</button>
					
					</div>
					</div>
					</div>
				</section>
			</div>
		</div>	

<!--  conteudo da pagina -->


<?php get_footer(); ?>