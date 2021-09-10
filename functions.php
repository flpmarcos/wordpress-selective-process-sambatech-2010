<?php
//ABILITART CÓDIGO PHP DENTRO DE WIDGET
function execute_php($html){
     if(strpos($html,"<"."?php //")!==false){
          ob_start();
          eval("?"."><!-- -->".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}
add_filter('widget_text','execute_php',100);

//REGISTRO DO SIDEBAR UTILIZADO NO RODAPE

/*
    register_sidebar(array(
        'name'          => 'RodapeDinamicoesquerda',
        'before_widget' => '<div id="rodape-widget-right" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
 */
 

/*register sidebar widgets*/

if ( function_exists('register_sidebar') )
  

	    register_sidebar(array(
		'name' => __( 'menu-social' ),
		'id' => '1-widget-area',
		'description' => __( '1 area de widget' ),
		'before_widget' => '<li id="%1$s" class="%2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
    ));
	
	register_sidebar(array(
		'name' => __( 'nos-encontre' ),
		'id' => '2-widget-area',
		'description' => __( '2 area de widget' ),
		'before_widget' => '<li id="%1$s" class="%2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4>',
		'after_title' => '</h4></br></br>
		<div id="widgets-controller">
			<div id="sabatech-widgets">
				<h5>Sabatech<h5></br>
				<button type="button" class="btn btn-default btn-xs" ><a href="www.google.com"><i class="fa fa-facebook" aria-hidden="true fa-3x"></i></button></a>
				<button type="button" class="btn btn-default btn-xs"><a href="www.google.com"><i class="fa fa-twitter" aria-hidden="true fa-3x"></i></button></a>
				<button type="button" class="btn btn-default btn-xs"><a href="www.google.com"><i class="fa fa-linkedin" aria-hidden="true fa-3x"></i></button></a>
			</div>
			<div id="ciclus-widgets">
				<h5>Ciclus<h5></br>
				<button type="button" class="btn btn-default btn-xs"><a href="www.google.com"><i class="fa fa-facebook" aria-hidden="true fa-3x"></i></button></a>
				<button type="button" class="btn btn-default btn-xs"><a href="www.google.com"><i class="fa fa-twitter" aria-hidden="true fa-3x"></i></button></a>
				<button type="button" class="btn btn-default btn-xs"><a href="www.google.com"><i class="fa fa-linkedin" aria-hidden="true fa-3x"></i></button></a>
			</div>
		</div>
	',
    ));

	
//ESCONDER MENUS DE ACESSO ADMINISTRATIVO
function hide_menu() {
/*	   remove_submenu_page( 'index.php', 'update-core.php' );
       remove_submenu_page( 'themes.php', 'themes.php' );
       remove_submenu_page( 'themes.php', 'theme-editor.php' );
       remove_submenu_page( 'themes.php', 'theme_options.php' );
	   remove_submenu_page( 'customize.php', 'customize.php' );
	   remove_submenu_page( 'tools.php', 'tools.php' );
	   remove_submenu_page( 'tools.php', 'import.php' );
	   remove_submenu_page( 'tools.php', 'export.php' );
	   remove_submenu_page( 'options-general.php', 'mr_social_sharing' );
	   remove_submenu_page( 'options-general.php', 'wlcms-plugin.php' );
	   remove_submenu_page( 'options-general.php', 'vipers-video-quicktags' );
	   remove_menu_page( 'plugins.php' );
	   remove_menu_page( 'rs-produto-restrictions' );
	   remove_menu_page( 'rs-options' );
	   remove_menu_page( 'wpcf' );
	   remove_menu_page( 'edit.php' );
	   remove_menu_page( 'edit-comments.php' );	   */
}
add_action('admin_head', 'hide_menu');

//esconde cor de perfil
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');


//ESCONDE AJUDA
function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
          </style>';
}
add_action('admin_head', 'hide_help');

//ESCONDER BARRA SUPERIOR DE EDIÇÃO NO SITE
function my_function_admin_bar(){
  return false;
}
add_filter( "show_admin_bar" , "my_function_admin_bar");

//DEFINIÇÕES DIRETAS 
define('SB_POST_PER_PAGE', 10);

//ADICIONAR FEATURED GALLERY AOS POSTTYPES NECESSÁRIOS
/*
function add_featured_galleries_to_posttypes() {
	$arr[] = 'evento';
	return $arr;
}
add_action( 'fg_post_types', 'add_featured_galleries_to_posttypes' );
*/

//REGISTRA MENU DE REDES SOCIAIS
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'social-menu', 'Menu de redes sociais' );
}

