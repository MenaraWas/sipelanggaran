const CACHE_NAME = 'sipelanggaran-v3';
const PRECACHE_URLS = [
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

// Fetch: Network-First Strategy 
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;
    if (!(event.request.url.indexOf('http') === 0)) return;
    
    // Jangan cache endpoint livewire
    if (event.request.url.includes('/livewire/')) return;

    event.respondWith(
        // Coba fetch dari internet (Network) dulu
        fetch(event.request)
            .then((networkResponse) => {
                // Simpan/update cache terbaru di background
                return caches.open(CACHE_NAME).then((cache) => {
                    cache.put(event.request, networkResponse.clone());
                    return networkResponse;
                });
            })
            .catch(() => {
                // Jika tidak ada koneksi internet, ambil dari Cache
                return caches.match(event.request);
            })
    );
});
