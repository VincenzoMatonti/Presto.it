<!-- Footer -->
<footer class="text-center text-lg-start mytextcolor mynavbg shadow border-3">
    <!-- Section: Social media -->
    <section class="d-md-flex justify-content-center  p-4 border-bottom">

        <div class="d-flex justify-content-center p-4">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>{{__('ui.becameRevisor')}}</span>
                <p>{{__('ui.revisorRequest')}}</p>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div class="d-flex justify-content-center align-items-center">
                <span class="d-md-none mx-2">{{__('ui.becameRevisor')}}</span>
                <a href="{{ route('become.revisor') }}" class="me-4 text-reset">
                    <i class="fa-solid fa-envelope-open"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
        <div class="d-flex justify-content-center p-4">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>{{__('ui.becameSeller')}}</span>
                <p>{{__('ui.sellerRequest')}}</p>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div class="d-flex justify-content-center align-items-center">
                <span class="d-md-none mx-2">{{__('ui.becameSeller')}}</span>
                <a href="{{ route('become.seller') }}" class="me-4 text-reset">
                    <i class="fa-solid fa-envelope-open"></i>
                </a>
            </div>
            <!-- Right -->
        </div>

    </section>

    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4 myfootertextcolor">
                        <i class="fas fa-gem me-3"></i>{{env('APP_NAME')}}
                    </h6>
                    <p>
                        {{__('ui.prestoDescription')}}
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-5 col-lg-5 col-xl-5 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase text-center fw-bold mb-4 myfootertextcolor">
                        {{__('ui.we')}}
                    </h6>
                    <p>
                        {{__('ui.aboutUs')}}
                    </p>
                    <p class="text-center">
                        <a href="{{route('aboutUs')}}" class="myfootertextcolor">{{__('ui.ourMission')}}</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 myfootertextcolor">{{__('ui.contacts')}}</h6>
                    <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@presto.it
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="fw-bold myfootertextcolor" href="{{ route('homepage') }}">Presto.it</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->