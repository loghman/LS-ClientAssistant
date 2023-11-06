@if(isset($canEdit) and isset($editMode))
    <meta name="updateFormUrl" content="{{ route('pageEditor.store') }}">
    <meta name="route_name" content="{{ $routeName ?? '' }}">
    <meta name="entity_type" content="{{ $entityType ?? '' }}">
    <meta name="entity_id" content="{{ $entityId ?? '' }}">

    <meta name="uploader_base_url" content="{{ base_storage_url() }}">
    <meta name="storage_jwt_token" content="{{ generate_storage_jwt_token(current_user_id()) }}">
    <meta name="attachment_storage_url" content="{{ core_url('api/v1/core/file-manager/storeCKEditorFiles') }}">
    <meta name="user_token" content="{{ current_user_token() }}">

    <link rel="stylesheet" href="{{ core_url('css/page-editor.css') }}">
    <script src="{{ core_url('js/page-editor.js') }}"></script>
    <script src="{{ core_url('js/plugins/ckeditor/ckeditor.js?v=5') }}"></script>
    <script src="{{ core_url('js/plugins/highlight/highlight.min.js') }}"></script>
    <link rel="stylesheet" href="{{ core_url('js/plugins/highlight/highlight.css') }}">
    <div class="modal page-editor-modal" id="modal-editor"></div>
@endif