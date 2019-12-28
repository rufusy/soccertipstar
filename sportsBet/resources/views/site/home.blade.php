@extends('layouts.frontend.index')

@section('content')
<!-- Start Wellcome Area -->
<div class="wellcome-area" id="wellcome-area">
    <div class="well-bg">
        <div class="test-overly"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="wellcome-text">
                        <div class="well-text text-center">
                            <h2>Welcome to soccertipstar</h2>
                            <p>
                                To form a winning strategy to guarantee profits to all our clients.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wellcome Area -->


<!-- Start Tips area -->
<div id="tips" class="tips-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Tips Analysis</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        @guest
                            <div class="p-3 mb-2 bg-info text-center" style="padding-top: 20px; padding-bottom: 20px; marging-bottom: 20px;">
                                <h4>Subscribe to get our premium betting tips.</h4>
                            </div>
                        @endguest

                        @yield('free_tips')
                        @yield('paid_tips')

                        <!--- Previous Tips -->
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                            <h4 class="sec-head ">Previous Tips</h4>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="">Match</th>
                                        <th class="">Market</th>
                                        <th class="">Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($playedMatches as $playedMatch)
                                    <tr>
                                        <td class="">{{ $playedMatch->match_date }}</td>
                                        <td class="">{{ $playedMatch->game }}</td>
                                        <td class="">{{ $playedMatch->odd_type }}</td>
                                        <td @if($playedMatch->outcome == 'Won') class="text-success" @else class="text-danger" @endif>{{ $playedMatch->outcome }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Previous Tips -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Tips area -->


<!-- start pricing area -->
<div id="pricing" class="pricing-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Pricing Table</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pri_table_list">
                    <h3>basic <br /> <span>$8 / 7 DAYS</span></h3>
                    <ol>
                        <li class="check">Full access to our predictions</li>
                        <li class="check">5+ Multibets daily</li>
                        <li class="check">2+ MAX stake odd</li>
                        <li class="check">Super singles</li>
                        <li class="check">24/7 support </li>
                        <li class="check">Secure online payment</li>
                    </ol>
                    <button class="signup-button">sign up now</button>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pri_table_list active">
                    <span class="saleon">top sale</span>
                    <h3>standard <br /> <span>$14 / 14 DAYS</span></h3>
                    <ol>
                        <li class="check">Full access to our predictions</li>
                        <li class="check">5+ Multibets daily</li>
                        <li class="check">2+ MAX stake odd</li>
                        <li class="check">Super singles</li>
                        <li class="check">24/7 support </li>
                        <li class="check">Secure online payment</li>
                    </ol>
                    <button class="signup-button">sign up now</button>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pri_table_list">
                    <h3>premium <br /> <span>$19 / 30 DAYS</span></h3>
                    <ol>
                        <li class="check">Full access to our predictions</li>
                        <li class="check">5+ Multibets daily</li>
                        <li class="check">2+ MAX stake odd</li>
                        <li class="check">Super singles</li>
                        <li class="check">24/7 support </li>
                        <li class="check">Secure online payment</li>
                    </ol>
                    <button class="signup-button">sign up now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End pricing table area -->

<!-- Start contact Area -->
<div id="contact" class="contact-area">
    <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2>Contact us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-mobile"></i>
                            <p>
                                Call: +254 772928599<br>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-whatsapp"></i>
                            <p>
                                Message: +254 772928599<br>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-envelope-o"></i>
                            <p>
                                Email: info@soccertipstar.com<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start  contact -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form contact-form">
                        <div id="sendmessage">Your message has been sent. Thank you!</div>
                        <div id="errormessage"></div>
                        <form id="contactForm" action="{{ route('sendMessage') }}" method="post" role="form"
                            class="contactForm">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                    data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" data-rule="minlen:4"
                                    data-msg="Please enter at least 8 chars of subject" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required"
                                    data-msg="Please write something for us" placeholder="Message"></textarea>
                                <div class="validation"></div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>
                <!-- End Left contact -->
            </div>
        </div>
    </div>
</div>
<!-- End Contact Area -->

<!-- Start About area -->
<div id="about" class="about-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>About soccertipstar</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single-well start-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-well">
                    <p>
                        {{ config('app.name') }}.com is not responsible for any decisions made,
                        financial or otherwise, based on the information,
                        emails or links provided on this website.
                        <hr>
                        Any sort of information posted on our site from other websites, persons or organizations should
                        be checked for accuracy and timeliness at the
                        sources themselves and no reliance should be placed on the same as it appears on our site.
                        <hr>
                        {{ config('app.name') }}.com does not guarantee winnings and cannot be held
                        liable for losses resulting from the use of information obtained here. We do not offer
                        bookmaking or services related to bookmaking etc. In order to place bets, you must access the
                        bookmakers" web sites and comply with the bookmakers” terms and conditions.
                        <hr>
                        We also do not accept any responsibility or liability for the comments of our viewers as may be
                        posted on certain pages, example: message boards. If you are offended or are in any way
                        adversely affected by such contents, please contact us immediately and refrain from visiting
                        those pages. We are not liable to remove any offending messages on any pages within our site.
                        Please enter at your own risk!
                        <hr>
                        We do not offer refunds on our products or services. If you are having any issue with the
                        subscription or have any questions, please contact us, we will do our best to resolve the
                        problem.
                        <hr>
                        <div style="background: red; padding:10px; color:white;" >
                        WARNING: Betting can be very risky and users should only speculate with money that they can
                        comfortably afford to lose and should ensure that the risks involved are fully understood,
                        seeking advice if necessary.
                        </div>
                        <hr>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About area -->
@endsection

@section('register_javascript')
<script type="text/javascript">

    $(document).ready(function () {

        $('.signup-button').click(function () {
            window.location.href = "{{ route('register') }}";
        })   
    });

</script>
@endsection 




