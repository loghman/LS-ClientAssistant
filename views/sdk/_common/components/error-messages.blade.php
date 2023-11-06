{{--Messages--}}
@if(isset($_SESSION['success_messages']))
    <script>
        @foreach($_SESSION['success_messages'] as $error)
            toast('{!! $error !!}')
        @endforeach
    </script>
    @php
        unset($_SESSION['success_messages'])
    @endphp
@endif

{{--Errors--}}
@if(isset($_SESSION['error_messages']))
    <script>
        @foreach($_SESSION['error_messages'] as $error)
            toast('{!! $error !!}', 'danger')
        @endforeach
    </script>
    @php
        unset($_SESSION['error_messages'])
    @endphp
@endif
