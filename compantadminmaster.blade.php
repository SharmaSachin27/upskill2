<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Upskill - @yield('title')</title>
    <link href="{{ asset('dist/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/a1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
</head>

<body class="sb-nav-fixed">
    @include('layout.copanyadminnavbar')
    <div id="layoutSidenav">
        @include('layout.companyadminsidebar')
        <div id="layoutSidenav_content">
            @yield('main-content')
            @include('layout.footers')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/dist/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/dist/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/dist/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/dist/assets/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        @if(session('status'))
        swal({
            title: '{{ session('
            statusCode ') }} ',
            text: '{{ session('
            status ') }}',
            icon: "success",
            button: "okay",
        });
        @endif
        $(document).ready(() => {
            $("#logo").change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#preview")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting immediately
                // Ask for confirmation before deleting
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this Record!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            let formId = this.closest('form').getAttribute('id');
                            console.log(formId)

                            document.getElementById(formId).submit();
                            swal("Poof! Your Recrod has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your Record is safe!");
                        }
                    });
            });
        });


        //Ajax call of employees status
        $('input[type="checkbox"]').change(function() {
            var employeeId = $(this).data('id');
            var status = $(this).prop('checked') ? 1 : 0;
            console.log(status);
            console.log("hheheh");
            $.ajax({
                url: '/employees/' + employeeId + '/status',
                type: 'POST',
                data: {
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    swal({
                        title: response.message,
                        text: response.message,
                        icon: "success",
                        button: "okay",
                    });
                },
                error: function(xhr) {
                    swal({
                        title: "status does not updated something went wrong",
                        text: "status does not updated something went wrong",
                        icon: "danger",
                        button: "okay",
                    });
                }
            });
        });
    </script>
</body>
</html>