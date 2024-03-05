@extends('layout.mainlayout')

@section('content')

    <!-- 404 Area Start -->
    <section class="four-zero-four" style="height: 100vh">
        <img class="bg-img" src="assets/images/404-bg.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <img src="assets/images/404.png" alt="">
                        <div class="inner-content">
                            <h4 class="title">
                                Oops,
                                Something went wrong !
                            </h4>
                            <a href="/index" class="mybtn1"><i class="fas fa-angle-double-left"></i> BACK TO HOME</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 404 Area End -->

@endsection






