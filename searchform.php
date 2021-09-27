<form style="float:right; margin-right:20px; margin-top:0px; text-aling:right;" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
<i class="fa fa-search" aria-hidden="true">    
<label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        
        <input type="search" class="search-field" style="text-align:right;"
            placeholder="<?php echo esc_attr_x( 'BUSQUEDA', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label></i>
    <!-- <input type="submit" class="search-submit"
        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /> -->
        
</form>

