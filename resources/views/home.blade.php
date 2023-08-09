<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Hubspot User</title>
    @include('layouts.link')
</head>
<body>
    @include('layouts.navbar')  
    <div class="container mt-3">
        <table class="table table-responsive table-hover user_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Last Modified</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('hubspot.user') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'createdate',
                        name: 'createdate'
                    },
                    {
                        data: 'lastmodifieddate',
                        name: 'lastmodifieddate'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
</body>
</html>