//MOSTRA MENU
function sambatech_show_menu($nomeMenu, $idMenu){
	wp_nav_menu( array(
		'menu' => $nomeMenu,
		'echo' => true,
		'menu_id' => $idMenu,
	) );		
}

//MONTA MENU PRINCIPAL A PARTIR DAS PAGINAS MARCADAS COMO MENU=PRINCIPAL
function sambatech_menu_principal($idMenu){
	$primeiro = ' class="primeiroLi" ';
	$args = array(
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'meta_key' => 'menu',
		'meta_value' => 'principal',
		'post_type' => 'page',
		'post_status' => 'publish',
		'hierarchical' => 0
	); 
	$pages = get_pages($args);
		
	$html = '<ul id="' . $idMenu . '">';
	$html = $html . '<li>' ;
	$html = $html . '<a href="'. get_bloginfo('url') . '">HOME';
	$html = $html . '</a>';
	$html = $html . '</li>';
	
	foreach($pages as $page){
		$maispad = 'class="mainMenu"';
		$html = $html . '<li'. $primeiro .' >';
		$sub = sambatech_submenu_principal($page->ID);
		if ($sub == ''){
			$html = $html . '<a ' . $maispad .' href="' . $page->guid . '">' . $page->post_title .'</a>';
		} else {
			$html = $html . '<a ' . $maispad .' href="#">' . $page->post_title .'</a>';
			$html = $html . $sub;
		}
		$html = $html . '</li>';
		$primeiro = '';
	}
	$html = $html . '</ul>';
	return $html;	
}

//Retorna SUBMENU
function sambatech_submenu_principal($idPai){
	$primeiro = ' class="primeiroLi" ';
	$args = array(
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'post_type' => 'page',
		'post_status' => 'publish',
		'hierarchical' => 0,
		'parent' => $idPai,
	); 
	$pages = get_pages($args);
	if(sizeof($pages) == 0){
		return '';
	}
	$html = '<ul id="sub_'.$idPai.'" class="submenuPrincipal">';
	foreach($pages as $page){
		$html = $html . '<li'. $primeiro .'><a href="' . $page->guid . '">' . $page->post_title .'</a></li>';
		$primeiro = '';
	}
	$html = $html . '</ul>';
	return $html;	
}

//OBTEM IMAGEM DESTACADA
function sambatech_get_destacada($idPost){
	if (has_post_thumbnail($idPost)){
		$imgSrc = wp_get_attachment_image_src(get_post_thumbnail_id($idPost), 'full');
		$src = $imgSrc[0];
	} else {
		$src = get_template_directory_uri() . '/images/image-not-found.png';
	}
	return $src;
}

