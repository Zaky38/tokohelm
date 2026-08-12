

<?php $__env->startSection('content'); ?>

<h3>Tambah Barang</h3>

<form action="/admin/barang" method="POST" enctype="multipart/form-data">
    
    <?php echo csrf_field(); ?>
    <input type="text" name="nama_barang" class="form-control mb-2" placeholder="Nama Barang" required>
    <input type="number" name="rating" class="form-control mb-2" placeholder="Rating (1-5)" required>
    <textarea name="deskripsi_singkat" class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <input type="text" name="ukuran" class="form-control mb-2" placeholder="Ukuran">
    <input type="number" name="quantity" class="form-control mb-2" placeholder="Stok">
    <input type="number" name="harga" class="form-control mb-2" placeholder="Harga">
    <input type="file" name="gambar" class="form-control mb-3">
    <button class="btn btn-success">Simpan</button>
    <a href="/admin/barang" class="btn btn-primary">Kembali</a>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\tokohelm\resources\views/admin/barang/create.blade.php ENDPATH**/ ?>