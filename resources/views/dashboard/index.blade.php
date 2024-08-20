@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Histori Smart Door-Lock Hari Ini</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('/dashboard/userlog/table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('/dashboard/partials/deleteModal')
@endsection

@push('title')
    <title>Histori Smart Lock-Door Hari Ini</title>
@endpush

@push('scripts')
    <script src="{{ asset('/vendor/template/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "pageLength": 10,
            });
        });
    </script>
@endpush
