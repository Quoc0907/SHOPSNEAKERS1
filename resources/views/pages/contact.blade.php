@extends('layout.default')

@section('main')
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="{{ route('home.index') }}" class="s-text16">Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">Contact Us</span>
</div>

<section class="contact bgwhite p-t-60 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="title-1 m-b-20">Get in Touch</h2>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-10">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2 class="title-1 m-b-20">Our Office</h2>
                <p>235/31 Nam Kỳ Khởi Nghĩa</p>
                <p>Email: voa962375@gmail.com | Phone: 0364711340</p>

                <div class="map-responsive m-t-20">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.123456789!2d106.6297!3d10.8231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f0000000000%3A0xabcdef123456789!2sHo%20Chi%20Minh%20City!5e0!3m2!1sen!2s!4v1699999999999" 
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.map-responsive{overflow:hidden;padding-bottom:56.25%;position:relative;height:0;}
.map-responsive iframe{left:0;top:0;height:100%;width:100%;position:absolute;}
</style>
@endsection
