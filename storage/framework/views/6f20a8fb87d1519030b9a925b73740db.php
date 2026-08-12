

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            
            <?php if(session('success')): ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>
            
            <div class="col-md-12">
                <a href="<?php echo e(url('dashboard')); ?>" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?php echo e($barang->nama_barang); ?>

                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <!-- GAMBAR PRODUK -->
                            <div class="col-md-6">
                                <img src="<?php echo e(asset('uploads/' . $barang->gambar)); ?>" class="rounded mx-auto d-block"
                                    width="100%">
                            </div>

                            <!-- DETAIL PRODUK -->
                            <div class="col-md-6 mt-3">

                                <h2><?php echo e($barang->nama_barang); ?></h2>

                                <form method="post" action="<?php echo e(url('pesan/' . $barang->id)); ?>">
                                    <?php echo csrf_field(); ?>

                                    <table class="table">

                                        <tr>
                                            <td width="150">Harga</td>
                                            <td width="10">:</td>
                                            <td>Rp <?php echo e(number_format($barang->harga)); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td><?php echo e($barang->quantity); ?></td>
                                        </tr>

                                        <!-- PILIH UKURAN -->
                                        <tr>
                                            <td>Ukuran</td>
                                            <td>:</td>
                                            <td>
                                                <select name="ukuran" class="form-control" style="width:70px;" required>
                                                    <?php $__currentLoopData = explode(',', $barang->ukuran); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukuran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e(trim($ukuran)); ?>"><?php echo e(trim($ukuran)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <!-- JUMLAH PESAN -->
                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form method="post" action="<?php echo e(url('pesan')); ?>/<?php echo e($barang->id); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="text" name="jumlah_pesan" class="form-control" required="">
                                                    <button type="submit" class="btn btn-primary mt-2"><i
                                                            class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>

                                    </table>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\tokohelm\resources\views/pesan/index.blade.php ENDPATH**/ ?>