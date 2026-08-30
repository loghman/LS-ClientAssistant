@php
    $gtmAllowedOrigins = \Ls\ClientAssistant\Helpers\Config::get('gtm.allowed_landing_origins');
    $gtmAllowedOrigins = is_array($gtmAllowedOrigins) ? array_values($gtmAllowedOrigins) : [];
@endphp
<script>
    window.__GTM_FORM_CONFIG = {!! json_encode([
        'workflowName' => $workflowData['name_en'] ?? '',
        'allowedOrigins' => $gtmAllowedOrigins,
        'isProduction' => is_production_environment(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) !!};
</script>
<script type="module" src="{{ getViteAssetUrl('resources/js/utilities/gtm-form-tracking.js') }}"></script>
