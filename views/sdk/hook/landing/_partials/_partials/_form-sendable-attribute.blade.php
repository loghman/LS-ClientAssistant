class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100 ajax-form"
method="POST"
data-jsc="ajax-form"
action="{{ route('hook.download', $hook['slug']) }}"