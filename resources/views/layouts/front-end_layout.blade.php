<!DOCTYPE html>
<html lang="en">

<head>

@include('layouts.front-end._head')

</head>

<body id="bg">
    <div id="loading-area"></div>
    <div class="page-wraper">

            @include('layouts.front-end._topbar')

            @yield('content')

            @include('layouts.front-end._footer')
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('login.logout') }}" method="POST">
                    @csrf
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.front-end._js')

    @yield('pagejs')

</body>

</html>
