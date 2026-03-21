const CACHE_NAME = 'sipelanggaran-v2';
const PRECACHE_URLS = [
    '/admin',
    '/admin/login',
    '/icons/icon-192.png',
    '/icons/icon-512.png'
];

// Install: cache shell
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(PRECACHE_URLS))
    );
    self.skipWaiting();
});

// Activate: cleanup old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(keys.filter((k) => k !== CACHE_NAME).map((k) => caches.delete(k)))
        )
    );
    self.clients.claim();
});

// Fetch with Stale-While-Revalidate for Assets
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;
    
    // Ignore browser extensions
    if (!(event.request.url.indexOf('http') === 0)) return;

    event.respondWith(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.match(event.request).then((cachedResponse) => {
                const fetchedResponse = fetch(event.request).then((networkResponse) => {
                    cache.put(event.request, networkResponse.clone());
                    return networkResponse;
                });

                return cachedResponse || fetchedResponse;
            });
        })
    );
});
