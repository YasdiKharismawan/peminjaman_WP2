<?php echo $message; ?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-lg-2 control-label">NIP</label>
        <div class="col-lg-5">
            <input type="text" name="nip" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Dosen</label>
        <div class="col-lg-5">
            <input type="text" name="nama_dosen" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Bidang Keahlian</label>
        <div class="col-lg-5">
            <select name="bidang" class="form-control">
                <option></option>
                <option value="Ilmu Komputer">Ilmu Komputer</option>
                <option value="Ilmu Akuntansi Bisnis">Ilmu Akuntansi Bisnis</option>
                <option value="Ilmu Administrasi Kantor">Ilmu Administrasi Kantor</option>
                <option value="Ilmu Keperawatan">Ilmu Keperawatan</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Telepon</label>
        <div class="col-lg-5">
            <input type="text" name="telp" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('dosen'); ?>" class="btn btn-default">Kembali</a>
    </div>
</form>