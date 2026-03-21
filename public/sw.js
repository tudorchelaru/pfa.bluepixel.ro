// PFA Expenses — Service Worker
const CACHE = 'pfa-v1';

self.addEventListener('install', function(e) {
    self.skipWaiting();
});

self.addEventListener('activate', function(e) {
    e.waitUntil(clients.claim());
});

// Network-first: always fresh data, SW satisface doar cerinta Chrome pentru install prompt
self.addEventListener('fetch', function(e) {
    e.respondWith(fetch(e.request).catch(function() {
        return caches.match(e.request);
    }));
});
