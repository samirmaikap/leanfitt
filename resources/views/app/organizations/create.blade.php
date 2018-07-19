@extends("layouts.app")
@section("content")

    <main>
        {{--@include('app.organizations.partials.header')--}}
        <div class="main-content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-title text-center">
                            <h3>
                                <strong> Create Organization</strong>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="errors" class="callout callout-danger b-1" role="alert"  style="{{ $errors->any() ? 'display:block' : 'display:none' }}">
                                <button type="button" class="close" data-dismiss="callout" aria-label="Close">
                                    <span>×</span>
                                </button>
                                <h5>Oh snap!</h5>
                                @foreach($errors->all() as $error)
                                    <p>
                                        {{ $error }}
                                    </p>
                                @endforeach
                            </div>
                            <form id="register-form" action="" method="post" data-provide="wizard">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <ul class="nav nav-process nav-process-circle">
                                    <li class="nav-item">
                                        <span class="nav-title">Account</span>
                                        <a class="nav-link" data-toggle="tab" href="#wizard-form-1"></a>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-title">Subscription</span>
                                        <a class="nav-link" data-toggle="tab" href="#wizard-form-2"></a>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane fade" id="wizard-form-1">

                                        <p class="text-center text-gray">
                                            Create an organization and start managing LeanFITT. You can be associated with multiple organizations either via invitation from other organizations or by creating your own organization.
                                        </p>
                                        <hr class="w-100px">

                                        <div class="form-group">
                                            <label>Organization Name</label>
                                            <input class="form-control" type="text" name="organization[name]" value="{{ old('organization.name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Email</label>
                                            <input class="form-control" type="text" name="organization[email]" value="{{ old('organization.email') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Person</label>
                                                    <input class="form-control" type="text" name="organization[contact_person]" value="{{ old('organization.contact_person') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="text" name="organization[phone]" value="{{ old('organization.contact_person') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="wizard-form-2">

                                        <p class="text-center text-gray">Choose a Subscriptions that suits your Organization. You may change or cancel anytime.</p>
                                        <hr class="w-100px">

                                        <div class="flexbox">
                                            <div>
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="subscription[plan]" value="plan_DBzmDsCSCotMdS" checked>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description"><strong>Team</strong></span>
                                                </label>
                                                {{--<button type="button" class="btn btn-pure" data-provide="tooltip" data-placement="right" title="" data-original-title="Tooltip on right">--}}
                                                {{--<i class="fa fa-info"></i>--}}
                                                {{--</button>--}}
                                                <p class="small lh-14 mt-4 ml-24">10 licenses, 7 days free trial</p>
                                            </div>
                                            <div>
                                                <strong>$60/month</strong>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="flexbox">
                                            <div>
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="subscription[plan]" value="plan_DCC6l9OvdUyzYm" {{ old('subscription.plan') == 'plan_DCC6l9OvdUyzYm' ? 'checked': '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description"><strong>Enterprise</strong></span>
                                                </label>
                                                <p class="small lh-14 mt-4 ml-24">50 licenses, 7 days free trial</p>
                                            </div>
                                            <div>
                                                <strong>$100/month</strong>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group">
                                            <label>Name on card</label>
                                            <input class="form-control" type="text" name="subscription[name_on_card]" value="{{ old('subscription.name_on_card') }}">
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label>Card Number</label>
                                                <input type="text" class="form-control" name="subscription[number]" value="{{ old('subscription.number') }}" size='20'>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label>CVC Code</label>
                                                <input class="form-control" type="text" name="subscription[cvc]" value="{{ old('subscription.cvc') }}" size='4'>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label>Expiry Date</label>
                                                <div class="row">
                                                    <div class="col-md-6 pr-0">
                                                        <input type="text" class="form-control" name="subscription[exp_month]" value="{{ old('subscription.exp_month') }}" size='2' maxlength="2" placeholder="MM">
                                                    </div>
                                                    <div class="col-md-6 pl-0">
                                                        <input type="text" class="form-control" name="subscription[exp_year]" value="{{ old('subscription.exp_year') }}" size='2' maxlength="2" placeholder="YY">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="flexbox">
                                    <button class="btn btn-bold btn-outline btn-secondary" data-wizard="prev" type="button">Back</button>
                                    <button class="btn btn-bold btn-outline btn-secondary" data-wizard="next" type="button">Next</button>
                                    <button class="btn btn-bold btn-primary d-none" data-wizard="finish" type="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </main>


    {{--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>--}}
    {{--<script type="text/javascript">--}}

        {{--Stripe.setPublishableKey("{{ config('services.stripe.key') }}");--}}

        {{--window.onload = function() {--}}

            {{--var $form = $('#register-form');--}}

            {{--$form.submit(function(event) {--}}
                {{--// Disable the submit button to prevent repeated clicks:--}}
                {{--$form.find('button[type="submit"]').prop('disabled', true);--}}

                {{--// Request a token from Stripe:--}}
                {{--Stripe.card.createToken($form, stripeResponseHandler);--}}

                {{--// Prevent the form from being submitted:--}}
                {{--return false;--}}
            {{--});--}}
        {{--};--}}

        {{--function stripeResponseHandler(status, response) {--}}
            {{--// Grab the form:--}}
            {{--var $form = $('#register-form');--}}

            {{--if (response.error) { // Problem!--}}

                {{--console.log(response.error.message);--}}

                {{--// Show the errors on the form:--}}
                {{--$('#errors').show().append("<p>" + response.error.message + "</p>");--}}
                {{--$form.find('button[type="submit"]').prop('disabled', false); // Re-enable submission--}}

            {{--} else { // Token was created!--}}

                {{--// Get the token ID:--}}
                {{--var token = response.id;--}}

                {{--// Insert the token ID into the form so it gets submitted to the server:--}}
                {{--$form.append($('<input type="hidden" name="subscription[stripeToken]">').val(token));--}}

                {{--// Submit the form:--}}
                {{--$form.get(0).submit();--}}
            {{--}--}}
        {{--};--}}
    {{--</script>--}}
@endsection