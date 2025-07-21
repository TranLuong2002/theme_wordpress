// Thêm vào main.js
document.addEventListener('DOMContentLoaded', function() {
    const paginationLinks = document.querySelectorAll('.news-pagination a');
    
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const url = this.href;
            const newsSection = document.querySelector('.news-section');
            const pagination = document.querySelector('.news-pagination');
            
            // Add loading state
            pagination.classList.add('loading');
            
            // Smooth scroll to news section
            newsSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Fetch new content
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newNewsGrid = doc.querySelector('.news-grid');
                    const newPagination = doc.querySelector('.news-pagination');
                    
                    // Update content
                    if (newNewsGrid) {
                        document.querySelector('.news-grid').innerHTML = newNewsGrid.innerHTML;
                    }
                    
                    if (newPagination) {
                        document.querySelector('.news-pagination').innerHTML = newPagination.innerHTML;
                    }
                    
                    // Remove loading state
                    pagination.classList.remove('loading');
                    
                    // Re-attach event listeners
                    attachPaginationEvents();
                })
                .catch(error => {
                    console.error('Error:', error);
                    pagination.classList.remove('loading');
                    // Fallback to normal page load
                    window.location.href = url;
                });
        });
    });
    
    function attachPaginationEvents() {
        const newPaginationLinks = document.querySelectorAll('.news-pagination a');
        newPaginationLinks.forEach(link => {
            link.addEventListener('click', arguments.callee);
        });
    }
});

// Search functionality enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Sort functionality
    window.sortResults = function(sortBy) {
        const resultsGrid = document.querySelector('.search-results-grid');
        const results = Array.from(resultsGrid.children);
        
        results.sort((a, b) => {
            switch(sortBy) {
                case 'date_desc':
                    return new Date(b.dataset.date) - new Date(a.dataset.date);
                case 'date_asc':
                    return new Date(a.dataset.date) - new Date(b.dataset.date);
                case 'title':
                    return a.querySelector('.result-title a').textContent.localeCompare(
                        b.querySelector('.result-title a').textContent
                    );
                default:
                    return 0;
            }
        });
        
        results.forEach(result => resultsGrid.appendChild(result));
    };
    
    // Smooth scroll to results after search
    if (window.location.search.includes('s=')) {
        setTimeout(() => {
            const resultsSection = document.querySelector('.search-results');
            if (resultsSection) {
                resultsSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }, 100);
    }
    
    // Track search analytics
    if (typeof gtag !== 'undefined') {
        const searchQuery = new URLSearchParams(window.location.search).get('s');
        if (searchQuery) {
            gtag('event', 'search', {
                search_term: searchQuery
            });
        }
    }
});