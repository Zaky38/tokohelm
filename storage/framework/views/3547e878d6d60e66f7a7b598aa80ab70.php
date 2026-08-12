<?php $__env->startSection('content'); ?>
<div class="container">

    <a href="<?php echo e(url('dashboard')); ?>" class="btn btn-primary mb-3">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <div class="card">
        <div class="card-body">
            <h3><i class="fa fa-shopping-cart"></i> Keranjang</h3>

            <?php if($pesanan): ?>

            <p class="text-end">Tanggal : <?php echo e($pesanan->tanggal); ?></p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>

                    <?php $__currentLoopData = $pesanan_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($item->nama_barang); ?></td>
                        <td><?php echo e($item->ukuran); ?></td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td>Rp <?php echo e(number_format($item->harga)); ?></td>
                        <td>Rp <?php echo e(number_format($item->subtotal)); ?></td>
                        <td>
                            <form action="<?php echo e(url('check-out/' . $item->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus item?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td colspan="5" class="text-end"><strong>Total</strong></td>
                        <td><strong>Rp <?php echo e(number_format($pesanan->total_harga)); ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- BUTTON CHECKOUT -->
            <button class="btn btn-success mb-3" onclick="toggleForm()">
                <i class="fa fa-credit-card"></i> Checkout
            </button>

            <!-- FORM (HIDDEN) -->
            <div id="formCheckout" style="display:none;">
            <form action="<?php echo e(url('konfirmasi-check-out')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-2">
                    <label><strong>Nama Penerima</strong></label>
                    <input type="text" name="nama_penerima" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label><strong>No HP</strong></label>
                    <input type="text"
                        name="no_hp"
                        class="form-control"
                        required
                        minlength="12"
                        maxlength="15"
                        pattern="[0-9]{12,15}"
                        title="Nomor HP harus 12-15 digit"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                </div>

                <!-- PULAU -->
                <div class="mb-2">
                    <label><strong>Pulau</strong></label>
                    <select id="pulau" name="pulau" class="form-control" required>
                        <option value="">-- Pilih Pulau --</option>
                        <option value="sumatra">Sumatra</option>
                        <option value="jawa">Jawa</option>
                        <option value="kalimantan">Kalimantan</option>
                        <option value="sulawesi">Sulawesi</option>
                        <option value="papua">Papua</option>
                    </select>
                </div>

                <!-- PROVINSI -->
                <div class="mb-2">
                    <label><strong>Provinsi</strong></label>
                    <select id="provinsi" name="provinsi" class="form-control" required>
                        <option value="">-- Pilih Provinsi --</option>
                    </select>
                </div>

                <!-- KOTA -->
                <div class="mb-2">
                    <label><strong>Kota</strong></label>
                    <select id="kota" name="kota" class="form-control" required>
                        <option value="">-- Pilih Kota --</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label><strong>Alamat Lengkap</strong></label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>

                <div class="mb-2">
                    <label><strong>Kurir</strong></label>
                    <select name="kurir" class="form-control" required>
                        <option value="">-- Pilih Kurir --</option>
                        <option value="jne">JNE</option>
                        <option value="jnt">J&T</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label><strong>Ongkir</strong></label>
                    <input type="number" id="ongkir" name="ongkir" class="form-control" readonly>
                </div>

                <div class="mb-2">
    <label><strong>Metode Pembayaran</strong></label>

    <select name="metode_pembayaran" class="form-control" required>
        <option value="">-- Pilih Virtual Account --</option>

        <option value="bca">
            Virtual Account BCA
        </option>

        <option value="bri">
            Virtual Account BRI
        </option>

        <option value="mandiri">
            Virtual Account Mandiri
        </option>
    </select>
</div>

                <button type="submit" class="btn btn-primary">
                        Konfirmasi Checkout
                    </button>
                </form>
            </div>

            <?php else: ?>
            <p>Keranjang kosong</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
function toggleForm(){
    let form = document.getElementById("formCheckout")
    form.style.display = (form.style.display === "none") ? "block" : "none"
}

