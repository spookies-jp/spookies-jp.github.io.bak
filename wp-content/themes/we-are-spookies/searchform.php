<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
    <fieldset>
        <div class="input-append">
            <input type="text" name="s" id="search" placeholder="<?php _e('Search'); ?>" value="<?php the_search_query(); ?>" />
            <button type="submit" class="btn btn-primary"><?php _e("Search","bonestheme"); ?></button>
        </div>
    </fieldset>
</form>
