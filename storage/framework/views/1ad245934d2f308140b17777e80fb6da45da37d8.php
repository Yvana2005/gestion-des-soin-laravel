<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New Prescription')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <form method="post" action="<?php echo e(route('prescription.store_id', ['id' => $userId])); ?>">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label ><?php echo e(__('sentence.Prescription Name')); ?> :</label>
                            <input type="text" class="form-control" id="Nom" name="nom">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label ><?php echo e(__('sentence.Prescription dosage')); ?> :</label>
                            <input type="number" class="form-control" name="dosage">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                            <input type="hidden" class="form-control" value="<?php echo e($userId); ?>" name="patient_id"
                                readonly>
                            <input type="text" class="form-control" value="<?php echo e($userName); ?>" readonly>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label for="DoctorID"><?php echo e(__('sentence.Doctors')); ?> :</label>

                            <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" class="form-control" name="Doctor_id"
                                readonly>
                            <input type="text" class="form-control" value="<?php echo e(Auth::user()->name); ?>" readonly>
                            

                            

                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group text-center ">
                            <img src="<?php echo e(asset('img/patient-icon.png')); ?>"
                                class="img-profile rounded-circle img-fluid w-50 h-50">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?php echo e(__('sentence.Create Prescription')); ?>"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Drugs list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Tests list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect-search').select2();

            // Get references to the patient and test select elements
            const patientSelect = $('#PatientID');
            const testSelect = $('#test');

            // Store the original test options
            const originalTestOptions = testSelect.html();

            // Function to update test options based on the selected patient
            function updateTestOptions() {
                const selectedPatientName = patientSelect.find('option:selected').text();

                // Clear and restore original test options
                testSelect.empty().html(originalTestOptions);

                // Filter and show test options based on the selected patient
                testSelect.find('option').each(function() {
                    const optionText = $(this).text();
                    if (optionText.includes(selectedPatientName)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Trigger the Select2 plugin to update the dropdown
                testSelect.trigger('change');
            }

            // Attach a change event listener to the patient select element
            patientSelect.on('change', function() {
                updateTestOptions();
            });
        });
    </script>

    <script type="text/template" id="drugs_labels">
    <section class="field-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group-custom">
                                        <input type="text" class="form-control"
                                        name="type[]" id="task_{?}" placeholder="<?php echo e(__('sentence.Type')); ?>"
                                        class="ui-autocomplete-input" style="
                                                                            color: #28a745;
                                                                            background-color: transparent;
                                                                            border-color: #28a745;"
                                        value="new" autocomplete="off" @readonly(true)>
                                        <label class="control-label"></label><i class="bar"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control multiselect-search" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                                        <?php if(@empty($drugs)): ?>
                                            <option value=""><?php echo e(__('sentence.Select Drug')); ?>...</option>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->trade_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <div id="genericNames"></div>
                                </div>

                                
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group-custom">
                                        <input type="number" min="0" id="dose" name="dose[]" class="form-control"  placeholder="<?php echo e(__('sentence.Dose')); ?>" @required(true)>
                                        <label class="control-label"></label><i class="bar"></i>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="date" id="duration" name="duration[]" class="form-control" placeholder="<?php echo e(__('sentence.Duration')); ?>" @readonly(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group-custom">
                                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control" placeholder="<?php echo e(__('sentence.Advice_Comment')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                        <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                                </div>
                                <div class="col-12">
                                        <hr color="#a1f1d4">
                                </div>
                            </div>
        </section>
</script>
    <script type="text/template" id="test_labels">
                         <div class="field-group row">
                             <div class="col-md-4">
                                 <select class="form-control multiselect-search" name="test_name[]" id="test" tabindex="-1" aria-hidden="true" required>
                                   <?php if(@empty($tests)): ?>
                                    <option value=""><?php echo e(__('sentence.Select Test')); ?>...</option>
                                   <?php else: ?>
                                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(Auth::user()->role_id == 2 && Auth::user()->id == $test->created_by): ?>
                                        <option value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?></option>
                                    <?php elseif(Auth::user()->role_id == 1): ?>
                                    <option value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>

                                 </select>
                             </div>

                             <div class="col-md-4">
                                 <div class="form-group-custom">
                                     <input type="text" id="strength" name="description[]"  class="form-control" placeholder="<?php echo e(__('sentence.Description')); ?>">
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Remove')); ?></a>

                              </div>
                              <div class="col-12">
                                    <hr color="#a1f1d4">
                              </div>
                         </div>
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/prescription/create_By_user.blade.php ENDPATH**/ ?>