//FUNCAO GENERICA PARA RETORNAR POSTS DE CHAMADA DESTAQUE
function sambatech_posts_destaque($divClass, $postType, $slugCategory='', $qtd=5){
	$getPag = $divClass . 'Pag';
	$atualPage = $_GET[$getPag];
	if($atualPage == 0 || $atualPage == null || $atualPage == ''){
		$atualPage = 1;
	}
	$offSet = (($qtd * $atualPage) - $qtd);
	$args = array (
		'order' => 'DESC',
		'orderby' => 'post_date',
		'post_type' => $postType,
		'post_status' => 'publish',
		'category_name' => $slugCategory,
		'posts_per_page'   => $qtd,
		'offset' => $offSet,
	);
	$postagens = get_posts($args);
	$html = '';
	foreach($postagens as $postagem): setup_postdata($postagem);
		$link = get_post_meta( $postagem->ID, 'link', true );
		if ($link == '' || $link == null){
			$link = $postagem->guid;
			$target = '';
		} else {
			$target = ' target="_blank" ';
		}
		$coment = $postagem->comment_count;
		if ($coment == 1){
			$coment = $coment . ' comentário';
		} else {
			$coment = $coment . ' comentários';
		}
		$html = $html . '<div id="video-principal" >';
			$html = $html . '<div id="video-controller" >';
				$html = $html . '<div id="video-conteudo">';
				$html = $html . '<a href="' . $link . '" ' . $target . ' >';
				//area de conteudo do video
				$html = $html .		the_content();
				$html = $html . ' </a>';
				$html = $html . '</div>';
				//divisão de comentarios
				$html = $html . '<div id="video-comentarios">';
				$html = $html . sambatech_comentario_atual($postagem->ID);
				$html = $html . '</div>';
		$html = $html . '</div>';
		//area de informações sobre o video
			$html = $html . '<div id="video-informacao" class="clear">';
					$html = $html . '<div destaque-titulo><span class="colorido">'. sambatech_pegar_categoria($postagem->ID). '</span><p>'. get_the_title($postagem->ID).'</p></div> ';
					$html = $html . '<div destaque-data><p>'. get_the_time('d/m/Y', $postagem->ID). '</p></div>';
					$html = $html . '<div destaque-descricao><p>' . $postagem->descricao . '</p></div>';
					$html = $html . '<button type="button" class="btn btn-default btn-sm">Baixe o Material</button> ';
					$html = $html . '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-facebook" aria-hidden="true fa-3x"></i></button>';	
					$html = $html . '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-twitter" aria-hidden="true fa-3x"></i></button>';	
					$html = $html . '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-linkedin" aria-hidden="true fa-3x"></i></button>';			
			$html = $html . '</div>';
		$html = $html . '</div>';
	endforeach;
	$html = $html . '';
	return $html;
}

function sambatech_comentario($id){
$args = array(
	'post_id' => 1, // use post_id, not post_ID
        'count' => true //return only the count
);
$comments = get_comments($args);
foreach($comments as $comment) :
	echo($comment->comment_author . '<br />' . $comment->comment_content);
endforeach;
echo $comment;
}




//pega o nome das categorias dos post's
function sambatech_pegar_categoria($id){
$categoria = get_the_category($post->id);
$nomeCategoria = '['.$categoria[0]->cat_name.']';
return $nomeCategoria;
}


//FUNCAO GENERICA PARA RETORNAR POSTS DE CHAMADA CLASSIFICADOS
function sambatech_posts_classificados($divClass, $postType, $slugCategory='', $qtd){
	$args = array (
	    'numberposts' => $qtd,
		'order' => 'ASC',
		'orderby' => 'post_date',
		'post_type' => $postType,
		'post_status' => 'publish',
		'posts_per_page'   => 4,
		
		);	
	$postagens = get_posts($args);
	$html = $html . '<aside class="classificados">';
	$html = $html . ' <div class="container">';
	$html = $html . '<div class="row">';
	$html = $html . '<div id="mais-rankeados"><h4>VIDEOS MAIS RANKEADOS</h4></div>';
	    foreach($postagens as $postagem){
			$html = $html . '<div id="classificados-item" class="col-md-3 col-sm-6">';
			$html = $html . '<div destaque-titulo>'. sambatech_pegar_categoria($postagem->ID). '<p>'. get_the_title($postagem->ID).'</p></div>';
			$html = $html . '</a>';
			$html = $html . '</div>';
		}
	$html = $html . '</div>';
	$html = $html . '</div>';
	$html = $html . '</aside>';
	return $html;
}


