<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.2.0/jquery-migrate.min.js" integrity="sha256-04lIChOgWF7jIOxGWaIMJE5y+W/0xUVDlh2+nwJuB28=" crossorigin="anonymous"></script>
{{--<script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>--}}

<!-- popper -->
<script src="assets/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- plugin js-->
<script src="assets/js/plugin.js"></script>

<!-- MpusemoverParallax JS-->
<script src="assets/js/TweenMax.js"></script>
<script src="assets/js/mousemoveparallax.js"></script>
<!-- main -->
<script src="assets/js/main.js"></script>


<script src="dist/jquery.bracket.min.js" type="text/javascript"></script>

<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=b8c5d838-220c-412a-b848-cef14dbb949a"> </script>


<script>
    $(document).ready(function () {
    var selectedMatch;
    var endMatchid;

    var files={};

    var stripe = Stripe('pk_test_VmSLyXlqnS9IcF1l8xneeXVA00XsKljyug');
    //var stripe = Stripe('pk_test_oKD5VIrUo0ajKlpfIV2k0Hir');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card',{hidePostalCode: true, style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        //ADD the loader button
        $("#card_sub").css("display", "none");
        $("#card_load").css("display", "block");

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            }
            else {
                // Send the token to your server.
                //stripeTokenHandler(result.token);

                //HERE will be the AJAX request to attach the payment method to the customer on stripe.

                    @if(Auth::check())
                var cust={};
                cust['name']="<?php echo auth()->user()->name; ?>";
                cust['email']="<?php echo auth()->user()->email; ?>";
                var userId="<?php echo auth()->user()->id; ?>";
                $.ajax({
                    url: '/api/customer',
                    type: 'POST',
                    data: cust,

                    success: function (data) {
                        var upd={};
                        upd['stripe_id']=data.id;
                        var stripe_id=data.id;
                        $.ajax({
                            url: '/api/addStripeID/'+userId,
                            type: 'POST',
                            data: upd,
                            success: function (data) {

                                $.ajax({
                                    url: '/api/updateCustomer/'+stripe_id,
                                    type: 'POST',
                                    //processData: false,
                                    //contentType: false,
                                    data: result.token,

                                    //data: details,
                                    success: function (data) {
                                        subs['id']=stripe_id;

                                        $.ajax({
                                            url: '/api/subCreate',
                                            type: 'POST',
                                            //processData: false,
                                            //contentType: false,
                                            data: subs,

                                            //data: details,
                                            success: function (data) {

                                                var membership={};
                                                membership['id']=userId;
                                                membership['stripe_id']=stripe_id;
                                                membership['sub_id']=data.id;
                                                membership['quantity']=subs['quantity'];





                                                $.ajax({
                                                    url: '/api/createMembershipRecord',
                                                    type: 'POST',
                                                    //processData: false,
                                                    //contentType: false,
                                                    data: membership,

                                                    //data: details,
                                                    success: function (data) {


                                                        $("#card_header_area").css("display", "none");
                                                        $("#card_body_area").css("display", "none");
                                                        $("#card_post_header_area").css("display", "block");
                                                        setTimeout(() => location.reload(true), 3000);




                                                    },
                                                    error: function (request, status, error) {

                                                        console.log(request.responseText)
                                                    }
                                                });




                                            },
                                            error: function (request, status, error) {

                                                console.log(request.responseText)
                                            }
                                        });
                                    },
                                    error: function (request, status, error) {

                                        console.log(request.responseText)
                                    }
                                });
                            },
                            error: function (request, status, error) {

                                console.log(request.responseText)
                            }
                        });
                    },
                    error: function (request, status, error) {

                        console.log(request.responseText)
                    }
                });
                @endif

            }
        });
    });
    //
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }











    // function selectFight(key){
    //     this.selectedMatch=key;
    //     $("#UserExistsMsg").css("display", "none");
    //     //console.log(this.selectedMatch);
    // }


    //

    // function endFight(key){
    //     $('.title1').text("");
    //     $('.title2').text("");
    //     $('.title3').text("");
    //     $('.title4').text("");
    //     this.endMatchid=key.match_id;
    //     //console.log(key);
    //     if(key.game_type==2){
    //     $('#gametype').text("2 V 2");
    //     $('.gametype').text("2 V 2");
    //     }
    //     else if(key.game_type==1){
    //     $('#gametype').text("1 V 1");
    //     $('.gametype').text("1 V 1");
    //     }
    //     $('#platform').text("Platform: "+key.platform);
    //     $('.platform').text("Platform: "+key.platform);
    //     $('#region').text("Region: "+key.region);
    //     $('.region').text("Region: "+key.region);
    //     $('#time').text("Time: "+key.time);
    //     $('.time').text("Time: "+key.time);
    //     $('#bid').text("Amount: "+key.bid_amount);
    //     $('.bidamount').text("Amount: "+key.bid_amount);


    //     $.ajax({
    //                                                             url: '/api/viewBoxFightTeam/'+key.match_id,
    //                                                             type: 'GET',

    //                                                             //data: details,
    //                                                             success: function (data) {
    //                                                                console.log(data);
    //                                                                 if(data[0].game_type==1){
    //                                                                     $('.title1').text(data[0].username);
    //                                                                     $('.title2').text("");
    //                                                                     $('.title3').text(data[1].username);
    //                                                                     $('.title4').text("");
    //                                                                 }
    //                                                                 else{
    //                                                                     $('.title1').text(data[0].username);
    //                                                                     $('.title2').text(data[1].username);
    //                                                                     $('.title3').text(data[2][0].username);
    //                                                                     $('.title4').text(data[2][1].username);}

    //                                                             },
    //                                                             error: function (request, status, error) {

    //                                                                         console.log(request.responseText)
    //                                                                     }
    //                                                 });
    // }

    // function changetoYes(){
    //     @if(Auth::check())
    //         dets['user_id']="<?php echo auth()->user()->id; ?>";
    //     @endif
    //     dets['status']='won';
    //     var team_id=this.endMatchid;
    //     $.ajax({
    //                                             url: '/api/statusChange/'+team_id,
    //                                             type: 'POST',

    //                                             data: dets,
    //                                             success: function (data) {setTimeout(() => location.reload(true), 1000);},
    //                                             error: function (request, status, error) {

    //                                                         console.log(request.responseText)
    //                                                     }
    //                                         });
    // }

    // function changetoNo(){
    //     @if(Auth::check())
    //         dets['user_id']="<?php echo auth()->user()->id; ?>";
    //     @endif
    //     dets['status']='lost';
    //     var team_id=this.endMatchid;
    //     $.ajax({
    //                                             url: '/api/statusChange/'+team_id,
    //                                             type: 'POST',

    //                                             data: dets,
    //                                             success: function (data) {setTimeout(() => location.reload(true), 1000);},
    //                                             error: function (request, status, error) {

    //                                                         console.log(request.responseText)
    //                                                     }
    //                                         });
    // }



    // $("#joinUsingButton").submit(function(e){

    //     e.preventDefault();
    //     details['match_id']=selectedMatch;
    //     //console.log(selectedMatch)
    //     details['team_id']=0;
    //     @if(Auth::check())
    //         details['user_id']="<?php echo auth()->user()->id; ?>";
    //     @endif
    //         details['username']=$('#usernameWithButton').val();
    //     //console.log(key);
    //     $.ajax({
    //         url: '/api/checkBoxFightButton/'+selectedMatch,
    //         type: 'POST',

    //         data: details,
    //         success: function (data) {
    //             //console.log(data);
    //             if(data=="new"){
    //                 $("#UserExistsMsg").css("display", "none");
    //                 $.ajax({
    //                     url: '/api/joinButton/'+selectedMatch,
    //                     type: 'POST',

    //                     data: details,
    //                     success: function (data) {
    //                         if(data=='Failed'){
    //                             $("#limaError1").css("display", "block");
    //                             setTimeout(() => $("#limaError1").css("display", "none"), 3000);
    //                         }
    //                         else{
    //                             $("#limaError1").css("display", "none");
    //                             $("#UserExistsMsg1").css("display", "inline-block");
    //                             $('#UserExistsMsg1').text('You have successfully joined this fight');
    //                             setTimeout(() => location.reload(true), 5000);
    //                         }
    //                     },
    //                     error: function (request, status, error) {

    //                         console.log(request.responseText)
    //                     }
    //                 });
    //             }
    //             else if(data=="exists"){
    //                 $("#UserExistsMsg").css("display", "inline-block");
    //                 $('#UserExistsMsg').text('You have already joined this fight');
    //                 setTimeout(() => $("#UserExistsMsg").css("display", "none"), 5000);

    //             }
    //         },
    //         error: function (request, status, error) {

    //             console.log(request.responseText)
    //         }
    //     });





    // });
    });




</script>





<script src='https://js.sentry-cdn.com/cd61cb6879454e569d1d62574bb96c6b.min.js' crossorigin="anonymous"></script>
<script>
    Sentry.init({ dsn: 'https://cd61cb6879454e569d1d62574bb96c6b@o382843.ingest.sentry.io/5212339' });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?always=1"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166613972-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?=getenv('GOOGLE_TRACKING_ID')?>');
</script>


<!-- Hotjar Tracking Code -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:<?=getenv('HOTJAR_ID')?>,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
