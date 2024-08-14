<?php $name = str_replace([' ',',','_',':','(',')',';'],'',$brand_name)?>
const CACHE_NAME = '<?=$name?>cache-v1';
const DATA_CACHE_NAME = '<?=$name?>data-cache-v1';

const FILES_TO_CACHE = [
    '/',
    '/pwa/offline.html'  // صفحه سفارشی آفلاین
];

// نصب سرویس ورکر و کش کردن فایل‌های اولیه
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('[Service Worker] Pre-caching offline page and essential files');
            return cache.addAll(FILES_TO_CACHE);
        })
    );
    self.skipWaiting();
});

//فعال‌سازی سرویس ورکر و پاک کردن کش‌های قدیمی
self.addEventListener('activate', event => {
    const currentCaches = [CACHE_NAME, DATA_CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return cacheNames.filter(cacheName => !currentCaches.includes(cacheName));
        }).then(cachesToDelete => {
            return Promise.all(cachesToDelete.map(cacheToDelete => {
                return caches.delete(cacheToDelete);
            }));
        }).then(() => self.clients.claim())
    );
});

// مدیریت درخواست‌ها
self.addEventListener('fetch', event => {
    const requestUrl = new URL(event.request.url);

    // مدیریت درخواست‌های API
    if (event.request.url.includes('/api/')) {
        event.respondWith(
            caches.open(DATA_CACHE_NAME).then(cache => {
                return fetch(event.request)
                    .then(response => {
                        // اگر پاسخ موفقیت‌آمیز بود، آن را در کش ذخیره کنید
                        if (response.status === 200) {
                            cache.put(event.request.url, response.clone());
                        }
                        return response;
                    })
                    .catch(() => {
                        // اگر درخواست به اینترنت ناموفق بود، از کش استفاده کنید
                        return cache.match(event.request);
                    });
            })
        );
        return;
    }

    // کش پویا برای تصاویر و دیگر منابع
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request).then(response => {
                return caches.open(CACHE_NAME).then(cache => {
                    cache.put(event.request.url, response.clone());
                    return response;
                });
            });
        }).catch(() => {
            // نمایش صفحه آفلاین سفارشی
            if (event.request.mode === 'navigate') {
                return caches.match('/pwa/offline.html');
            }
        })
    );
});