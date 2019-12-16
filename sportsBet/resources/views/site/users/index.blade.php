@extends('layouts.frontend.index')

@section('content')
<div class="account-area area-padding">
    <div class="container">
        <div class="row" style="border-bottom: 2px solid #00bfff; padding-bottom: 50px; padding-top: 50px;">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <img src="/storage/profile/basic-info.jpg" class="img-responsive img-circle">
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <p>Enter your name and renew your subscription when expired.</p>
                <div style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p style="font-weight: bold;">Name </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>{{ $user['name'] }}</p>
                        </div>
                    </div>
                    @if ($user['role'] == 'user')
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <p style="font-weight: bold;">Plan </p>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p>{{ $user['plan'] }}</p>
                                @if (!$user['subscription_is_active'])
                                <p> Your Subscription expired on {{ $user['subscription_exp']}} </p>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#make-payment">Renew
                                    Subscription</button>
                                @else
                                <p> Your subscription is valid untill: {{ $user['subscription_exp']}} </p>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p style="font-weight: bold;">Country </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p>{{ $user['country'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p style="font-weight: bold;">Email </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <p>{{ $user['email'] }}</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <button class="btn btn-info btn-sm pull-right" data-toggle="modal"
                                        data-target="#edit-profile"> Edit Personal Info</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="border-bottom: 2px solid #00bfff; padding-bottom: 50px; padding-top: 50px;">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <img src="/storage/profile/password.jpg" class="img-responsive img-circle">
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <p>
                    Your privacy and security are top priority. We do all we can to keep your account secure,
                    and we encourage you to do the same by following best practices:
                    Update your password regularly and keep your login credentials private.
                </p>
                <div style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p style="font-weight: bold;">Password </p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                                <button class="btn btn-info btn-sm pull-right" data-toggle="modal"
                                data-target="#edit-password"> Edit Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($user['role'] == 'user')
            <div class="row" style="padding-bottom: 50px; padding-top: 50px;" >
                <div class="">
                    <form action="{{ route('account.delete' )}}" id="delete_account_form" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{$user['id']}}">
                        <button class="btn btn-danger btn-smcenter pull-right" id="delete_account">Delete account </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Make payment modal form -->
<div class="modal fade" id="make-payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"><i class="fa fa-lock"></i> Your payment is secure</h5>
            </div>
            <div class="modal-body">
                <form id="payment-form" class="payment-form" action="{{ route('account.makePayment')}}" method="POST">
                    @csrf
                    <div class="bg-info info-discalaimer">
                        <p>
                            Please note that we don't store any of this information in our system.
                        </p>
                    </div>
                    <input id="payment_token" name="payment_token" type="hidden" value="">

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class='card-wrapper' style="padding-bottom: 27px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="card-number">Card number:</label>
                                <input type="text" class="form-control" name="card_number" id="card-number" />
                            </div>
                            <div class="form-group">
                                <label for="card-name">Name on card:</label>
                                <input type="text" class="form-control" name="card_name" id="card-name" />
                            </div>
                            <div class="form-group">
                                <label for="card-expiry">Expiry date:</label>
                                <input type="text" class="form-control" name="card_expiry" id="card-expiry" />
                            </div>
                            <div class="form-group">
                                <label for="card-cvc">CVC:</label>
                                <input type="text" class="form-control" name="card_cvc" id="card-cvc" />
                            </div>
                            <div class="form-group" id="select_plan">
                                <label for="plan">Plan:</label>
                                <select name="plan" id="plan" class="form-control">
                                    <option value="">Subscribe to a plan</option>
                                    <!-- Append all plans from the database -->
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="payment-submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Make payment modal form -->

<!-- Profile edit modal form -->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Password</h5>
            </div>
            <div class="modal-body">
                <form id="profile-edit-form" action="{{ route('account.updateProfile')}}" method="POST" class="profile-edit-form">
                    @csrf
                    <div class="form-group">
                        <label for="first-name">First name:</label>
                        <input type="text" class="form-control" name="first_name" id="first-name"
                            placeholder="First name" value="{{ $user['first_name'] }}" />
                    </div>
                    <div class="form-group">
                        <label for="edit-last-name">Last name:</label>
                        <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Last name"
                            value="{{ $user['last_name'] }}" />
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" readonly
                            value="{{ $user['email'] }}" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="profile-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Profile edit modal form -->

<!-- Password edit modal form -->
<div class="modal fade" id="edit-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Password</h5>
            </div>
            <div class="modal-body">
                <form id="password-edit-form" class="password-edit-form" method="post"
                    action="{{ route('account.updatePassword') }}">
                    @csrf
                    <div class="bg-info info-discalaimer">
                        <p>
                            All passwords must contain at least 8 characters.
                            We also suggest having at least one capital and one lower-case letter
                            (Aa-Zz),
                            one special symbol (#, &, % etc), and one number (0-9) in your password
                            for
                            the best strength.
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="old-password">Old password:</label>
                        <div class="">
                            <input type="password" class="form-control" name="old_password" id="old-password"
                                placeholder="Old password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New password:</label>
                        <div class="">
                            <input type="password" class="form-control" name="new_password" id="new-password"
                                placeholder="New password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm password:</label>
                        <div class="">
                            <input type="password" class="form-control" name="password_confirm" id="password-confirm"
                                placeholder="Confirm password" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="password-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Password edit modal form -->


@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {

        /* Fetch all active plans */
        $.ajax({
            url: "{{route('getPlans')}}",
            type: "get",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $.each(data, function (index, data) {
                    $("#plan").append($("<option></option>").attr("value", data.id).text(
                        data.name));
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });


        /**
         * capture card details with Card plugin
         */
        var card = new Card({
            // a selector or DOM element for the form where users will
            // be entering their information
            form: '#payment-form', // *required*
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


        /*
        * 2checkout secure token creation
        */
        // Called when token created successfully.
        var successCallback = function (data) {
            var myForm = document.getElementById('payment-form');

            // Set the token as the value for the token input
            myForm.payment_token.value = data.response.token.token;

            // Submit the form
            myForm.submit();
        };

        // Called when token creation fails.
        var errorCallback = function (data) {
            if (data.errorCode === 200) {
                tokenRequest();
            } else {
                alert(data.errorMsg);
            }
        };

        var tokenRequest = function () {
            // Setup token request arguments

            var exp_date = $('#card-expiry').val();
            var year = exp_date.substr(5, 4);
            var month = exp_date.substr(0, 2);
            var ccNo =  $("#card-number").val();
            var cvv =  $("#card-cvc").val()
            var args = {
                sellerId: "901416501",
                publishableKey: "{{env('2CHECKOUT_PUBLISHABLE_KEY')}}",
                ccNo: ccNo,
                cvv: cvv,
                expMonth: month,
                expYear: year
            };
            // Make the token request
            TCO.requestToken(successCallback, errorCallback, args);
        };

        

        /* Validate profile edit form */
        $('#profile-edit-form').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                zipcode: {
                    required: true
                },
                address: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: 'First name is required.'
                },
                last_name: {
                    required: 'Last name is required.'
                },
                state: {
                    required: 'State name is required.'
                },
                city: {
                    required: 'City name is required.'
                },
                zipcode: {
                    required: 'Zipcode is required.'
                },
                address: {
                    required: 'Address is required.'
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });


        /* Validate assword edit form */
        $('#password-edit-form').validate({
            rules: {
                old_password: {
                    required: true,
                    remote: "{{url('checkUserPasswordMatches')}}"
                },
                new_password: {
                    required: true,
                    minlength: 8,
                },
                password_confirm: {
                    required: true,
                    equalTo: '#new-password'
                },
            },
            messages: {
                old_password: {
                    required: 'Current password is required.',
                    remote: 'Current password is incorrect.'
                },
                new_password: {
                    required: 'New password is required.',
                    minlength: 'New password must be atleast 8 characters long.'
                },
                password_confirm: {
                    equalTo: 'The passwords don\'t match'
                },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });


        /* Validate payment form */
        $('#payment-form').validate({
            rules: {
                plan: {
                    required: true
                },
                card_number: {
                    required: true,
                },
                card_expiry: {
                    required: true,
                    minlength: 9,
                },
                card_cvc: {
                    required: true
                },
                card_name: {
                    required: true
                }
            },
            messages: {
                plan: {
                    required: 'You must select a plan'
                },
                card_number: {
                    required: 'Card number is required',
                },
                card_expiry: {
                    required: 'Card expiry date is required',
                    minlength: 'Date Format Invalid'
                },
                card_cvc: {
                    required: 'Card cvc date is required'
                },
                card_name: {
                    required: 'Name on card is required'
                },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });


        $(function () {
            // Pull in the public encryption key for our environment
            TCO.loadPubKey('sandbox');
            $("#payment-form").submit(function (e) {
                // Call our token request function
                if($(this).valid()) 
                {
                    tokenRequest();
                } 
                else 
                {
                    console.log(' Form not valid');
                }
                // Prevent form from submitting
                return false;
            });
        });
    });

      /* Deelete user account */
    $('#delete_account').click(function (e) {
        e.preventDefault();
        if(confirm("This account will be lost forever! Proceed?")){
            $.ajax({
                data: $('#delete_account_form').serialize(),
                url: "{{route('account.delete')}}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data.success)
                    {
                        toastr.success(data.success);
                        window.location.replace("{{route('logOut')}}");
                    }
                    if(data.errors)
                    {
                        toastr.error(data.errors);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

</script>
@endsection
