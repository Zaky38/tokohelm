<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold">
            📦 Data Barang
        </h3>

        <small class="text-muted">
            Kelola seluruh produk toko
        </small>
    </div>

    <a
        href="/admin/barang/create"
        class="btn btn-success shadow-sm"
    >
        + Tambah Barang
    </a>

</div>


<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th>No</th>

                    <th>Produk</th>

                    <th>Harga</th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td>
                        <?php echo e($loop->iteration); ?>

                    </td>


                    <td>

                        <div class="d-flex align-items-center">

                            <img
                                src="<?php echo e(asset('uploads/'.$b->gambar)); ?>"
                                width="70"
                                height="70"

                                style="
                                    object-fit:cover;
                                    border-radius:12px;
                                "
                            >

                            <div class="ms-3">

                                <div class="fw-semibold">

                                    <?php echo e($b->nama_barang); ?>


                                </div>

                                <small class="text-muted">

                                    Stok:
                                    <?php echo e($b->quantity); ?>


                                </small>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span
                            class="
                                badge
                                bg-success
                                fs-6
                            "
                        >

                            Rp
                            <?php echo e(number_format($b->harga,0,',','.')); ?>


                        </span>

                    </td>


                    <td class="text-center">

                        <a
                            href="/admin/barang/<?php echo e($b->id); ?>/edit"

                            class="
                                btn
                                btn-warning
                                btn-sm
                            "
                        >

                            ✏️ Edit

                        </a>


                        <form
                            action="/admin/barang/<?php echo e($b->id); ?>"
                            method="POST"

                            style="
                                display:inline;
                            "
                        >

                            <?php echo csrf_field(); ?>

                            <?php echo method_field('DELETE'); ?>

                            <button

                                class="
                                    btn
                                    btn-danger
                                    btn-sm
                                "

                                onclick="
                                    return confirm(
                                        'Yakin mau hapus?'
                                    )
                                "

                            >

                                🗑️ Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td
                        colspan="4"
                        class="
                            text-center
                            text-muted
                            py-5
                        "
                    >

                        📦 Belum ada data barang

                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<div class="mt-4">

    <a
        href="/admin/dashboard"
        class="btn btn-primary shadow-sm"
    >

        ← Dashboard

    </a>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\tokohelm\resources\views/admin/barang/index.blade.php ENDPATH**/ ?>