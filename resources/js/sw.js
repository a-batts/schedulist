import { registerRoute, setCatchHandler } from 'workbox-routing';
import {
  NetworkFirst,
  NetworkOnly,
  StaleWhileRevalidate,
  CacheFirst,
} from 'workbox-strategies';

import { precacheAndRoute } from 'workbox-precaching';

precacheAndRoute(self.__WB_MANIFEST || []);

import { offlineFallback } from 'workbox-recipes';


// Used for filtering matches based on status code, header, or both
import { CacheableResponsePlugin } from 'workbox-cacheable-response';
// Used to limit entries in cache, remove entries after a certain period of time
import { ExpirationPlugin } from 'workbox-expiration';

import { cacheNames } from 'workbox-core';

self.addEventListener('install', (event) => {
  const urls = ['/contact', '/privacy-policy', '/assignments', '/app', '/agenda', '/settings/account', '/settings/theme', '/offline'];
  const cacheName = 'pages';
  event.waitUntil(caches.open(cacheName).then((cache) => cache.addAll(urls)));
});

// Cache the Google Fonts stylesheets with a stale-while-revalidate strategy.
registerRoute(
  ({ url }) => url.origin === 'https://fonts.googleapis.com',
  new StaleWhileRevalidate({
    cacheName: 'google-fonts-stylesheets',
  })
);

// Cache the underlying font files with a cache-first strategy for 1 year.
registerRoute(
  ({ url }) => url.origin === 'https://fonts.gstatic.com',
  new CacheFirst({
    cacheName: 'google-fonts-webfonts',
    plugins: [
      new CacheableResponsePlugin({
        statuses: [0, 200],
      }),
      new ExpirationPlugin({
        maxAgeSeconds: 60 * 60 * 24 * 365,
        maxEntries: 30,
      }),
    ],
  })
);

// Block caching of specific pages
registerRoute(
  ({ url }) => url.pathname.startsWith('/admin'),
  new NetworkOnly()
);

// Cache page navigations (html) with a Network First strategy
registerRoute(
  // Check to see if the request is a navigation to a new page
  ({ request }) => request.mode === 'navigate' || (
    request.destination === "" &&
    request.mode === "cors" &&
    request.headers.get('Turbolinks-Referrer') !== null
  ),
  // Use a Network First caching strategy
  new NetworkFirst({
    // Put all cached files in a cache named 'pages'
    cacheName: 'pages',
    plugins: [
      // Ensure that only requests that result in a 200 status are cached
      new CacheableResponsePlugin({
        statuses: [200],
      }),
    ],
  }),
);

// Cache CSS, JS, and Web Worker requests with a Stale While Revalidate strategy
registerRoute(
  // Check to see if the request's destination is style for stylesheets, script for JavaScript, or worker for web worker
  ({ request }) =>
    request.destination === 'style' ||
    request.destination === 'script' ||
    request.destination === 'worker',
  // Use a Stale While Revalidate caching strategy
  new StaleWhileRevalidate({
    // Put all cached files in a cache named 'assets'
    cacheName: 'assets',
    plugins: [
      // Ensure that only requests that result in a 200 status are cached
      new CacheableResponsePlugin({
        statuses: [200],
      }),
    ],
  }),
);

addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    skipWaiting();
  }
});

// Cache images with a Cache First strategy
registerRoute(
  // Check to see if the request's destination is style for an image
  ({ request }) => request.destination === 'image',
  // Use a Cache First caching strategy
  new CacheFirst({
    // Put all cached files in a cache named 'images'
    cacheName: 'images',
    plugins: [
      // Ensure that only requests that result in a 200 status are cached
      new CacheableResponsePlugin({
        statuses: [200],
      }),
      // Don't cache more than 50 items, and expire them after 30 days
      new ExpirationPlugin({
        maxEntries: 50,
        maxAgeSeconds: 60 * 60 * 24 * 30, // 30 Days
      }),
    ],
  }),
);

// This "catch" handler is triggered when any of the other routes fail to
// generate a response.
setCatchHandler(({ event }) => {
  // The FALLBACK_URL entries must be added to the cache ahead of time, either
  // via runtime or precaching. If they are precached, then call
  // `matchPrecache(FALLBACK_URL)` (from the `workbox-precaching` package)
  // to get the response from the correct cache.
  //
  // Use event, request, and url to figure out how to respond.
  // One approach would be to use request.destination, see
  // https://medium.com/dev-channel/service-worker-caching-strategies-based-on-request-types-57411dd7652c
  switch (event.request.destination) {
    case 'document':
      // If using precached URLs:
      // return matchPrecache(FALLBACK_HTML_URL);
      return caches.match('/offline');

    /* case 'image':
      // If using precached URLs:
      // return matchPrecache(FALLBACK_IMAGE_URL);
      return caches.match(FALLBACK_IMAGE_URL);
    break;

    case 'font':
      // If using precached URLs:
      // return matchPrecache(FALLBACK_FONT_URL);
      return caches.match(FALLBACK_FONT_URL);
    break;
    */

    default:
      // If we don't have a fallback, just return an error response.
      return Response.error();
  }
});
