@extends('main_layouts.master')
@section('title', 'OguzSoft | İletişim')
@section('orta')
    <div class="colorlib-contact">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12 animate-box">
                    <h2>Contact Information</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> 198 West 21th Street, <br> Suite 721 New
                                        York NY 10016</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355
                                            98</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-paperplane"></i></span> <a
                                            href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Bize Ulaşın</h2>
                </div>
                <div class="col-md-6">
                    <form autocomplete="off" method="post" action="{{ route('iletisim.store') }}">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6">
                                <x-blog.form.input name="first_name" placeholder="İsim" value="{{ old('first_name') }}" />

                            </div>
                            <div class="col-md-6">
                                <x-blog.form.input name="last_name" placeholder="Soyİsim"
                                    value="{{ old('last_name') }}" />

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input type='email' name="email" placeholder="Email"
                                    value="{{ old('email') }}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input name="subject" required="false" placeholder="Konu"
                                    value="{{ old('subject') }}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <!-- <label for="message">Message</label> -->
                                <x-blog.form.textarea name="message" value="{{ old('message') }}"
                                    placeholder="Mesajınız..." />

                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Gönder</button>
                        </div>
                    </form>
                    <x-blog.message :status="'succes'" />

                </div>
                <div class="col-md-6">
                    <div id="map" class="colorlib-map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
