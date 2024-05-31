@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap.min.css') }}">
    @isset($css)
        {!! $css !!}
    @endisset
@stop
@section('script')
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script>
        //Select2 basic example
        $.fn.select2.defaults.set( "theme", "bootstrap" );
         $(".select2").select2({
            // placeholder: function(){
            //     $(this).data('placeholder');
            // },
            allowClear: true
        });
    </script>
      {{-- if needed any specific and extra script  --}}
    {{ $slot }}
@stop
