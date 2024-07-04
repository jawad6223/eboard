<!DOCTYPE html>
<html>
   <head>
      <title>Stripe Payment Page - HackTheStuff</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      @include('branch.includes.head') 
      <style type="text/css">
         .panel-title {
         display: inline;
         font-weight: bold;
         }
         .display-table {
         display: table;
         }
         .display-tr {
         display: table-row;
         }
         .display-td {
         display: table-cell;
         vertical-align: middle;
         width: 61%;
         }
      </style>
   </head>
   <body>
   <div class="page-wrapper compact-wrapper" id="pageWrapper">
         @include('branch.includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> 
          @include('branch.includes.sidebar') <div class="page-body">
          <div class="container-fluid ">
            <div class="page-title " style="padding-top:0px;">
              <div class="row mt-4">
                <div class="col-6">
                  <h3>Payment Details</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Payment </li>
                    <li class="breadcrumb-item active"> Payment Details</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                      @if (Session::has('success'))
                       <div class="alert alert-success text-center" id="hi">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                      <p>{{ Session::get('success') }}</p>
                    </div> 
                    @endif
                     <form role="form"
                      action="{{ route('branch/stripe.post') }}"
                       method="post" class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                         @csrf 
                        
                         <div class='form-row row'>
                        <div class="col-md-12 form-group ">
                  
                                    <select class="js-example-basic-single col-sm-12" required name="package_id">
                                       <option value="">Select Subscription Package</option>
                                       @foreach($package as $package) 
                                       <option value="{{$package->id}}">
                                          {{$package->name}} -   {{$package->months}} Months (${{$package->price}})
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>
      </div>
                         <input name="branch_id" value="{{$id}}" type='hidden'>
                        <div class='form-row row mt-3'>
                     
                       

                        <div class='col-xs-12  col-md-4 form-group required'>
                          <label class='control-label'>Name on Card</label>
                          <input class='form-control' size='4' name="card_name" type='text'
                          @if (!empty($card->card_name)) 
value="{{$card->card_name}}"  @endif >
                        </div>
                        <div class='col-xs-12 col-md-4 form-group  required'>
                          <label class='control-label'>Card Number</label>
                          <input autocomplete='off' @if (!empty($card->card_number)) 
                           value="{{$card->card_number}}"   @endif required class='form-control card-number'name="card_number" size='20' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                          <label class='control-label'>CVC</label>
                          <input autocomplete='off' @if (!empty($card->cvc)) 
                           value="{{$card->cvc}}"  @endif required class='form-control card-cvc' name="cvc" placeholder='ex. 311' size='4' type='text'>
                        </div>
                        
                      </div>
                      <div class='form-row row mt-4'>
                      
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                          <label class='control-label'>Expiration Month</label>
                          <input class='form-control card-expiry-month'  @if (!empty($card->expiration_month)) 
                           value="{{$card->expiration_month}}"  @endif required placeholder='MM' name="expiration_month" size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                          <label class='control-label'>Expiration Year</label>
                          <input class='form-control card-expiry-year' required placeholder='YYYY' @if (!empty($card->expiration_year)) 
                           value="{{$card->expiration_year}}"  @endif  name="expiration_year" size='4' type='text'>
                        </div>
                        <div class=" col-xl-3 col-md-4 " style="margin-top:40px;margin-left:20px">
                                       <label class="d-block" for="chk-ani">
                                         @if( !empty($card->card_number))
                                         <input class="checkbox_animated pakage_checkbox" checked id="package" name="card_save" type="checkbox" value="1"> 
                            
                                          @else
                                       <input class="checkbox_animated pakage_checkbox" id="package" name="card_save" type="checkbox" value="1"> 
                                       @endif
                                       Save Card For Next Time</label>
                                    </div>

                      </div>
                      
                        <div class='col-md-12 error form-group hide'>
                          <span class='alert-danger alert' style="display:none;"> </span>
                     
                      </div>
                    

                      <div class="row">
                        <div class="col-xs-12 card-footer text-end">
                          <button class="btn btn-primary " type="submit">Pay Now</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
          <!-- Container-fluid Ends-->
          <!-- footer start--> @include('branch.includes.footer')
        </div>
      </div>
      <!-- latest jquery-->
      <script src="{{asset('public/assets/js/jquery-3.5.1.min.js')}}"></script>
      <!-- Bootstrap js-->
      <script src="{{asset('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
      <!-- feather icon js-->
      <script src="{{asset('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
      <script src="{{asset('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
      <!-- scrollbar js-->
      <script src="{{asset('public/assets/js/scrollbar/simplebar.js')}}"></script>
      <script src="{{asset('public/assets/js/scrollbar/custom.js')}}"></script>
      <!-- Sidebar jquery-->
      <script src="{{asset('public/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone-script.js')}}"></script>
      <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
      <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
      <script>
        $('#hi').delay(2000).slideUp(1200);
      </script>

   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $('.alert').show();
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
    function stripeResponseHandler(status, response) {
        console.log(response);
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
   </script>
</html>