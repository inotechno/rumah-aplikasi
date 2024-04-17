@extends('layouts.app')
@section('title', 'Posts')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/sl-1.4.0/datatables.min.css" />
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Blog /</span> Posts
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header header-elements">
            <span class="me-2">Post</span>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('post.create') }}" class="btn btn-xs btn-primary"><span
                        class="tf-icon bx bx-plus bx-xs"></span>
                    Add Post</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="post-datatable" class="table dt-responsive nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category Name</th>
                            <th>Description Excerpt</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="" id="post-delete" method="POST">
        @csrf
        @method('DELETE')
    </form>
    <!--/ Basic Bootstrap Table -->
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/sl-1.4.0/datatables.min.js">
    </script>

    <script>
        $(function() {

            var table = $('#post-datatable').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, 'asc']
                ],
                ajax: {
                    url: '{{ route('post.datatable') }}',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'category.category_name',
                        name: 'category.category_name',
                    },
                    {
                        data: 'description_excerpt',
                        name: 'description_excerpt',
                        render: function(value) {
                            return "<div class='text-wrap width-200'>" + value + "</div>";
                        }
                    },
                    {
                        data: 'status_post',
                        name: 'status_post',
                        render: function(data) {
                            if (data == 'publish') {
                                return '<span class="badge bg-success">' + data + '</span>';
                            }

                            return '<span class="badge bg-warning">' + data + '</span>';
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(value) {
                            if (value === null) return "";
                            return moment(value).lang('id').format(
                                'Do MMMM YYYY h:mm:ss');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#post-datatable').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                var title = $(this).data('title');

                $('#post-delete').prop('action', "{{ url('post/delete') }}/" + id);

                Swal.fire({
                    title: "Are you sure?",
                    text: title + " will be removed",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "btn btn-primary me-3",
                        cancelButton: "btn btn-label-secondary",
                    },
                    buttonsStyling: !1,
                }).then(function(t) {
                    t.value &&
                        $('#post-delete').submit();
                });
            })
        });
    </script>
@endsection
