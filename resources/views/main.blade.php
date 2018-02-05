
@extends('master')
@section('variables')
 @if(!empty($companies))
    <script>
        window.items = {!! json_encode($items) !!};
    </script>

    @endif
@endsection
