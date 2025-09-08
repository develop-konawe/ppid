@extends('layouts.app')

@section('title', 'Kontak')

@push('style')
@endpush

@section('content')
<section id="contact" class="bg-light pb-5">
    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-md-2 p-0">
                <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                    <span class="text-white fs-6 fw-bold ms-5">Kontak Kami</span>
                </div>
            </div>
            <div class="col-md-10 p-0">
                <div class="contact_righto  p-3 bg-white">
                    <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route('home') }}">Beranda</a> <span class="mx-2">/</span> Kontak Kami</span>
                </div>
            </div>
        </div>
        <div class="row mx-0 contact_1">
            <div class="col-md-12 p-0">
                <div class="contact_1_inner">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d324.36691692816606!2d122.04278813236361!3d-3.8547411820623756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1755515304788!5m2!1sid!2sid" height="450" style="border:0; width:100%;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 mx-0 w-75 mx-auto contact_2">
            <div class="col p-0">
                <div class="contact_left">
                    <a href="#"><img src="image/30.jpg" alt="abc" class="img-fluid"></a>
                </div>
            </div>
            <div class="col p-0">
                <div class="contact_right bg-white px-4 pt-5 pb-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="row g-3 needs-validation p-2" novalidate>
                        @csrf
                        <div class="col-md-6 has-validation">

                            <input name="first_name" value="{{ old('first_name') }}" type="text" class="@error('first_name')is-invalid @elseif(old('first_name')) is-valid @enderror form-control font_13" id="first" placeholder="First Name" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input name="last_name" value="{{ old('last_name') }}" type="text" class="@error('last_name')is-invalid @elseif(old('last_name')) is-valid @enderror form-control font_13" id="last" placeholder="Last Name" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">

                            <input name="email" value="{{ old('email') }}" type="email" class="@error('email')is-invalid @elseif(old('email')) is-valid @enderror form-control font_13" id="email" placeholder="Email" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">

                            <input name="subject" value="{{ old('subject') }}" type="text" class="@error('subject')is-invalid @elseif(old('subject')) is-valid @enderror form-control font_13" id="email" placeholder="Subjek" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <textarea name="message" id="message" placeholder="Your Message" class="@error('message')is-invalid @elseif(old('message')) is-valid @enderror form-control form_text font_13" required="">{{ old('message') }}</textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check font_13">
                                <input name="agree" value="1" {{ old('agree') ? 'checked' : '' }} class="form-check-input @error('agree')is-invalid @elseif(old('agree')) is-valid @enderror" type="checkbox" value="" id="invalidCheck" required="">
                                <label class="form-check-label" for="invalidCheck">
                                    Before registration read our <a href="#">Privacy Statement</a> and <a href="#">Terms &amp; Conditions</a>
                                </label>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                @error('agree')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 center_sm">
                            <button class="btn btn-primary button p-3 px-4 border-0 rounded-0 w-100 font_13 fw-bold" type="submit">Send Message</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endpush
