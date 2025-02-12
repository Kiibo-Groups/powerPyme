

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Billing')); ?>

<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->startSection('content'); ?>
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
                    <li class="separator"></li>
                    <li><?php echo e(__('Billing address')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1 checkut-page">
        <div class="row">
            <!-- Billing Adress-->
            <div class="col-xl-9 col-lg-8">
                <div class="steps flex-sm-nowrap mb-5"><a class="step active" href="<?php echo e(route('front.checkout.billing')); ?>">
                        <h4 class="step-title">1. <?php echo e(__('Billing Address')); ?>:</h4>
                    </a><a class="step" href="javascript:;">
                        <h4 class="step-title">2. <?php echo e(__('Shipping Address')); ?>:</h4>
                    </a><a class="step" href="<?php echo e(route('front.checkout.payment')); ?>">
                        <h4 class="step-title">3. <?php echo e(__('Review and pay')); ?></h4>
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h6><?php echo e(__('Billing Address')); ?></h6>

                        <form id="checkoutBilling" action="<?php echo e(route('front.checkout.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn"><?php echo e(__('First Name')); ?></label>
                                        <input class="form-control" name="bill_first_name" type="text" required
                                            id="checkout-fn" value="<?php echo e(isset($user) ? $user->first_name : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln"><?php echo e(__('Last Name')); ?></label>
                                        <input class="form-control" name="bill_last_name" type="text" required
                                            id="checkout-ln" value="<?php echo e(isset($user) ? $user->last_name : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing"><?php echo e(__('E-mail Address')); ?></label>
                                        <input class="form-control" name="bill_email" type="email" required
                                            id="checkout_email_billing" value="<?php echo e(isset($user) ? $user->email : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone"><?php echo e(__('Phone Number')); ?></label>
                                        <input class="form-control" name="bill_phone" type="text" id="checkout-phone"
                                            required value="<?php echo e(isset($user) ? $user->phone : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <?php if(PriceHelper::CheckDigital()): ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-company"><?php echo e(__('Company')); ?></label>
                                            <input class="form-control" name="bill_company" type="text" required
                                                id="checkout-company"
                                                value="<?php echo e(isset($user) ? $user->bill_company : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-address1"><?php echo e(__('Address')); ?> 1</label>
                                            <input class="form-control" name="bill_address1" required type="text"
                                                id="checkout-address1"
                                                value="<?php echo e(isset($user) ? $user->bill_address1 : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-address2"><?php echo e(__('Address')); ?> 2</label>
                                            <input class="form-control" name="bill_address2" type="text"
                                                id="checkout-address2"
                                                value="<?php echo e(isset($user) ? $user->bill_address2 : ''); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-zip"><?php echo e(__('Zip Code')); ?> </label>
                                            <input class="form-control" name="bill_zip" type="text" id="checkout-zip" required
                                                value="<?php echo e(isset($user) ? $user->bill_zip : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-city"><?php echo e(__('City')); ?></label>
                                            
                                            <select class="form-control select2 select-search" name="bill_city"
                                                id="checkout-city" required disabled>
                                                <option value="<?php echo e(isset($user) ? $user->bill_city : ''); ?>">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-country"><?php echo e(__('Country')); ?></label>
                                            <select class="form-control" name="bill_country" required id="billing-country">
                                                
                                                <?php $__currentLoopData = DB::table('countries')->where('name', 'Mexico')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->name); ?>"
                                                        <?php echo e(isset($user) && $user->bill_country == $country->name ? 'selected' : ''); ?>>
                                                        <?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            <?php endif; ?>




                         

                            <?php if($setting->is_privacy_trams == 1): ?>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="trams__condition">
                                        <label class="custom-control-label" for="trams__condition">This site is protected
                                            by reCAPTCHA and the <a href="<?php echo e($setting->policy_link); ?>"
                                                target="_blank">Privacy Policy</a> and <a
                                                href="<?php echo e($setting->terms_link); ?>" target="_blank">Terms of Service</a>
                                            apply.</label>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('front.cart')); ?>"><span
                                        class="hidden-xs-down"><i
                                            class="icon-arrow-left"></i><?php echo e(__('Back To Cart')); ?></span></a>
                                <?php if($setting->is_privacy_trams == 1): ?>
                                    <button disabled id="continue__button" class="btn btn-primary  btn-sm"
                                        type="button"><span class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i
                                            class="icon-arrow-right"></i></button>
                                <?php else: ?>
                                    <button class="btn btn-primary btn-sm" type="submit"><span
                                            class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i
                                            class="icon-arrow-right"></i></button>
                                <?php endif; ?>
                            </div>


                        </form>
                        <input id="token_compomex" type="hidden"  value="<?php echo e($token); ?>" >
                        <input id="code_zip" type="hidden"  value="<?php echo e($code_zip); ?>" >
                        <input id="token_express" type="hidden"  value="<?php echo e($token_express); ?>" >
                    </div>
                </div>
            </div>
            <!-- Sidebar          -->
            <?php echo $__env->make('includes.checkout_sitebar', $cart, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<script>
    $(document).ready(function() {

        var checkout_zip = $("#checkout-zip").val();
        if (checkout_zip != null) {
            check();
        }
        $("#checkout-zip").blur(function() {
            check();
        });


        function check(){

            var input_value = $("#checkout-zip").val();

            var token_compomex = $("#token_compomex").val();
            var code_zip       = $("#code_zip").val();
            var token_express  = $("#token_express").val();

            $.ajax({
                url: '<?php echo e(route('user.shipping.code.submit')); ?>',
                type: "GET",
                data: {
                    codezip: input_value,
                    token_compomex: token_compomex,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success: function(response) {
                    $("#checkout-city").prop('disabled', false);
                    if (response.code == 200) {

                        $.each(response.data, function(key, value) {
                            $("#checkout-city").append('<option value="' + value
                                .ciudad + '">' + value.ciudad + '</option>');
                        });
                    }
                }
            });
            /*
                $.ajax({
                    url: '<?php echo e(route('user.shipping.paquete.submit')); ?>',
                    type: "GET",
                    data: {
                        codezip: input_value,
                        code_zip_tienda: code_zip,
                        token_express: token_express,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log("Paquete =>", response);
                        if (response.code == 200) {

                            $.each(response.data, function(key, value) {
                                $("#checkout-city").append('<option value="' + value.ciudad + '">' + value.ciudad + '</option>');
                            });
                        }
                    },
                    error: function(response) {
                        console.log("Error => ", response);
                    }
                });
            */

        };
    });
</script>



<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\Paquete-Express\ecommerce\resources\views/front/checkout/billing.blade.php ENDPATH**/ ?>