//FUNCAO GENERICA PARA RETORNAR POSTS DE CHAMADA RECENTES
function sambatech_posts_recentes($divClass, $postType, $slugCategory='', $qtd){
	$args = array (
	    'numberposts' => $qtd,
		'order' => 'ASC',
		'orderby' => 'post_date',
		'post_type' => $postType,
		'post_status' => 'publish',
		'posts_per_page'   => 6,
		
		);	
	$postagens = get_posts($args);
	$html = $html . '<aside class="recentes">';
	$html = $html . ' <div class="container">';
	$html = $html . '<div class="row">';
	    foreach($postagens as $postagem){
			$html = $html . '<div id="recentes-item" class="col-md-3 col-sm-6">';
			$html = $html . '<div recente-titulo>'. get_the_time('d/m/Y', $postagem->ID) .sambatech_pegar_categoria($postagem->ID). '<p>'. get_the_title($postagem->ID).'</p></div>';
			$html = $html . '</div>';
		}
	$html = $html . '</div>';
	$html = $html . '</div>';
	$html = $html . '</aside>';
	return $html;
}



//CONTA TOTAL DE POSTS
function softbis_total_posts($postType, $slugCategory=''){
	$args = array (
		'post_type' => $postType,
		'post_status' => 'publish',
		'category_name' => $slugCategory,
	);
	$postagens = get_posts($args);
	$total = sizeof($postagens);
	return $total;
}


//LISTAR CATEGORIAS
function sambatech_listar_categorias(){
	$args = array(
		'orderby' => 'name',
		'order' => 'ASC',
		'taxonomy' => 'category',
	);
	$categories = get_categories($args);
	$html = '';
	foreach($categories as $category) { 
		$postArgs = array(
			'post_type' => 'noticia',
			'post_status' => 'publish',
			'category_name' => $category->slug,
		);
		$posts = get_posts($postArgs);
		$html = $html . '<div class="cat-item">';
		$html = $html . '	<a href="?category='.$category->slug.'&catname='.$category->name.'">';
		$html = $html . '		<div class="cat-titulo">'.$category->name.' ('.count($posts).')</div>';
		$html = $html . '		<div class="cat-marcador"></div>';
		$html = $html . '	</a>';
		$html = $html . '</div>';
	}
	return $html;
}


/*RETORNA IMAGENS DA GALERIA
function sambatech_galeria($postId){
	$html = '';
	$galleryArray = get_post_gallery_ids($postId); 
	foreach ($galleryArray as $id) { 
	$html = $html . '<div class="image-galery">';
	$html = $html . '	<a href="' . wp_get_attachment_url($id) . '" data-litebox-group="'.$postId.'" class="litebox">';
	$html = $html . '		<img id="' . $id . '" src="' . wp_get_attachment_url($id) . '" onclick="abrirImagemGaleria('. $id .');">';
	$html = $html . '	</a>';
	$html = $html . '</div>';
	}
	return $html;	
}

*/
//funcao que retorna a logo de forma dinamica


function sambatech_chama_logo($divClass, $postType, $slugCategory='', $qtd){
	$args = array (
	    'numberposts' => $qtd,
		'order' => 'ASC',
		'orderby' => 'post_date',
		'post_type' => $postType,
		'post_status' => 'publish',
		'posts_per_page'   => 1,
		
		);	
	$postagens = get_posts($args);
	    foreach($postagens as $postagem){
	
		$html = $html . '<img id="image-logo"   src="' .sambatech_get_destacada($postagem->ID). '">';
		$html = $html . '</img></a>';
		return $html;
}
}


//funcao que retorna o footer
function sambatech_chamado_footer($pageid, $i){
	 $pagina = get_post($pageid);
	 $html = '';
	 $html = $html . '<div id="footer-copyright" >';
	 $html = $html . ' <div class="container pageWidth">';
	 $html = $html . ' <div class="row">';
	 $html = $html . ' <div id="copyright-controller" class="col-md-4">';
	 $html = $html . '<span class="list-inline copyright">Copyright &copy; Samba Tech e Ciclos.Todos os direitos reservados'. '</span>';
	 $html = $html . '</div>';
	 $html = $html . '<div id="copyright-controller-detail" class="col-md-4">';
	 $html = $html . '<ul  class="list-inline quicklinks">';
	 $html = $html . '<li>Powered by <img id="image-logo"   src="'.get_template_directory_uri().'/images/imagemfooter.png"</img>';
	 $html = $html . '</li>';
	 $html = $html . '</ul>';
	 $html = $html . '</div>';
	 $html = $html . '</div>';
	 $html = $html . '</div>';
	 $html = $html . '</div>';
	 return $html;
}

