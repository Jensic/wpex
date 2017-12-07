<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<form role="search" method="get" class="error-404__content__search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'ex'); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="error-404__content__search-form__search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'ex'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="error-404__content__search-form__search-submit"><span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'ex'); ?></span></button>
</form>
