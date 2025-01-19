<?php $name = str_replace([' ',',','_',':','(',')',';'],'',$brand_name)?>
const CACHE_NAME = '<?=$name?>cache-v1';

const OFFLINE_URL = '/pwa/offline.html';

// حذف کش‌های قدیمی در زمان فعال شدن سرویس ورکر جدید
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

// cache cdn files
self.addEventListener('fetch', (event) => {
  const requestUrl = new URL(event.request.url);
  // کش کردن تصاویر و فونت‌ها
  const staticExtensions = ['.css', '.js', '.png', '.jpg', '.jpeg', '.gif', '.svg', '.woff', '.woff2'];
  if (staticExtensions.some(ext => requestUrl.pathname.endsWith(ext))) {
    event.respondWith(
      caches.match(event.request).then((response) => {
        return response || fetch(event.request).then((networkResponse) => {
          return caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, networkResponse.clone());
            return networkResponse;
          });
        });
      })
    );
    return;
  }

 // پاسخ به درخواست‌های غیر از تصاویر و فونت‌ها
//  event.respondWith(
//    fetch(event.request).catch(() => {
//      return caches.match(OFFLINE_URL);
//    })
//  );

});

