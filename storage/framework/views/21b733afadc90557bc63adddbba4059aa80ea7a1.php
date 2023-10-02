<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Add Drug')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col">
            <div class="alert alert-warning">
                Il est important de savoir que vous devez utiliser des produits provenant de l'application de gestion des
                stocks pour créer un nouveau soin. Vous pouvez
                <br>
                <a href="#" id="importCSVLink" data-toggle="modal" data-target="#importCSVModal"><b>Importez le fichier
                        "product.csv"</b></a> pour commencer.
                <br><b>Note:</b> ce fichier se télécharge sur la liste des produits de l'application de gestion de stock.
            </div>
        </div>
    </div>

    <!-- Modal for CSV Import -->
    <div class="modal fade" id="importCSVModal" tabindex="-1" role="dialog" aria-labelledby="importCSVModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header btn-primary">
                    <h5 class="modal-title " id="importCSVModalLabel">Importer la dernière version <b>"product.csv"</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('process.csv')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <!-- Input field for CSV file upload -->
                        <div class="form-group">
                            <label for="csvFile">Sélectionnez le fichier CSV :</label>
                            <input type="file" name="csvFile" id="csvFile" accept=".csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" id="importCSVButton">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Add Drug')); ?></h6>
                </div>
                <div class="card-body">

                    <form method="post" action="<?php echo e(route('drug.store')); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo e(__('sentence.Trade Name')); ?> <font color="red">*</font>
                            </label>
                            <input type="text" class="form-control" name="trade_name" id="TradeName"
                                aria-describedby="TradeName">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo e(__('sentence.Generic Name')); ?><font color="red">*
                                </font></label>
                            <input type="text" class="form-control" name="generic_name" id="GenericName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo e(__('sentence.Note')); ?></label>
                            <input type="text" class="form-control" name="note" id="Note">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/drug/create.blade.php ENDPATH**/ ?>