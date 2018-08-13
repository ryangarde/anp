@extends('users.layouts.app-plain')
@section('title', 'Instructions')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Terms and Conditions
                </div>
                <div class="card-body">
                    <p>
                    Welcome! Before you begin your order, please take a moment to read the Terms and
                    Conditions for this service:<br><br>

                    Important:<br>
                    <ol>
                    <li> Carefully review all fields order slip.</li>
                    <li> The system relies on email messaging to inform you of updates. Depending on actual
                    server load and network traffic, the server may take some time before it can send a confirmation
                    email for the selected order.</li>
                    <li> Depending on your email provider and configuration settings, the system-generated email
                    may be incorrectly tagged as spam and delivered to your JUNK/SPAM folder. Check your spam folder
                    for emails if no message appears in your Inbox after a considerable amount of time.</li>
                    <br>
                    TERMS AND CONDITIONS
                    <br><br>
                    This ordering system allocates items on a first come, first served basis. Limited items are
                    available and there is no guarantee that an item will always be available for a customer.
                    Initial orders are on pending status until availability is verified.
                    <br><br>
                    Customers accept the responsibility for supplying, checking, and verifying the accuracy and
                    correctness of the information they provide and consent to the collection and use of their
                    personal information.
                    <br><br>
                    Orders are reserved for only 24 hours. ANP will cancel the order unless otherwise advised by
                    the customer.
                    <br><br><br>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" onchange="document.getElementById('sendNewSms').disabled = !this.checked;">
                        I have read and understood the instructions and information on this page, and agree to the
                        Terms and Conditions on the use of this online appointment and scheduling system.<br><br>
                        <input type="submit" class="btn btn-primary" id="sendNewSms" value="Proceed" disabled="disabled" onclick="window.location='/shop';">
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                autoplay:true,
                autoplayTimeout:5000,
                loop:true,
                autoWidth:false,
                responsiveClass:true,
                center:true,
                smartSpeed:700,
                fluidSpeed:true,
                items:1
            });
        });
    </script>
@endsection
