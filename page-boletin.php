<?php get_header(); ?><br>
<div class="row cuerpo" id="inicio" >
<div class="row seccion-pagina">
<div class="columns grande-1 medio-2 chico-12 titulos">
            <h5>Boletin</h5>
            </div>
            <div class="columns medio-10 grande-11 chico-12">


            <?php 
                   
                    $boletin = get_page_by_title('boletin');
                    $img_nosotros = get_the_post_thumbnail_url($boletin->ID);
                    $image_id = get_post_thumbnail_id($boletin->ID);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                    // $block = get_post_block_search('boletin');
                ?>
                
                <img style="width: 900px;" alt="<?php echo $image_alt  ?>" src="<?php echo $img_nosotros  ?>"><br><br>
                <?php  echo $boletin->post_content?>
            </div>
            </div>

</div>
</div>
<?php get_footer(); ?>