$(document).ready(function()
{ 
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
                minlength:8
            },
            password2:{
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
                required: 'The first name field is required.'
            },
            last_name: {
                required: 'The last name field is required.'
            },
            email: {
                required: 'The email field is required.',
                email: 'The email must be a valid email address.',
                remote: 'The email has already been taken.'
            },
            password1: {
                minlength: 'The password must be atleast 8 characters long.'
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