
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" 
           class="search-field" 
           placeholder="Tìm kiếm..." 
           value="<?php echo get_search_query(); ?>" 
           name="s" 
           title="Tìm kiếm:" />
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
    </button>
</form>