@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')

@endpush

@section('content')
@include(getTemplate().'.panel.assignments.image')

@endsection
@push('scripts_bottom')
<script src="/assets/vendors/cropit/jquery.cropit.js"></script>
<script src="/assets/default/js/parts/img_cropit.min.js"></script>

@endpush
