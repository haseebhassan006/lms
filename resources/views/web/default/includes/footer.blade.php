@php
    $socials = getSocials();
    if (!empty($socials) and count($socials)) {
        $socials = collect($socials)->sortBy('order')->toArray();
    }

    $footerColumns = getFooterColumns();
@endphp

<footer class="footer bg-secondary position-relative user-select-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class=" footer-subscribe d-block d-md-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <strong>{{ trans('footer.join_us_today') }}</strong>
                        <span class="d-block mt-5 text-white">{{ trans('footer.subscribe_content') }}</span>
                    </div>
                    <div class="subscribe-input bg-white p-10 flex-grow-1 mt-30 mt-md-0">
                        <form action="/newsletters" method="post">
                            {{ csrf_field() }}

                            <div class="form-group d-flex align-items-center m-0">
                                <div class="w-100">
                                    <input type="text" name="newsletter_email" class="form-control border-0 @error('newsletter_email') is-invalid @enderror" placeholder="{{ trans('footer.enter_email_here') }}"/>
                                    @error('newsletter_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill">{{ trans('footer.join') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $columns = ['first_column','second_column','third_column','forth_column'];
    @endphp

    <div class="container">
        <div class="row">

            <div class="col-6 col-md-3">
                                                        <span class="header d-block text-white font-weight-bold">About US</span>

                                    <div class="mt-20">
                <p>Mojavi LMS is a fully-featured learning management system . Top instructors from around the world teach millions of students on My Mojavi. We provide the tools and skills to teach what you love.</p>
            </div>
                                            </div>
            <div class="col-6 col-md-3">
                                                        <span class="header d-block text-white font-weight-bold">Additional Links</span>

                                    <div class="mt-20">
                <p><a href="/login">- Login</a></p>

<p><a href="/register">- Register</a><br></p>

<p><a href="/blog">- Blog</a></p>

<p><a href="/contact">- Contact us</a></p>

<p><a href="/certificate_validation">- Certificate validation</a><br></p>

<p><a href="/become_instructor">- Become instructor</a><br></p>

<p><a href="/terms">- Terms &amp; rules</a></p>

<p><a href="/about">- About us</a><br></p>
            </div>
                                            </div>
            <div class="col-6 col-md-3">
                                                        <span class="header d-block text-white font-weight-bold">Similar Businesses</span>

                                    <div class="mt-20">
                <p><a href="https://www.udemy.com/">- Udemy</a></p>

<p><a href="https://www.skillshare.com/">- Skillshare</a></p>

<p><a href="https://www.coursera.org/">- Coursera</a></p>

<p><a href="https://www.linkedin.com/learning/">- Lynda</a></p>

<p><a href="https://www.skillsoft.com/">- Skillsoft</a></p>

<p><a href="https://www.udacity.com/">- Udacity</a></p>

<p><a href="https://www.edx.org/">- edX</a></p>

<p><a href="https://www.masterclass.com/">- Masterclass</a><br></p>
            </div>
                                            </div>
            <div class="col-6 col-md-3">
                                                        <span class="header d-block text-white font-weight-bold">Mojavi LMS</span>

                                    <div class="mt-20">
                <p><a title="Notnt" href="https://codecanyon.net"><img src="/store/1/default_images/mojavi.png" alt="mojavi.png"></a></p>
            </div>
                                            </div>

</div>

        <div class="mt-40 border-blue py-25 d-flex align-items-center justify-content-between">
            <div class="footer-logo">
                <a href="/">

                <img src="{{ asset('store/1/default_images/mojavi.png') }}" class="img-cover" alt="footer logo" style="width: 61px;">

                </a>
            </div>
            <div class="footer-social">
                @foreach($socials as $social)
                    <a href="{{ $social['link'] }}">
                        <img src="{{ $social['image'] }}" alt="{{ $social['title'] }}" class="mr-15">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
