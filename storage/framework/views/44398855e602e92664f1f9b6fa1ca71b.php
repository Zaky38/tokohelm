<style>
    body {
        background: #f5f6f8;
        font-family: 'Inter', sans-serif;
    }

    /* CARD */
    .payment-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px;
        max-width: 460px;
        margin: 80px auto;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    /* BRAND */
    .brand {
        text-align: center;
        margin-bottom: 25px;
    }

    .brand img {
        width: 70px;
        opacity: 0.9;
    }

    .brand-title {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-top: 8px;
    }

    /* TITLE */
    .title {
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }

    .subtitle {
        font-size: 13px;
        color: #6b7280;
        text-align: center;
    }

    /* TOTAL */
    .total {
        font-size: 36px;
        font-weight: 700;
        letter-spacing: -0.5px;
        text-align: center;
    }

    /* DIVIDER */
    .divider {
        height: 1px;
        background: #eee;
        margin: 25px 0;
    }

    /* VA BOX */
    .va-box {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 22px;
        background: #fafafa;
    }

    /* HEADER */
    .va-header {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    /* NOMOR VA */
    .va-number {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
    }

    /* COPY BUTTON */
    .copy-btn {
        border: 1px solid #e5e7eb;
        background: #fff;
        border-radius: 10px;
        padding: 6px 14px;
        font-size: 12px;
        cursor: pointer;
        transition: 0.2s;
    }

    .copy-btn:hover {
        background: #f3f4f6;
    }

    /* NOTE */
    .note {
        text-align: center;
        font-size: 12px;
        color: #ef4444;
        margin-top: 8px;
    }

    /* DIVIDER DALAM */
    .inner-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 18px 0;
    }

    /* STATUS */
    .status-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-pill {
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-wait {
        background: #fff7ed;
        color: #3a1a0d;
    }

    .status-done {
        background: #ecfdf5;
        color: #047857;
    }

    /* BUTTON */
    .btn-main {
        background: #111;
        color: #fff;
        border-radius: 12px;
        padding: 14px;
        font-weight: 500;
        border: none;
        transition: 0.2s;
        margin-top: 15px;
    }

    .btn-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .btn-main:hover {
        background: #000;
        transform: translateY(-1px);
    }

    /* UPLOAD */
    .upload-area{
        margin-top:20px;
        border:2px dashed #d1d5db;
        border-radius:16px;
        padding:24px;
        text-align:center;
        background:#fff;
        cursor:pointer;

    transition:0.25s;
    }

    .upload-area:hover{
        border-color:#111;
        background:#fafafa;
        transform:translateY(-2px);
    }

    .upload-label{
        display:block;
        cursor:pointer;
    }

    .upload-icon{
    font-size:34px;
    margin-bottom:10px;
    transition:0.25s;
}

    .upload-success{
    animation:pop .35s ease;
    color:#22c55e;
    }

    @keyframes pop{

    0%{
    transform:scale(0.6);
    }

    70%{
    transform:scale(1.2);
    }

    100%{
    transform:scale(1);
    }

    }

    .upload-title{
        font-weight:600;
        margin-bottom:6px;
    }

    .upload-sub{
        color:#6b7280;
        font-size:13px;
    }

    .file-input{
        display:none;
    }

    .file-name{
        margin-top:12px;
        color:#111;
        font-size:14px;
        font-weight:500;
        transition:.25s;
    }

.btn-main{
    width:100%;
}

    /* SMALL TEXT */
    .note {
        font-size: 13px;
        /* samakan */
        color: #6b7280;
        /* samakan */
        text-align: center;
        margin-top: 8px;
    }

    .total-wrapper {
        margin-top: 30px;
        /* atur mau turun berapa */
    }

    .subtitle {
        margin-bottom: 10px; /* ini yang bikin turun 1 */
    }
</style>

<div class="payment-card">

    <!-- BRAND -->
    <div class="brand">
        <img src="<?php echo e(asset('images/helmlogo.png')); ?>" alt="logo">
    </div>

    <!-- TITLE -->
    <div class="mb-4">
        <div class="title">Menunggu Pembayaran</div>
    </div>

    <!-- TOTAL -->
    <div class="mb-3 total-wrapper">
        <div class="subtitle">Total Pembayaran</div>
        <div class="total">
            Rp <?php echo e(number_format($pesanan->total_harga)); ?>

        </div>
    </div>

    <div class="divider"></div>

    <div class="va-box">

        <!-- HEADER -->
        <div class="va-header">Virtual Account</div>

        <!-- NOMOR -->
        <div class="va-number" id="vaNumber">

    <?php if($pesanan->metode_pembayaran == 'bca'): ?>
        1234567890

    <?php elseif($pesanan->metode_pembayaran == 'bri'): ?>
        9876543210

    <?php elseif($pesanan->metode_pembayaran == 'mandiri'): ?>
        555666777

    <?php endif; ?>

</div>

        <!-- NOTE -->
        <div class="note">
            Selesaikan Pembayaran
        </div>

        <div class="inner-divider"></div>

        <!-- STATUS -->
        <div class="status-row">
            <span class="subtitle">Status</span>

            <?php if($pesanan->status_pembayaran == 'belum_bayar'): ?>
                <span class="status-pill status-wait">Menunggu</span>
            <?php else: ?>
                <span class="status-pill status-done">Lunas</span>
            <?php endif; ?>
        </div>

        <!-- BUTTON -->
        <form action="<?php echo e(url('pembayaran/' . $pesanan->id)); ?>"
        method="POST"
        enctype="multipart/form-data">

    <?php echo csrf_field(); ?>

        <div class="upload-area">

        <label
        class="upload-label"
        for="bukti_transfer">

        <div
            id="uploadIcon"
            class="upload-icon">
            📎
        </div>

    <div class="upload-title">
    Upload Bukti Transfer
    </div>

    <div class="upload-sub">
    PNG / JPG / JPEG
    </div>

    </label>

    <input
        id="bukti_transfer"
        type="file"
        name="bukti_transfer"
        class="file-input"
        accept="image/*"
        required>

        <div
        id="fileName"
        class="file-name">

        Belum ada file dipilih

        </div>

        <?php $__errorArgs = ['bukti_transfer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-danger mt-2">
        <?php echo e($message); ?>

        </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        </div>

        <div class="btn-wrapper">

        <button class="btn-main">

        Saya Sudah Bayar

        </button>

        </div>

        </form>

    </div>
    <script>

document
    .getElementById('bukti_transfer')
    .addEventListener('change', function () {

        let fileName =
            document.getElementById('fileName')

        let icon =
            document.getElementById('uploadIcon')

        if (this.files[0]) {

            fileName.innerText =
                '✅ Bukti transfer siap dikirim'

            icon.innerText =
                '✔️'

            icon.classList.remove(
                'upload-success'
            )

            void icon.offsetWidth

            icon.classList.add(
                'upload-success'
            )

        } else {

            fileName.innerText =
                'Belum ada file dipilih'

            icon.innerText =
                '📎'

        }

    })

</script><?php /**PATH C:\xampp\htdocs\tokohelm\resources\views/pembayaran.blade.php ENDPATH**/ ?>