document.addEventListener("DOMContentLoaded", function(){

    const pulauEl = document.getElementById("pulau")
    const provinsiEl = document.getElementById("provinsi")
    const kotaEl = document.getElementById("kota")
    const ongkirEl = document.getElementById("ongkir")

    // CEK BIAR GAK ERROR
    if(!pulauEl || !provinsiEl || !kotaEl || !ongkirEl) return

    // DATA
    const data = {
    sumatra: {
        "Aceh": ["Banda Aceh","Langsa","Lhokseumawe","Sabang","Subulussalam"],
        "Sumatera Utara": ["Medan","Binjai","Pematangsiantar","Tebing Tinggi","Tanjungbalai","Sibolga","Padangsidimpuan","Gunungsitoli"],
        "Sumatera Barat": ["Padang","Bukittinggi","Padang Panjang","Payakumbuh","Sawahlunto","Solok","Pariaman"],
        "Riau": ["Pekanbaru","Dumai"],
        "Kepulauan Riau": ["Batam","Tanjungpinang"],
        "Jambi": ["Jambi","Sungai Penuh"],
        "Bengkulu": ["Bengkulu"],
        "Sumatera Selatan": ["Palembang","Lubuklinggau","Prabumulih","Pagar Alam"],
        "Kepulauan Bangka Belitung": ["Pangkalpinang"],
        "Lampung": ["Bandar Lampung","Metro"]
    },

    jawa: {
        "Banten": ["Serang","Cilegon","Tangerang","Tangerang Selatan"],
        "DKI Jakarta": ["Jakarta Pusat","Jakarta Utara","Jakarta Barat","Jakarta Selatan","Jakarta Timur"],
        "Jawa Barat": ["Bandung","Bekasi","Bogor","Depok","Cimahi","Tasikmalaya","Banjar","Sukabumi","Cirebon"],
        "Jawa Tengah": ["Semarang","Surakarta","Magelang","Salatiga","Tegal","Pekalongan"],
        "DI Yogyakarta": ["Yogyakarta"],
        "Jawa Timur": ["Surabaya","Malang","Kediri","Blitar","Madiun","Pasuruan","Probolinggo","Mojokerto","Batu"]
    },

    kalimantan: {
        "Kalimantan Barat": ["Pontianak","Singkawang"],
        "Kalimantan Tengah": ["Palangka Raya"],
        "Kalimantan Selatan": ["Banjarmasin","Banjarbaru"],
        "Kalimantan Timur": ["Samarinda","Balikpapan","Bontang"],
        "Kalimantan Utara": ["Tarakan"]
    },

    sulawesi: {
        "Sulawesi Utara": ["Manado","Bitung","Tomohon","Kotamobagu"],
        "Gorontalo": ["Gorontalo"],
        "Sulawesi Tengah": ["Palu"],
        "Sulawesi Barat": ["Mamuju"],
        "Sulawesi Selatan": ["Makassar","Parepare","Palopo"],
        "Sulawesi Tenggara": ["Kendari","Baubau"]
    },

    papua: {
        "Papua": ["Jayapura"],
        "Papua Selatan": ["Merauke"],
        "Papua Tengah": ["Nabire"],
        "Papua Pegunungan": ["Wamena"],
        "Papua Barat": ["Manokwari"],
        "Papua Barat Daya": ["Sorong"]
    }
    }

    // EVENT PULAU
    pulauEl.addEventListener("change", function(){

        let pulau = this.value.toLowerCase()
        let ongkir = 0

        if(pulau == "sumatra") ongkir = 20000
        else if(pulau == "jawa") ongkir = 15000
        else if(pulau == "kalimantan") ongkir = 30000
        else if(pulau == "sulawesi") ongkir = 35000
        else if(pulau == "papua") ongkir = 50000

        ongkirEl.value = ongkir

        // RESET
        provinsiEl.innerHTML = '<option value="">-- Pilih Provinsi --</option>'
        kotaEl.innerHTML = '<option value="">-- Pilih Kota --</option>'

        // ISI PROVINSI
        if(data[pulau]){
            for(let p in data[pulau]){
                provinsiEl.innerHTML += `<option value="${p}">${p}</option>`
            }
        }
    })

    // EVENT PROVINSI
    provinsiEl.addEventListener("change", function(){

        let pulau = pulauEl.value.toLowerCase()
        let prov = this.value

        kotaEl.innerHTML = '<option value="">-- Pilih Kota --</option>'

        if(data[pulau] && data[pulau][prov]){
            data[pulau][prov].forEach(function(k){
                kotaEl.innerHTML += `<option value="${k}">${k}</option>`
            })
        }
    })

})
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\tokohelm\resources\views/pesan/check_out.blade.php ENDPATH**/ ?>