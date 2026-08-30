(function (window) {
    'use strict';

    if (!window || window.__gtmFormTrackingLoaded) {
        return;
    }
    window.__gtmFormTrackingLoaded = true;

    var FORM_ID = 'crm-lead-form';
    var MESSAGE_SOURCE = 'our-crm-form';
    var MESSAGE_TYPE = 'GTM_EVENT';
    var ORIGIN_PATTERN = /^https?:\/\/[^\s/]+$/i;

    var formSubmitTracked = false;

    function getConfig() {
        var config = window.__GTM_FORM_CONFIG;
        if (!config || typeof config !== 'object') {
            return {
                workflowName: '',
                allowedOrigins: [],
                isProduction: false
            };
        }

        return {
            workflowName: typeof config.workflowName === 'string' ? config.workflowName : '',
            allowedOrigins: Array.isArray(config.allowedOrigins) ? config.allowedOrigins : [],
            isProduction: config.isProduction === true
        };
    }

    function isInIframe() {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    }

    function normalizeOrigin(origin) {
        if (typeof origin !== 'string') {
            return '';
        }

        var trimmed = origin.trim().replace(/\/+$/, '');
        if (!ORIGIN_PATTERN.test(trimmed)) {
            return '';
        }

        return trimmed;
    }

    function resolvePostMessageOrigins() {
        var config = getConfig();
        var allowed = [];
        var i;
        var origin;

        for (i = 0; i < config.allowedOrigins.length; i += 1) {
            origin = normalizeOrigin(config.allowedOrigins[i]);
            if (origin && allowed.indexOf(origin) === -1) {
                allowed.push(origin);
            }
        }

        if (allowed.length > 0) {
            return allowed;
        }

        if (config.isProduction) {
            if (typeof console !== 'undefined' && typeof console.warn === 'function') {
                console.warn('[GTM] allowed_landing_origins is empty in production; postMessage was skipped. Fill configs/gtm.php before the campaign starts.');
            }
            return [];
        }

        return ['*'];
    }

    function buildFormSubmitPayload() {
        var config = getConfig();

        return {
            event: 'form-submit',
            form_id: FORM_ID,
            workflow_name: config.workflowName,
            submission_id: Date.now() + '-' + Math.random().toString(36).slice(2, 8),
            page_location: window.location.href,
            context: isInIframe() ? 'iframe' : 'standalone'
        };
    }

    function pushToDataLayer(targetWindow, payload) {
        if (!targetWindow || !payload) {
            return;
        }

        try {
            targetWindow.dataLayer = targetWindow.dataLayer || [];
            targetWindow.dataLayer.push(payload);
        } catch (e) {
            // Cross-origin parent or restricted window; expected in iframe embeds.
        }
    }

    function fireGtmFormSubmitEvent() {
        var payload = buildFormSubmitPayload();
        var origins;
        var message;
        var i;

        pushToDataLayer(window, payload);

        if (!isInIframe() || !window.parent) {
            return;
        }

        pushToDataLayer(window.parent, payload);

        origins = resolvePostMessageOrigins();
        if (origins.length === 0) {
            return;
        }

        message = {
            source: MESSAGE_SOURCE,
            type: MESSAGE_TYPE,
            payload: payload
        };

        for (i = 0; i < origins.length; i += 1) {
            try {
                window.parent.postMessage(message, origins[i]);
            } catch (e) {
                // Invalid origin or detached parent; keep other origins going.
            }
        }
    }

    function trackFormSubmitOnce() {
        if (formSubmitTracked) {
            return;
        }

        formSubmitTracked = true;
        fireGtmFormSubmitEvent();
    }

    window.isInIframe = isInIframe;
    window.buildFormSubmitPayload = buildFormSubmitPayload;
    window.fireGtmFormSubmitEvent = fireGtmFormSubmitEvent;
    window.trackFormSubmitOnce = trackFormSubmitOnce;
})(window);
