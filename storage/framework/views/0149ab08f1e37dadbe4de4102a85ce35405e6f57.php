<?php $__env->startSection('content'); ?>
<style>
    .banner-section {
        display: none;
        margin: 100px;
    }

    /* Add media query for small screens (phones) */
    @media  only screen and (max-width: 600px) {
        .banner-section {
            margin: 20px; /* Adjust margin for smaller screens */
        }

        .testimonial-section {
            /* Add any additional styles for small screens here */
        }

        .review-box {
            /* Add any additional styles for individual review boxes on small screens here */
        }
    }
</style>

<?php if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0]): ?>
    <center>
        <h3><?php echo app('translator')->get(optional($aboutUs->description)->title); ?></h3>
        <h2><?php echo app('translator')->get(optional($aboutUs->description)->sub_title); ?></h2>
        <p>
            <?php echo app('translator')->get(optional($aboutUs->description)->description); ?>
        </p>
    </center>
<?php endif; ?>

<?php if(isset($contentDetails['testimonial']) && count($contentDetails['testimonial']) > 0): ?>
    <!-- testimonial section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <?php if(isset($templates['testimonial'][0]) && ($testimonial = $templates['testimonial'][0])): ?>
                    <div class="col">
                        <div class="header-text mb-5 text-center">
                            <h5><?php echo app('translator')->get(optional($testimonial->description)->title); ?></h5>
                            <p><?php echo app('translator')->get(optional($testimonial->description)->short_description); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonials owl-carousel">
                        <?php $__empty_1 = true; $__currentLoopData = $contentDetails['testimonial']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="review-box">
                                <div class="upper">
                                    <div class="img-box">
                                        <img src="<?php echo e(getFile(config('location.content.path') . @$item->content->contentMedia->description->image)); ?>" alt="..."/>
                                    </div>
                                    <div class="client-info">
                                        <h5><?php echo app('translator')->get(@$item->description->name); ?></h5>
                                        <span><?php echo app('translator')->get(@$item->description->designation); ?></span>
                                    </div>
                                </div>
                                <p class="mb-0"><?php echo app('translator')->get(@$item->description->description); ?></p>
                                <i class="fad fa-quote-right quote"></i>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/centur69/majesticsport.centurybreakcap.com/resources/views/themes/betting/about.blade.php ENDPATH**/ ?>