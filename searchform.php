<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <div class="search-wrapper">
        <input type="search" 
               class="search-field" 
               placeholder="Tìm kiếm..." 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               aria-label="Search" />
        <button type="submit" class="search-submit">
            <i class="fas fa-search"></i>
            <span class="screen-reader-text">Tìm kiếm</span>
        </button>
    </div>
</form>
