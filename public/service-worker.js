const CACHE_NAME = 'sikma-fkip-ceria-v1';
const BASE_URL = '/SIKMA_FKIP_CERIA/';
const ASSETS_TO_CACHE = [
  BASE_URL,
  BASE_URL + 'index.php',
  BASE_URL + 'public/assets/css/bootstrap.min.css',
  BASE_URL + 'public/assets/css/icons.min.css',
  BASE_URL + 'public/assets/css/app.min.css',
  BASE_URL + 'public/assets/css/custom.css',
  BASE_URL + 'public/assets/js/app.js',
  BASE_URL + 'public/assets/images/logo.png',
  BASE_URL + 'public/assets/images/logo-sm.png',
  BASE_URL + 'public/favicon.ico'
];

// Install Event - Cache essential assets
self.addEventListener('install', event => {
  console.log('[Service Worker] Installing...');
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log('[Service Worker] Caching essential assets');
      return cache.addAll(ASSETS_TO_CACHE).catch(err => {
        console.warn('[Service Worker] Some assets could not be cached:', err);
      });
    })
  );
  self.skipWaiting();
});

// Activate Event - Clean up old caches
self.addEventListener('activate', event => {
  console.log('[Service Worker] Activating...');
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            console.log('[Service Worker] Removing old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Fetch Event - Network first, fallback to cache
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip non-GET requests
  if (request.method !== 'GET') {
    return;
  }

  // Skip external URLs
  if (!url.pathname.includes(BASE_URL)) {
    return;
  }

  // Network-first strategy
  event.respondWith(
    fetch(request)
      .then(response => {
        // Cache successful responses
        if (response && response.status === 200) {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then(cache => {
            cache.put(request, responseToCache);
          });
        }
        return response;
      })
      .catch(() => {
        // Fallback to cache if network fails
        return caches.match(request).then(response => {
          return response || new Response(
            '<h1>Offline</h1><p>This resource is not available offline.</p>',
            { headers: { 'Content-Type': 'text/html' } }
          );
        });
      })
  );
});