function sambatech_pagina_contato($pageid, $i){
	$pagina = get_post($pageid);
	$html = '';
	$html = $html . '<header> ';
	$html = $html . ' <div class="container">';
	$html = $html . '<div class="intro-text">';
	$html = $html . '<div class="intro-lead-in">'.$pagina->subtitulo . '</div>';
	$html = $html . ' <div class="intro-heading">' .$pagina->post_content . '</div>';
	$html = $html . ' <a href="#services" class="page-scroll btn btn-xl">Leia mais...</a>';
	$html = $html . '</div>';
	$html = $html . '</div>';
	$html = $html . '</header>';
	return $html;
}



/*ADICIONANDO VIDEO AO SITE*/

//Código para criar Custom Post Type.
add_action('init', 'videos_registrer');
function videos_registrer(){
     $labels = array(
        'name' => _x('Vídeos', 'post type general name'),
        'singular_name' => _x('Vídeos', 'post type singular name'),
        'add_new' => _x('Adicionar vídeo', 'vídeo'),
        'add_new_item' => __('Adicionar novo vídeo'),
        'edit_item' => __('Editar vídeo'),
        'new_item' => __('Novo vídeo'),
        'view_item' => __('Ver vídeo'),
        'search_items' => __('Procurar vídeo'),
        'not_found' =>  __('Nada encontrado'),
        'not_found_in_trash' => __('Nada encontrado no lixo'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true, // Habilitando o uso do template de arquivo o archive-videos.php
        'menu_icon'   => 'dashicons-format-video',
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug'=>'video'), // Nome que vai ser usado para gerar o link permanente 
        'menu_position' => 6,
        'supports' => array('title'),
       // 'taxonomies' => array('category_noticias'), // Informado qual taxonomia (grupo de categorias) este post type vai usar
      );
    register_post_type('videos',$args);
}

// Obter ID e URL do youtube.
function base_get_youtube_id($ytURL) {
    $ytvIDlen = 11; // This is the length of YouTube's video IDs
    // The ID string starts after "v=", which is usually right after 
    // "youtube.com/watch?" in the URL
    $idStarts = strpos($ytURL, "?v=");
    // In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
    // bases covered), it will be after an "&":
    if($idStarts === FALSE)
        $idStarts = strpos($ytURL, "&v=");
    // If still FALSE, URL doesn't have a vid ID
    if($idStarts === FALSE):
        return FALSE;
        die("YouTube video ID not found. Please double-check your URL.");
    endif;  
    // Offset the start location to match the beginning of the ID string
    $idStarts +=3;
    // Get the ID string and return it
    $ytvID = substr($ytURL, $idStarts, $ytvIDlen);
    
    return $ytvID;
    
}
// Obter thumbnail do youtube
function base_the_youtube_thumb($youtube_url){
    echo '<img class="img-videos" src="http://img.youtube.com/vi/'.base_get_youtube_id($youtube_url).'/0.jpg" />';
}


$url_youtube = "//www.youtube.com/embed/";
    $url_vimeo = "//player.vimeo.com/video/";
    $url_video = "";

    $textDescription = get_field('link_video_youtube_vimeo');
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



// Chamada customizada de comentários
function sambatech_comentario_atual($id){	
//$comment_array = array_reverse(get_approved_comments($id));
$comment_array = get_comments('status=approve&amp;number=5');
$count = 1;
 if ($comment_array) { 
	$html = '';
	$html = $html . '<div id="comentario-controller">';
	$html = $html . '<div id="comentario-titulo">COMENTÁRIOS</div>';
foreach($comment_array as $comment){ 
if ($count++ <= 99999) { 
    $html = $html . '<div id="comentario-conteudo">';
	$html = $html . '<span id="comment-title">'. $comment->comment_author .'&nbsp;&nbsp'.  $comment->comment_date_gmt .'</span></br>';
	$html = $html . '<span id="comment-content">'. $comment->comment_content .'</span>';
	$html = $html . '</div>';
} 
} 
	$html = $html . '<form id="cometario-formulario">';
	$html = $html . '<textarea name="comment" id="comment" rows="" cols="" placeholder="ESCREVA SEU COMENTÁRIO AQUI"></textarea>';
	$html = $html . '</form>';
} 

 else { 
	 $html = $html . '<h4>Os comentários estão fechados.</h4>';
} 
	$html = $html . '</div>';

	return $html;
}



		
function sambatech_comentarios_aprovados($post_id) {
	global $wpdb;
	return $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' ORDER BY comment_date", $post_id));
}	



function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
 $GLOBALS['comment_depth'] = $depth;
  ?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    <div class="comment-author vcard"><?php commenter_link() ?></div>
    <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'seu-template'),
       get_comment_date(),
       get_comment_time(),
       '#comment-' . get_comment_ID() );
       edit_comment_link(__('Edit', 'seu-template'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'seu-template') ?>
          <div class="comment-content">
        <?php comment_text() ?>
    </div>
  <?php // echo the comment reply link
   if($args['type'] == 'all' || get_comment_type() == 'comment') :
    comment_reply_link(array_merge($args, array(
     'reply_text' => __('Reply','seu-template'),
     'login_text' => __('Log in to reply.','seu-template'),
     'depth' => $depth,
     'before' => '<div class="comment-reply-link">',
     'after' => '</div>'
    )));
   endif;
  ?>
<?php } // end custom_comments

