@extends('layout.mainlayout')

@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-contact">
        <img class="bc-img" src="assets/images/breadcrumb/contact.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="title">
                    Reset Password
                    </h4>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="/index">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <span><i class="fas fa-chevron-right"></i> </span>
                        </li>
                        <li>
                            <a href="/contact">Reset Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <!-- Contact Area End -->
    <section class="contact">
        <img class="left-img" src="assets/images/contact-left.png" alt="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <h5 class="subtitle">
                            Reset Password
                        </h5>

                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="contact-form-wrapper">
                        <div class="contact-box">
                            <h4 class="title">
                                Reset Password
                            </h4>
                            <form action="" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" {{$u_id}}>
                                <input type="password" name="password" class="input-field" placeholder="Enter new Password">
                                <button type="submit" class="mybtn1">SUBMIT NOW</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Area End -->

@endsection







