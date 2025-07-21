document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-btn');
    const postsContainer = document.getElementById('posts-container');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Remove active class from all buttons
            viewButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Toggle view class
            if (view === 'list') {
                postsContainer.classList.add('list-view');
            } else {
                postsContainer.classList.remove('list-view');
            }
            
            // Save preference
            localStorage.setItem('categoryView', view);
        });
    });
    
    // Restore saved view preference
    const savedView = localStorage.getItem('categoryView');
    if (savedView === 'list') {
        document.querySelector('[data-view="list"]').click();
    }
    
    // Sort functionality
    window.sortCategoryPosts = function(sortBy) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sortBy);
        
        // Add loading effect
        postsContainer.style.opacity = '0.6';
        
        // Redirect to sorted URL
        window.location.href = url.toString();
    };
    
    // Set initial sort value from URL
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    if (sortParam) {
        const sortSelect = document.getElementById('category-sort');
        if (sortSelect) {
            sortSelect.value = sortParam;
        }
    }
});