// Chamada customizada para listar trackbacks
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
      <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
       <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'seu-template'),
         get_comment_author_link(),
         get_comment_date(),
         get_comment_time() );
         edit_comment_link(__('Edit', 'seu-template'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'seu-template') ?>
            <div class="comment-content">
       <?php comment_text() ?>
   </div>
<?php } // end custom_pings

// Produz um avatar compatível com hCard
function commenter_link() {
 $commenter = get_comment_author_link();
 if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
  $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
 } else {
  $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
 }
 $avatar_email = get_comment_author_email();
 $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
 echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link	








//CONTAGEM DE VIEWS DENTRO DO POSTS

function wpmidia_set_post_views($postID) {
 
    $cookie = strtotime(date('Y-m-d'));
     $pv_url = 'wpmidia_'.md5($_SERVER['REQUEST_URI']);
 
    if( is_single() && !isset($_COOKIE[$pv_url]) ){
 
        $count_key = '_wpmidia_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 1; //quando o usuário entra, já conta como 1 visita
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, $count);
 
            //salvo num cookie que dura 1 hora.
            setcookie($pv_url, $cookie, time()+3600, COOKIEPATH, COOKIE_DOMAIN, false); // 1 hora
 
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
 
    }
}


function wpmidia_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpmidia_set_post_views($post_id);
}
add_action( 'wp_head', 'wpmidia_track_post_views');


function wpmidia_get_post_views($postID){
    $count_key = '_wpmidia_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if( !empty($count) ){
		//return $count.' Views';
    	return 'Este post foi visto ' . $count. ' vez(es).';	
	}
}


add_filter('manage_posts_columns', 'wpmidia_posts_column_views');
function wpmidia_posts_column_views($defaults){
    $defaults['post_views'] = __('Visualizações');
    return $defaults;
}

add_action('manage_posts_custom_column', 'wpmidia_custom_column_views',5,2);
function wpmidia_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
		$count = get_post_meta($id, '_wpmidia_post_views_count', true);
		if( !empty($count) ){
			echo $count. ' visualização(ões)';	
		}
    }
}







?>