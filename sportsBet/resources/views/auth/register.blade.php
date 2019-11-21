@extends('layouts.frontend.index')

@section('content')
<!-- Start Register area -->
<div id="signup" class="signup-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>signup</h2>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-10  col-md-offset-1 col-sm-offset-1 col-xs-12">
            <div class="row">
                <form id="signup-form" class="signup-form" method="post" action="{{ route('signup')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="first-name">First name</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="first_name" id="first-name"
                                                placeholder="First name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Last name</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="last_name" id="last-name"
                                                placeholder="Last name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Your Email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">Password</label>
                                        <div class="">
                                            <input type="password" class="form-control" name="password1"
                                                id="new-password" placeholder="New password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm password</label>
                                        <div class="">
                                            <input type="password" class="form-control" name="password2"
                                                id="confirm-password" placeholder="Confirm password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class='card-wrapper' style="padding-bottom: 27px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="card-number" class="col-form-label">Card
                                                number</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="card_number"
                                                    id="card-number" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="card-expiry" class=" col-form-label">Expiry date</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="card_expiry"
                                                    id="card-expiry" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="card-cvc" class="col-form-label">CVC</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="card_cvc" id="card-cvc" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="card-name" class="col-form-label">Name
                                                on card</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="card_name"
                                                    id="card-name" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="plan" class="col-form-label">Plan</label>
                                            <select name="plan" id="plan" class="form-control">
                                                <option value="1">Basic</option>
                                                <option value="2">Standard</option>
                                                <option value="3">Premium</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-md-offset-md-4 col-sm-offset-4 col-xs-12">
                            <div class="text-center"><button type="submit">Submit</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Register area -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
        /**
        * capture card details with Card plugin
        */
        var card = new Card({
            // a selector or DOM element for the form where users will
            // be entering their information
            form: '#signup-form', // *required*
            // a selector or DOM element for the container
            // where you want the card to appear
            container: '.card-wrapper', // *required*

            formSelectors: {
                numberInput: 'input#card-number', // optional — default input[name="number"]
                expiryInput: 'input#card-expiry', // optional — default input[name="expiry"]
                cvcInput: 'input#card-cvc', // optional — default input[name="cvc"]
                nameInput: 'input#card-name' // optional - defaults input[name="name"]
            },

            //width: 200, // optional — default 350px
            formatting: true, // optional - default true

            // Strings for translation - optional
            messages: {
                validDate: 'valid\ndate', // optional - default 'valid\nthru'
                monthYear: 'mm/yyyy', // optional - default 'month/year'
            },

            // Default placeholders for rendered fields - optional
            placeholders: {
                card_number: '•••• •••• •••• ••••',
                card_name: 'Full Name',
                card_expiry: '••/••',
                card_cvc: '•••'
            },

            // masks: {
            //     cardNumber: '•' // optional - mask card number
            // },

            // if true, will log helpful messages for setting up Card
            debug: false // optional - default false
        });


        $("#signup-form").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email:{
                    required: true,
                    email:true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password1:{
                    required: true,
                    minlength:8,
                },
                password2:{
                    required: true,
                    equalTo: '#new-password'
                },
                card_number:{
                    required: true,
                },
                card_expiry:{
                    required: true
                },
                card_cvc:{
                    required: true
                },
                card_name:{
                    required:true
                }
            },
            messages: {
                first_name: {
                    required: 'First name is required.'
                },
                last_name: {
                    required: 'Last name is required.'
                },
                email: {
                    required: 'Email is required.',
                    email: 'Email must be a valid email address.',
                    remote: 'This email has already been taken.'
                },
                password1: {
                    required: 'Password is required.',
                    minlength: 'Password must be atleast 8 characters long.'
                },
                password2: {
                    equalTo: 'The passwords don\'t match'
                },
                card_number: {
                    required: 'Card number is required',
                },
                card_expiry: {
                    required: 'Card expiry date is required'
                },
                card_cvc: {
                    required: 'Card cvc date is required'
                },
                card_name: {
                    required: 'Name on card is required'
                }, 
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });

    });
</script>
@endsection