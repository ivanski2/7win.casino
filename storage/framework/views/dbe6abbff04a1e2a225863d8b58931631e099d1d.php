<?php $__env->startSection('title', trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="card col-md-3 ms-3">
            <div class="payment-info text-center">
                <ul class="list-group">
                    <li class="list-group-item font-weight-bold bg-transparent">
                        <img
                            src="<?php echo e(getFile(config('location.withdraw.path').optional($withdraw->method)->image)); ?>"
                            class="card-img-top w-50" alt="<?php echo e(optional($withdraw->method)->name); ?>">
                    </li>
                    <li class="list-group-item bg-transparent"><?php echo app('translator')->get('Request Amount'); ?> :
                        <span
                            class="float-right text-success"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->amount)); ?> </span>
                    </li>
                    <li class="list-group-item bg-transparent"><?php echo app('translator')->get('Charge Amount'); ?> :
                        <span
                            class="float-right text-danger"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->charge)); ?> </span>
                    </li>
                    <li class="list-group-item bg-transparent"><?php echo app('translator')->get('Total Payable'); ?> :
                        <span
                            class="float-right text-danger"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->net_amount)); ?> </span>
                    </li>
                    <li class="list-group-item bg-transparent"><?php echo app('translator')->get('Available Balance'); ?> :
                        <span
                            class="float-right text-success"><?php echo e(@$basic->currency_symbol); ?><?php echo e($remaining); ?> </span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header custom-header text-center">
                    <h5 class="card-title"><?php echo app('translator')->get('Additional Information To Withdraw Confirm'); ?></h5>
                </div>
                <div class="card-body">

                    <form <?php if($layout == 'layouts.payment'): ?> action="<?php echo e(route('user.payout.submit',$billId)); ?>"
                          <?php else: ?> action="" <?php endif; ?> method="post" enctype="multipart/form-data"
                          class="form-row text-left preview-form">
                        <?php echo csrf_field(); ?>
                        <?php if($payoutMethod->supported_currency): ?>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-group input-box search-currency-dropdown">
                                        <label for="from_wallet"><?php echo app('translator')->get('Select Bank Currency'); ?></label>
                                        <select id="from_wallet" name="currency_code"
                                                class="form-control form-control-sm transfer-currency"
                                                required>
                                            <option value="" disabled=""
                                                    selected=""><?php echo app('translator')->get('Select Currency'); ?></option>
                                            <?php $__currentLoopData = $payoutMethod->supported_currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleCurrency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($singleCurrency); ?>"
                                                    <?php $__currentLoopData = $payoutMethod->convert_rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($singleCurrency == $key): ?> data-rate="<?php echo e($rate); ?>" <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('transfer_name') == $singleCurrency ?'selected':''); ?>><?php echo e($singleCurrency); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['currency_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($payoutMethod->code == 'paypal'): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group input-box search-currency-dropdown">
                                        <label for="from_wallet"><?php echo app('translator')->get('Select Recipient Type'); ?></label>
                                        <select id="from_wallet" name="recipient_type"
                                                class="form-control form-control-sm mb-3" required>
                                            <option value="" disabled=""
                                                    selected=""><?php echo app('translator')->get('Select Recipient'); ?></option>
                                            <option value="EMAIL"><?php echo app('translator')->get('Email'); ?></option>
                                            <option value="PHONE"><?php echo app('translator')->get('phone'); ?></option>
                                            <option value="PAYPAL_ID"><?php echo app('translator')->get('Paypal Id'); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['recipient_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(optional($withdraw->method)->input_form): ?>
                            <?php $__currentLoopData = $withdraw->method->input_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($v->type == "text"): ?>
                                    <div class="col-md-12 mb-3">
                                        <label><strong><?php echo e(trans(@$v->label??$v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?></strong></label>
                                        <div class="form-group input-box">
                                            <input type="text" name="<?php echo e($k); ?>"
                                                   class="form-control"
                                                   <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                            <?php if($errors->has($k)): ?>
                                                <span
                                                    class="text-danger"><?php echo e(trans($errors->first($k))); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php elseif($v->type == "textarea"): ?>
                                    <div class="col-md-12 mb-3">
                                        <label><strong><?php echo e(trans(@$v->label??$v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?>
                                            </strong></label>
                                        <div class="form-group input-box">
                                            <textarea name="<?php echo e($k); ?>" class="form-control" rows="3"
                                                      <?php if($v->validation == "required"): ?> required <?php endif; ?>></textarea>
                                            <?php if($errors->has($k)): ?>
                                                <span class="text-danger"><?php echo e(trans($errors->first($k))); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php elseif($v->type == "file"): ?>

                                    <div class="col-md-12 mb-3">
                                        <label><strong><?php echo e(trans(@$v->label??$v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?>
                                            </strong></label>

                                        <div class="form-group">
                                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                     data-trigger="fileinput">
                                                    <img class="wh-200-150"
                                                         src="<?php echo e(getFile(config('location.default'))); ?>"
                                                         alt="...">
                                                </div>
                                                <div
                                                    class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                <div class="img-input-div">
                                                                <span class="btn btn-info btn-file">
                                                                    <span
                                                                        class="fileinput-new "> <?php echo app('translator')->get('Select'); ?> <?php echo e(@$v->label??$v->field_level); ?></span>
                                                                    <span
                                                                        class="fileinput-exists"> <?php echo app('translator')->get('Change'); ?></span>
                                                                    <input type="file" name="<?php echo e($k); ?>" accept="image/*"
                                                                           <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                                </div>

                                            </div>
                                            <?php if($errors->has($k)): ?>
                                                <br>
                                                <span
                                                    class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="col-md-12 mt-4">
                            <div class=" form-group">
                                <button type="submit" class="btn-custom">
                                    <span><?php echo app('translator')->get('Confirm Now'); ?></span>
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/bootstrap-fileinput.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-js'); ?>
    <script src="<?php echo e(asset($themeTrue.'js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/centur69/majesticsport.centurybreakcap.com/resources/views/themes/betting/user/payout/preview.blade.php ENDPATH**/ ?>