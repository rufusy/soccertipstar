@extends('layouts.frontend.index')

@section('content')
<!-- Start Wellcome Area -->
<div class="wellcome-area" id="wellcome-area">
    <div class="well-bg">
        <div class="test-overly"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wellcome-text">
                        <div class="well-text text-center">
                            <h2>Welcome to soccertipstar</h2>
                            <p>
                                To form a winning strategy to guarantee profits to all our clients.
                            </p>
                            {{-- <div class="subs-feilds">
                                <div class="suscribe-input">
                                    <input type="email" class="email form-control width-80" id="sus_email"
                                        placeholder="Email">
                                    <button type="submit" id="sus_submit" class="add-btn width-20">Subscribe</button>
                                    <div id="msg_Submit" class="h3 text-center hidden"></div>
                                </div>
                            </div> --}}
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Tips Analysis</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <!--- Free Tips -->
                        <div class="col-md-12">
                            <h4 class="sec-head ">Free Tips</h4>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="">Match</th>
                                        <th class="">Odd(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($freeMatches as $freeMatch)
                                    <tr>
                                        <td class="">{{ $freeMatch->match_date }}</td>
                                        <td class="">{{ $freeMatch->game }}</td>
                                        <td class="">{{ $freeMatch->odd_type }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--- Premium Tips -->
                        <div class="col-md-12" style="padding-top: 10px;">
                            <h4 class="sec-head ">Premium Tips</h4>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="">Match</th>
                                        <th class="">Odd(s)</th>
                                        <th class="">Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paidMatches as $paidMatch)
                                    <tr>
                                        <td class="">{{ $paidMatch->match_date }}</td>
                                        <td class="">{{ $paidMatch->game }}</td>
                                        <td class="">{{ $paidMatch->odd_type }}</td>
                                        <td class="">{{ $paidMatch->outcome }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--- Previous Tips -->
                        <div class="col-md-12">
                            <h4 class="sec-head ">Previous Tips</h4>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="">Match</th>
                                        <th class="">Odd(s)</th>
                                        <th class="">Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($playedMatches as $playedMatch)
                                    <tr>
                                        <td class="">{{ $playedMatch->match_date }}</td>
                                        <td class="">{{ $playedMatch->game }}</td>
                                        <td class="">{{ $playedMatch->odd_type }}</td>
                                        <td class="">{{ $playedMatch->outcome }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Tips area -->


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
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well-left">
                    <div class="single-well">
                        <a href="#">
                            <img src="img/about/1.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!-- single-well end-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well-middle">
                    <div class="single-well">
                        <a href="#">
                            <h4 class="sec-head">project Maintenance</h4>
                        </a>
                        <p>
                            Redug Lagre dolor sit amet, consectetur adipisicing elit. Itaque quas officiis iure
                            aspernatur sit
                            adipisci quaerat unde at nequeRedug Lagre dolor sit amet, consectetur adipisicing elit.
                            Itaque quas
                            officiis iure
                        </p>
                        <ul>
                            <li>
                                <i class="fa fa-check"></i> Interior design Package
                            </li>
                            <li>
                                <i class="fa fa-check"></i> Building House
                            </li>
                            <li>
                                <i class="fa fa-check"></i> Reparing of Residentail Roof
                            </li>
                            <li>
                                <i class="fa fa-check"></i> Renovaion of Commercial Office
                            </li>
                            <li>
                                <i class="fa fa-check"></i> Make Quality Products
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End col-->
        </div>
    </div>
</div>
<!-- End About area -->

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
                    <h3>basic <br /> <span>$80 / month</span></h3>
                    <ol>
                        <li class="check">Online system</li>
                        <li class="check cross">Full access</li>
                        <li class="check">Free apps</li>
                        <li class="check">Multiple slider</li>
                        <li class="check cross">Free domin</li>
                        <li class="check cross">Support unlimited</li>
                        <li class="check">Payment online</li>
                        <li class="check cross">Cash back</li>
                    </ol>
                    <button>sign up now</button>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pri_table_list active">
                    <span class="saleon">top sale</span>
                    <h3>standard <br /> <span>$110 / month</span></h3>
                    <ol>
                        <li class="check">Online system</li>
                        <li class="check">Full access</li>
                        <li class="check">Free apps</li>
                        <li class="check">Multiple slider</li>
                        <li class="check cross">Free domin</li>
                        <li class="check">Support unlimited</li>
                        <li class="check">Payment online</li>
                        <li class="check cross">Cash back</li>
                    </ol>
                    <button>sign up now</button>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pri_table_list">
                    <h3>premium <br /> <span>$150 / month</span></h3>
                    <ol>
                        <li class="check">Online system</li>
                        <li class="check">Full access</li>
                        <li class="check">Free apps</li>
                        <li class="check">Multiple slider</li>
                        <li class="check">Free domin</li>
                        <li class="check">Support unlimited</li>
                        <li class="check">Payment online</li>
                        <li class="check">Cash back</li>
                    </ol>
                    <button>sign up now</button>
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
                                Call: +1 5589 55488 55<br>
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
                                Message: +1 5589 55488 55<br>
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
                                Email: info@example.com<br>
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
                        <form id="contactForm" action="{{ route('sendMessage') }}" method="post" role="form" class="contactForm">
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
                            <div class="text-center"><button  type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>
                <!-- End Left contact -->
            </div>
        </div>
    </div>
</div>
<!-- End Contact Area -->
@endsection


