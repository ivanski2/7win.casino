<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Team List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card card-primary m-0 m-md-4  m-md-0 shadow">
        <div class="card-header bg-transparent">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary mr-2" data-target="#newModal"
                   data-toggle="modal">
                    <span><i class="fa fa-plus-circle"></i> <?php echo app('translator')->get('Add New'); ?></span>
                </a>
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> <?php echo app('translator')->get('Action'); ?></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active"><?php echo app('translator')->get('Active'); ?></button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive"><?php echo app('translator')->get('DeActive'); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>

                        <th scope="col" class="text-center"><?php echo app('translator')->get('SL No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Category'); ?></th>
                        <th scope="col" class="text-center"><?php echo app('translator')->get('Status'); ?></th>
                        <th scope="col" class="text-center"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" id="chk-<?php echo e($item->id); ?>"
                                       class="form-check-input row-tic tic-check" name="check" value="<?php echo e($item->id); ?>"
                                       data-id="<?php echo e($item->id); ?>">
                                <label for="chk-<?php echo e($item->id); ?>"></label>
                            </td>

                            <td data-label="<?php echo app('translator')->get('SL No.'); ?>" class="text-center"><?php echo e($loop->index + 1); ?></td>
                            <td data-label="<?php echo app('translator')->get('Name'); ?>">
                                <div class="d-lg-flex d-block align-items-center ">
                                    <div class="mr-3"><img
                                            src="<?php echo e(getFile(config('location.team.path') . $item->image)); ?>"
                                            alt="user" class="rounded-circle" width="25" height="25"></div>
                                    <div class="mr-3">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium"><?php echo app('translator')->get($item->name); ?></h5>
                                    </div>
                                </div>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Category'); ?>" class="text-dark">
                                <?php echo optional($item->gameCategory)->icon; ?>

                                <?php echo e(optional($item->gameCategory)->name); ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>" class="text-lg-center text-right">
                                <?php if($item->status == 0): ?>
                                    <span class="badge badge-light">
                               <i class="fa fa-circle text-danger danger font-12"></i> <?php echo app('translator')->get('Deactive'); ?> </span>
                                <?php else: ?>
                                    <span class="badge badge-light">
                               <i class="fa fa-circle text-success success font-12"></i> <?php echo app('translator')->get('Active'); ?></span>
                                <?php endif; ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Action'); ?>">

                                <div class="dropdown show dropup text-lg-center text-right">
                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item editBtn" href="javascript:void(0)"
                                           data-title="<?php echo e($item->name); ?>"
                                           data-status="<?php echo e($item->status); ?>"
                                           data-category_id="<?php echo e($item->category_id); ?>"
                                           data-category="<?php echo e($item->gameCategory); ?>"
                                           data-image="<?php echo e(getFile(config('location.team.path').$item->image)); ?>"
                                           data-action="<?php echo e(route('admin.updateTeam', $item->id)); ?>">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                        </a>

                                        <a class="dropdown-item notiflix-confirm" href="javascript:void(0)"
                                           data-target="#delete-modal"
                                           data-route="<?php echo e(route('admin.deleteTeam',$item->id)); ?>"
                                           data-toggle="modal">
                                            <i class="fa fa-trash-alt text-danger pr-2"
                                               aria-hidden="true"></i> <?php echo app('translator')->get('Delete'); ?>
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- All Active Modal -->
    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('Active Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to active the Team"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="" class="btn btn-primary active-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- All Inactive Modal -->
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('DeActive Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to Deactive the Team"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="" class="btn btn-primary inactive-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div id="newModal" class="modal fade show" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('Add New'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.storeTeam')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark"><?php echo app('translator')->get('Game Category'); ?> </label>
                            <select class="form-control selectpicker" data-show-content="true" data-live-search="true"
                                    name="category">
                                <option value="" selected disabled><?php echo app('translator')->get('Select Game Category'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(old('category', $item->id)); ?>"
                                            data-content="<?php echo e($item->icon); ?> <?php echo e($item->name); ?>">
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category'];
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
                        <div class="form-group">
                            <label class="text-dark"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control" name="name">
                            <?php $__errorArgs = ['name'];
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
                        <div class="form-group">
                            <label for="image" class="text-dark"><?php echo app('translator')->get('Image'); ?></label>
                            <div class="image-input">
                                <label for="image-upload" id="image-label"><i
                                        class="fas fa-upload"></i></label>
                                <input type="file" name="image" placeholder="<?php echo app('translator')->get('Choose image'); ?>"
                                       id="image">
                                <img id="image_preview_container" class="preview-image"
                                     src="<?php echo e(getFile(config('location.team.path'))); ?>"
                                     alt="<?php echo app('translator')->get('preview image'); ?>">
                            </div>
                            <div>
                                <span
                                    class="text-secondary"><?php echo app('translator')->get('Image size'); ?> <?php echo e(config('location.team.size')); ?> <?php echo app('translator')->get('px'); ?></span>
                            </div>
                            <?php $__errorArgs = ['image'];
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

                        <div class="form-group">
                            <label for="status" class="text-dark"> <?php echo app('translator')->get('Status'); ?> </label>
                            <input data-toggle="toggle" id="status" data-onstyle="success" data-offstyle="info"
                                   data-on="Active" data-off="Deactive" data-width="100%" type="checkbox" name="status">
                            <?php $__errorArgs = ['status'];
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Save'); ?></button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="editModal" class="modal fade show" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('Edit Team'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-dark"><?php echo app('translator')->get('Game Category'); ?> </label>
                            <select id="editCategory" class="form-control selectpicker" data-show-content="true"
                                    data-live-search="true"
                                    name="category" required>
                                <option value=""><?php echo app('translator')->get('Select Game Category'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" data-content="<?php echo e($item->icon); ?> <?php echo e($item->name); ?>">
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category'];
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
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-dark"><?php echo app('translator')->get('Image'); ?></label>
                            <div class="image-input ">
                                <label for="image-upload" id="image-label"><i
                                        class="fas fa-upload"></i></label>
                                <input type="file" name="image" placeholder="<?php echo app('translator')->get('Choose image'); ?>"
                                       id="editImage">
                                <img id="edit_image_preview_container" class="preview-image"
                                     src=""
                                     alt="<?php echo app('translator')->get('preview image'); ?>">
                            </div>
                            <div>
                                <span
                                    class="text-secondary"><?php echo app('translator')->get('Image size'); ?> <?php echo e(config('location.team.size')); ?> <?php echo app('translator')->get('px'); ?></span>
                            </div>
                            <?php $__errorArgs = ['image'];
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

                        <div class="form-group">
                            <label for="edit-status" class="text-dark"> <?php echo app('translator')->get('Status'); ?> </label>
                            <input data-toggle="toggle" id="edit-status" data-onstyle="success" data-offstyle="info"
                                   data-on="Active" data-off="Deactive" data-width="100%" type="checkbox" name="status">
                            <?php $__errorArgs = ['status'];
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Update'); ?></button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Delete Confirmation'); ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure to delete this?'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <form action="" method="post" class="deleteRoute">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-select.min.css')); ?>">
    <link href="<?php echo e(asset('assets/admin/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <script src="<?php echo e(asset('assets/admin/js/fontawesome/fontawesomepro.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>

    <script src="<?php echo e(asset('assets/admin/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/datatable-basic.init.js')); ?>"></script>


    <script>
        $(function () {
            $('select').selectpicker();
        });
    </script>


    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>
    <script>
        'use strict'
        $(document).on('change', '#editImage', function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#edit_image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('change', '#image', function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.notiflix-confirm', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })

        $(document).on('click', '#check-all', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('change', ".row-tic", function () {
            let length = $(this).length;
            let checkedLength = $(".row-tic:checked").length;
            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        //multiple active
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.team-active')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                },
            });
        });

        //multiple deactive
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });
            var strIds = allVals;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.team-deactive')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                }
            });
        });

        $(document).on('click', '.removeBtn', function () {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $(document).on('click', '.editBtn', function () {
            var modal = $('#editModal');
            var category_id = $(this).data('category_id');
            $('#editCategory').selectpicker("val", "" + category_id);
            modal.find('input[name=name]').val($(this).data('title'));
            modal.find('form').attr('action', $(this).data('action'));
            modal.find('img').attr('src', $(this).data('image'));
            if ($(this).data('status') == 1) {
                $('#edit-status').bootstrapToggle('on')
            } else {
                $('#edit-status').bootstrapToggle('off')
            }
            modal.modal('show');
        });

        $(document).on('shown.bs.modal', '#editModal', function (e) {
            $(document).off('focusin.modal');
        });
        $(document).on('shown.bs.modal', '#newModal', function (e) {
            $(document).off('focusin.modal');
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/centur69/majesticsport.centurybreakcap.com/resources/views/admin/team/list.blade.php ENDPATH**/ ?>