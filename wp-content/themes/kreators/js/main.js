/**
 * Kreators Theme - Main JavaScript
 * 
 * @package kreators
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initSearchToggle();
        initBackToTop();
        initStickyHeader();
        initDropdowns();
        initFavoriteButtons();
        initLazyImages();
        initSmoothScroll();
        initNewsletterForm();
        initSearchAutocomplete();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.kr-menu-toggle');
        const mobileNav = document.querySelector('.kr-main-nav');
        const body = document.body;

        if (!menuToggle || !mobileNav) return;

        // Create mobile menu overlay
        const overlay = document.createElement('div');
        overlay.className = 'kr-mobile-overlay';
        document.body.appendChild(overlay);

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleMobileMenu();
        });

        overlay.addEventListener('click', function() {
            closeMobileMenu();
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && body.classList.contains('mobile-menu-open')) {
                closeMobileMenu();
            }
        });

        function toggleMobileMenu() {
            const isOpen = body.classList.toggle('mobile-menu-open');
            menuToggle.classList.toggle('is-active', isOpen);
            mobileNav.classList.toggle('is-open', isOpen);
            overlay.classList.toggle('is-visible', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen);
            
            if (isOpen) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            body.classList.remove('mobile-menu-open');
            menuToggle.classList.remove('is-active');
            mobileNav.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            menuToggle.setAttribute('aria-expanded', 'false');
            body.style.overflow = '';
        }

        // Handle submenu toggles on mobile
        const menuItemsWithChildren = mobileNav.querySelectorAll('.menu-item-has-children > a');
        menuItemsWithChildren.forEach(function(menuItem) {
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'kr-submenu-toggle';
            toggleBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
            toggleBtn.setAttribute('aria-label', 'Toggle submenu');
            
            menuItem.parentNode.insertBefore(toggleBtn, menuItem.nextSibling);

            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const parent = this.parentNode;
                const submenu = parent.querySelector('.sub-menu');
                const isExpanded = parent.classList.toggle('is-expanded');
                
                this.setAttribute('aria-expanded', isExpanded);
                
                if (submenu) {
                    if (isExpanded) {
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    } else {
                        submenu.style.maxHeight = '0';
                    }
                }
            });
        });
    }

    /**
     * Search Toggle
     */
    function initSearchToggle() {
        const searchToggle = document.querySelector('.kr-search-toggle');
        const searchForm = document.querySelector('.kr-search-form-wrapper');
        
        if (!searchToggle || !searchForm) return;

        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const isExpanded = searchForm.classList.toggle('is-visible');
            searchToggle.setAttribute('aria-expanded', isExpanded);
            
            if (isExpanded) {
                const input = searchForm.querySelector('input[type="search"]');
                if (input) {
                    setTimeout(function() {
                        input.focus();
                    }, 100);
                }
            }
        });

        // Close on click outside
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && !searchToggle.contains(e.target)) {
                searchForm.classList.remove('is-visible');
                searchToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        const backToTop = document.querySelector('.kr-back-to-top');
        
        if (!backToTop) return;

        let ticking = false;

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    if (window.pageYOffset > 500) {
                        backToTop.classList.add('is-visible');
                    } else {
                        backToTop.classList.remove('is-visible');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });

        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Sticky Header
     */
    function initStickyHeader() {
        const header = document.querySelector('.kr-header');
        
        if (!header) return;

        let lastScroll = 0;
        let ticking = false;
        const threshold = 100;

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const currentScroll = window.pageYOffset;
                    
                    if (currentScroll > threshold) {
                        header.classList.add('is-scrolled');
                    } else {
                        header.classList.remove('is-scrolled');
                    }
                    
                    // Hide/show header on scroll direction
                    if (currentScroll > lastScroll && currentScroll > 300) {
                        header.classList.add('is-hidden');
                    } else {
                        header.classList.remove('is-hidden');
                    }
                    
                    lastScroll = currentScroll;
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    /**
     * Dropdown Menus
     */
    function initDropdowns() {
        const dropdowns = document.querySelectorAll('.kr-dropdown');

        dropdowns.forEach(function(dropdown) {
            const trigger = dropdown.querySelector('.kr-dropdown-trigger');
            const menu = dropdown.querySelector('.kr-dropdown-menu');

            if (!trigger || !menu) return;

            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns
                dropdowns.forEach(function(other) {
                    if (other !== dropdown) {
                        other.classList.remove('is-open');
                    }
                });

                dropdown.classList.toggle('is-open');
            });
        });

        // Close dropdowns on click outside
        document.addEventListener('click', function(e) {
            dropdowns.forEach(function(dropdown) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('is-open');
                }
            });
        });

        // Close dropdowns on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('is-open');
                });
            }
        });
    }

    /**
     * Favorite Buttons
     */
    function initFavoriteButtons() {
        const favoriteButtons = document.querySelectorAll('.kr-card-favorite');

        favoriteButtons.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = this.classList.toggle('is-active');
                const icon = this.querySelector('svg');
                
                // Add animation class
                this.classList.add('is-animating');
                
                setTimeout(function() {
                    btn.classList.remove('is-animating');
                }, 300);

                // You can add AJAX call here to save to favorites
                // const postId = this.dataset.postId;
            });
        });
    }

    /**
     * Lazy Load Images
     */
    function initLazyImages() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const image = entry.target;
                        
                        if (image.dataset.src) {
                            image.src = image.dataset.src;
                            image.removeAttribute('data-src');
                        }
                        
                        if (image.dataset.srcset) {
                            image.srcset = image.dataset.srcset;
                            image.removeAttribute('data-srcset');
                        }
                        
                        image.classList.add('is-loaded');
                        observer.unobserve(image);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            document.querySelectorAll('img[data-src], img[data-srcset]').forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            document.querySelectorAll('img[data-src]').forEach(function(img) {
                img.src = img.dataset.src;
            });
        }
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.kr-header')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL
                    history.pushState(null, null, targetId);
                }
            });
        });
    }

    /**
     * Newsletter Form
     */
    function initNewsletterForm() {
        const forms = document.querySelectorAll('.kr-newsletter-form');

        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = form.querySelector('input[type="email"]');
                const button = form.querySelector('button[type="submit"]');
                
                if (!email || !email.value) return;

                // Show loading state
                const originalText = button.innerHTML;
                button.innerHTML = '<span class="kr-spinner"></span>';
                button.disabled = true;

                // Simulate AJAX (replace with actual endpoint)
                setTimeout(function() {
                    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                    button.classList.add('is-success');
                    email.value = '';
                    
                    setTimeout(function() {
                        button.innerHTML = originalText;
                        button.classList.remove('is-success');
                        button.disabled = false;
                    }, 2000);
                }, 1000);
            });
        });
    }

    /**
     * Search Autocomplete
     */
    function initSearchAutocomplete() {
        const searchInputs = document.querySelectorAll('.kr-search-input');

        searchInputs.forEach(function(input) {
            let timeout = null;
            const form = input.closest('form');
            
            if (!form) return;

            // Create autocomplete container
            const autocomplete = document.createElement('div');
            autocomplete.className = 'kr-search-autocomplete';
            form.appendChild(autocomplete);

            input.addEventListener('input', function() {
                clearTimeout(timeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    autocomplete.innerHTML = '';
                    autocomplete.classList.remove('is-visible');
                    return;
                }

                timeout = setTimeout(function() {
                    // Check if kreators_ajax exists (set in functions.php)
                    if (typeof kreators_ajax === 'undefined') return;

                    fetch(kreators_ajax.ajax_url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'action=kreators_live_search&nonce=' + kreators_ajax.nonce + '&query=' + encodeURIComponent(query)
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        if (data.success && data.data.length > 0) {
                            autocomplete.innerHTML = data.data.map(function(item) {
                                return '<a href="' + item.url + '" class="kr-search-result">' +
                                    (item.thumbnail ? '<img src="' + item.thumbnail + '" alt="">' : '') +
                                    '<div class="kr-search-result-content">' +
                                        '<span class="kr-search-result-title">' + item.title + '</span>' +
                                        '<span class="kr-search-result-type">' + item.type + '</span>' +
                                    '</div>' +
                                '</a>';
                            }).join('');
                            autocomplete.classList.add('is-visible');
                        } else {
                            autocomplete.innerHTML = '<p class="kr-search-no-results">No results found</p>';
                            autocomplete.classList.add('is-visible');
                        }
                    })
                    .catch(function(error) {
                        console.error('Search error:', error);
                    });
                }, 300);
            });

            // Close autocomplete on click outside
            document.addEventListener('click', function(e) {
                if (!form.contains(e.target)) {
                    autocomplete.classList.remove('is-visible');
                }
            });

            // Close on escape
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    autocomplete.classList.remove('is-visible');
                }
            });
        });
    }

    /**
     * Animate elements on scroll
     */
    function initScrollAnimations() {
        if (!('IntersectionObserver' in window)) return;

        const animatedElements = document.querySelectorAll('[data-animate]');
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-animated');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        });

        animatedElements.forEach(function(el) {
            observer.observe(el);
        });
    }

})();
