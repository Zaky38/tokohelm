<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(url('dashboard')); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($no++); ?></td>
                                        <td><?php echo e($pesanan->tanggal); ?></td>
                                        <td>
                                        <?php if($pesanan->status_pembayaran == 'belum_bayar'): ?>
                                            Belum dibayar

                                        <?php elseif($pesanan->status == 'diproses'): ?>
                                            Sudah dibayar (sedang diproses)

                                        <?php elseif($pesanan->status == 'dikirim'): ?>
                                            Sedang dalam proses pengiriman

                                        <?php elseif($pesanan->status == 'selesai'): ?>
                                            Selesai

                                        <?php elseif($pesanan->status == 'dibatalkan'): ?>
                                            Pesanan dibatalkan
                                            
                                        <?php endif; ?>
                                        </td>
                                        <td>Rp. <?php echo e(number_format($pesanan->total_harga)); ?></td>
                                        <td>

                                        <a
                                            href="<?php echo e(url('history/'.$pesanan->id)); ?>"
                                            class="btn btn-primary"
                                        >
                                            Detail
                                        </a>

                                        <?php if($pesanan->status == 'dikirim'): ?>

                                            <a
                                                href="<?php echo e(url('struk/'.$pesanan->id)); ?>"
                                                class="btn btn-success"
                                                >
                                                    Download Struk
                                                </a>

                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\tokohelm\resources\views/history/index.blade.php ENDPATH**/ ?>