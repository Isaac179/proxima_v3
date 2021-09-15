<!DOCTYPE html>
<html lang="<?php echo substr(get_bloginfo ( 'language' ), 0, 2);?>">
<head>
	<meta charset="UTF-8">
	<title><?php
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
	
		$site_description = get_bloginfo( 'description', 'display' );
		
		if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	?></title>

	<meta name="description" content="Proxima" />
	<meta name="keywords" content="Startup,Empresas,in" />
	<meta name="author" content="<?php bloginfo('template_url'); ?>/humans.txt">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('template_url'); ?>/images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('template_url'); ?>/images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="icon" type="image/ico" href="<?php bloginfo('template_url'); ?>/images/favicon/favicon.ico">

	<!--LIBRERIA FAFA ICON - ISAAC 290721-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--SWIPER PORTADA ISAAC 300721-->
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

	<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<!-- Facebook Metadata /-->
	
	<?php if ( 'valpa_trabajos_pt' == get_post_type() ): $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
		
			<meta property="fb:page_id" content="proxima-startups" />
			<meta property="og:image" content="<?php echo esc_url($featured_img_url); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:description" content="Ideal para personas con experiencia en <?php $experiencia_previa = get_post_meta( $post->ID,'experiencia_previa_meta', TRUE );echo $experiencia_previa;?>"/>
			<meta property="og:title" content="Bolsa de trabajo | <?php  echo $post->post_title; ?>"/>

			
	<?php elseif ( 'single_trabajo_pt' == get_post_type()  ): ?>
			<meta property="fb:page_id" content="proxima-startups" />
			<?php if (has_post_thumbnail( $post->ID ) ): ?>
                <?php $thumb_id = get_post_thumbnail_id($post->ID); ?>
                <?php $img_src = wp_get_attachment_image_src($thumb_id, 'thumbnail'); ?>
                <?php $img_src =  $img_src[0]; ?>
                <meta property="og:image" content="<?php echo $img_src; ?>" />
           <?php  else: ?>	
              	 <meta property="og:image" content="<?php bloginfo('template_url');?>/images/avatar.jpg" />
           	<?php  endif; ?>	
			<meta property="og:type" content="article" />
			<meta property="og:description" content="<?php  echo $post->post_content; ?>  "/>
			<meta property="og:title" content="Próxima | <?php  echo $post->post_title; ?>"/>

	<?php else:  ?>
			<meta property="fb:page_id" content="proxima-startups" />
			<meta property="og:image" content="" />
			<meta property="og:description" content="Próxima."/>
			<meta property="og:title" content="StartUp"/>
		<?php endif; ?>

	<!-- Google+ Metadata /-->
	<meta itemprop="name" content="">
	<meta itemprop="description" content="Proxima.">
	<meta itemprop="image" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />

	

	<?php wp_head(); ?>
	<?php include_once('inc/analytics.php'); ?>
</head>
<body>
<div class="contacto-header">
	<div class="row contacto-botones desaparece-chico">
		 <?php if ('valpa_trabajos_pt' == get_post_type() || is_page('postulacion')):?>
		 <a href="https://www.facebook.com/" target="_Blank">Facebook</a><a href="https://www.facebook.com/" target="_Blank"></a>
		 <a href="tel:7224592339" target="_Blank">Instagram</a><a href="tel:7224592339" target="_Blank"></a>
		<?php else: ?>
		 <a href="https://www.facebook.com/" target="_Blank">Facebook</a><a href="https://www.facebook.com/" target="_Blank"></a>
		 <a href="https://www.instagram.com/" target="_Blank">Instagram</a><a href="https://www.instagram.com/" target="_Blank"></a>
		<?php endif; ?>
	</div>	
</div>
<div class="header">
	<div class="row contenedor-header">
		<div class="contacto-logo">
			<a class="contacto-logo" href="<?php $url = home_url(); echo $url; ?>">
					<img class="logo-proxima" src="<?php bloginfo('template_url');?>/images/proxima/proxima-logo.svg"/>
			</a>	
		</div>	
		<div class="row ">
			<div class=" menu-header">

			<!-- <a class="contacto-logo href="<?php $url = home_url(); echo $url; ?>"  >
					<img class="logo-proxima" src="<?php bloginfo('template_url');?>/images/proxima/proxima-logo.svg"/>
			</a>	 -->

				<?php if( is_home()) :?>
				 	<a href="<?php bloginfo('url'); ?>/boletin" data-scroll-nav="servicios">Boletín</a>
				<?php else:?>
					<a href="<?php bloginfo('url'); ?>/boletin">Boletín</a>
				<?php endif;?>
				
				<a href="<?php bloginfo('url'); ?>/empresas2">Empresas</a>

				<a href="<?php echo get_post_type_archive_link( 'trabajos_pt' ); ?>">Bolsa de trabajo</a>
					<!-- <a href="<?php echo get_post_type_archive_link( 'single-trabajos_pt' ); ?>" class="nosotros-chico">Trabajos</a> -->
				
				
				 <?php if( is_home()) : ?>
				 	<a href="<?php bloginfo('url'); ?>/servicios" data-scroll-nav="plan-eliseo" class="desaparece-chico"  class="nosotros-chico">Servicios</a>
				 	<a href="<?php bloginfo('url'); ?>/nosotros" data-scroll-nav="plan-eliseo" class="desaparece-chico"  class="nosotros-chico">Nosotros</a>
					 <!-- <a href="#" data-scroll-nav="nosotros" class="contacto-chico">Nosotros</a> -->
				<?php else:?>
					<a href="<?php bloginfo('url'); ?>/servicios" data-scroll-nav="plan-eliseo" class="desaparece-chico"  class="nosotros-chico">Servicios</a>
				 	<a  href="<?php bloginfo('url'); ?>/nosotros" class="contacto-chico">Nosotros</a>
				 <?php endif ;?>

				 <?php if( is_home()) : ?>
							 <!-- <a class="plan-eliseo desaparece-chico" href="#" target="_Blank">Consulta tu plan</a><a href="#" data-scroll-nav="plan-eliseo" ><img src="<?php bloginfo('template_url');?>/images/resultados.svg" class="icono-contacto desaparece-chico"/></a> -->
				 <?php endif ;?>
				
				 
			</div>	
		</div>	
	</div>	
</div>
	
