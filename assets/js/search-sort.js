document.addEventListener('DOMContentLoaded', function() {
    // Sort function
    window.sortResults = function(sortBy) {
        const resultsGrid = document.querySelector('.search-results-grid');
        const results = Array.from(resultsGrid.querySelectorAll('.search-result-item'));
        
        // Show loading indicator
        resultsGrid.style.opacity = '0.6';
        resultsGrid.style.pointerEvents = 'none';
        
        // Sort results
        results.sort((a, b) => {
            switch(sortBy) {
                case 'date_desc':
                    return new Date(b.dataset.date) - new Date(a.dataset.date);
                    
                case 'date_asc':
                    return new Date(a.dataset.date) - new Date(b.dataset.date);
                    
                case 'title':
                    return a.dataset.title.localeCompare(b.dataset.title, 'vi', {
                        numeric: true,
                        sensitivity: 'base'
                    });
                    
                case 'relevance':
                default:
                    return parseInt(b.dataset.relevance) - parseInt(a.dataset.relevance);
            }
        });
        
        // Animate and reorder
        setTimeout(() => {
            // Clear grid
            resultsGrid.innerHTML = '';
            
            // Add sorted results with animation
            results.forEach((result, index) => {
                result.style.opacity = '0';
                result.style.transform = 'translateY(20px)';
                resultsGrid.appendChild(result);
                
                // Stagger animation
                setTimeout(() => {
                    result.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    result.style.opacity = '1';
                    result.style.transform = 'translateY(0)';
                }, index * 50);
            });
            
            // Remove loading state
            resultsGrid.style.opacity = '1';
            resultsGrid.style.pointerEvents = 'auto';
            
            // Update URL parameter (optional)
            updateURLParameter('sort', sortBy);
            
        }, 200);
    };
    
    // Update URL without reload
    function updateURLParameter(param, value) {
        const url = new URL(window.location.href);
        if (value === 'relevance') {
            url.searchParams.delete(param);
        } else {
            url.searchParams.set(param, value);
        }
        window.history.replaceState({}, '', url);
    }
    
    // Set initial sort from URL
    function setInitialSort() {
        const urlParams = new URLSearchParams(window.location.search);
        const sortParam = urlParams.get('sort');
        
        if (sortParam) {
            const selectElement = document.getElementById('search-sort');
            if (selectElement) {
                selectElement.value = sortParam;
                // Don't trigger sort on load to avoid double animation
            }
        }
    }
    
    // Initialize
    setInitialSort();
    
    // Add loading animation styles
    const style = document.createElement('style');
    style.textContent = `
        .search-result-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});