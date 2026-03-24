// Nuva.ro — Evidență financiară pentru profesioniști independenți — Service Worker
const CACHE = 'nuva-v2';

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
