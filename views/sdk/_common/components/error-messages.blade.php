{{--Messages--}}
@if(isset($_SESSION['success_messages']))
    <script type="module">
        @foreach($_SESSION['success_messages'] as $error)
        @if(is_string($error))
        toast('{{ $error }}')
        @endif
        @endforeach
    </script>
    @php
        unset($_SESSION['success_messages'])
    @endphp
@endif

{{--Errors--}}
@if(isset($_SESSION['error_messages']))
    <script type="module">
        @foreach($_SESSION['error_messages'] as $error)
        @if(is_string($error))
        toast('{{ $error }}', 'danger')
        @endif
        @endforeach
    </script>
    @php
        unset($_SESSION['error_messages'])
    @endphp
@endif
