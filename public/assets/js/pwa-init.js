// PWA Initialization Script for SIKMA FKIP CERIA

(function() {
  'use strict';

  // Register Service Worker if supported
  function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('/SIKMA_FKIP_CERIA/public/service-worker.js')
          .then(function(registration) {
            console.log('[PWA] Service Worker registered successfully');
            
            // Check for updates periodically
            setInterval(function() {
              registration.update();
            }, 60000); // Check every minute
          })
          .catch(function(error) {
            console.log('[PWA] Service Worker registration failed:', error);
          });
      });
    }
  }

  // Install prompt handler
  let deferredPrompt;

  window.addEventListener('beforeinstallprompt', function(e) {
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event for later use
    deferredPrompt = e;
    
    // Show install button if it exists
    const installBtn = document.getElementById('pwa-install-btn');
    if (installBtn) {
      installBtn.style.display = 'block';
      
      installBtn.addEventListener('click', async function() {
        if (deferredPrompt) {
          deferredPrompt.prompt();
          const { outcome } = await deferredPrompt.userChoice;
          console.log(`[PWA] User response to the install prompt: ${outcome}`);
          deferredPrompt = null;
          installBtn.style.display = 'none';
        }
      });
    }
  });

  // App installed handler
  window.addEventListener('appinstalled', function() {
    console.log('[PWA] App installed successfully');
    deferredPrompt = null;
    const installBtn = document.getElementById('pwa-install-btn');
    if (installBtn) {
      installBtn.style.display = 'none';
    }
  });

  // Handle theme changes
  function initTheme() {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
    const prefersLight = window.matchMedia('(prefers-color-scheme: light)');

    prefersDark.addEventListener('change', function(e) {
      if (e.matches) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
      }
    });

    prefersLight.addEventListener('change', function(e) {
      if (e.matches) {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
      }
    });
  }

  // Enhanced keyboard navigation
  function initKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
      // Skip link - Alt + 1
      if (e.altKey && e.key === '1') {
        const skipLink = document.querySelector('.skip-to-main');
        if (skipLink) {
          skipLink.click();
          e.preventDefault();
        }
      }
    });
  }

  // Intersection Observer for lazy loading improvements
  function initLazyLoading() {
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            if (img.dataset.src) {
              img.src = img.dataset.src;
              img.removeAttribute('data-src');
              observer.unobserve(img);
            }
          }
        });
      });

      document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
    }
  }

  // Performance observer
  function observePerformance() {
    if ('PerformanceObserver' in window) {
      try {
        // Monitor Core Web Vitals
        const perfObserver = new PerformanceObserver((list) => {
          list.getEntries().forEach((entry) => {
            console.log(`[Performance] ${entry.name}: ${entry.value}ms`);
          });
        });

        perfObserver.observe({ entryTypes: ['navigation', 'resource', 'paint', 'largest-contentful-paint'] });
      } catch (e) {
        console.log('[Performance] Observer not supported:', e);
      }
    }
  }

  // Initialize all features
  function init() {
    registerServiceWorker();
    initTheme();
    initKeyboardNavigation();
    initLazyLoading();
    observePerformance();
    
    // Log that PWA is initialized
    console.log('[PWA] SIKMA FKIP CERIA PWA initialized');
  }

  // Run when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
