	<?php wp_footer(); ?>
	
		<div class="row footer-valparaiso">
			<div class=" mancha-empleo">
				<p>SiGUENOS EN FACEBOOK <a href="<?php echo get_post_type_archive_link( 'valpa_trabajos_pt' ); ?>">@PROXIMA</a></p>
			</div>

			<div class="row ">
					<div class="columns grande-12 logo-valparaiso-footer">	
						<a href="<?php $url = home_url(); echo $url; ?>"  >
							<img src="<?php bloginfo('template_url');?>/images/proxima/proxima-logo.svg" />
						</a>
						<p style="margin-left:25px;">
							San Antonio 3004 Toluca, Edo de México | Horario Lunes - Domingo 9:00 -16:00 hrs
						</p>	
					</div>	
					
				</div>
				<div class="row">
				<!-- <iframe src="https://www.google.com/maps/d/embed?mid=1ZHZU4F297jgNs-odOQP7vWkdrs3jK8xe"></iframe> -->
				<iframe src="https://snazzymaps.com/embed/329881" width="100%" height="100%" style="border:none;"></iframe>
				</div>

			<div class=" mancha-footer">

				<div>
					<div class="cuadricula">

						<div class="cuadro grande-4 chico-12 links-footer">	
						<a href="<?php echo $terms_link; ?>">
								Pròxima
							</a>
						</div>

						<div class="cuadro chico-12 grande-8 links-footer">	
							<a href="<?php echo $terms_link; ?>">
								Términos y condiciones
							</a><span>|</span>

							<a href="#">
								Todos losderechos reservados 
							</a>
							<?php 
							$term_page = get_page_by_path( 'empresa' );
							$terms_link = get_permalink($term_page);
							
				    		?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Funcionalidad auto play para Nosotros - Isaac 210721-->
	<script>
		const swiper = new Swiper('.swiper-container', {
		// Parámetros del control deslizante
		speed:1000,
		direction: 'horizontal',
		loop: true,
		autoplay:
		{
		delay: 5000,
		},
		loop: true,

		});
	</script>

	<!--TITULAR SWIPER PARA PORTADA ISAAC 220721-->
	<script>
		const swiper = new Swiper('.swiper-container', {
		// Optional parameters
		direction: 'vertical',
		loop: true,

		// If we need pagination
		pagination: {
			el: '.swiper-pagination',
		},

		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		// And if we need scrollbar
		scrollbar: {
			el: '.swiper-scrollbar',
		},
		});
	</script>

	</body>
</html>
