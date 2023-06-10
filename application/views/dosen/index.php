<a href="<?php echo site_url('dosen/tambah'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<legend>Data Dosen</legend>
<?php echo $message; ?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>NIP Dosen</td>
            <td>Nama</td>
            <td>Bidang Keahlian</td>
            <td>Telepon</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no = 0;
    foreach ($dosen as $row) : $no++; ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row->nip; ?></td>
            <td><?php echo $row->nama_dosen; ?></td>
            <td><?php echo $row->bidang; ?></td>
            <td><?php echo $row->telp; ?></td>
            <td><a href="<?php echo site_url('dosen/edit/' . $row->nip); ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
            <td><a href="#" class="hapus" kode="<?php echo $row->nip; ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
    <?php endforeach; ?>
</Table>
<script>
    $(function() {
        $(".hapus").click(function() {
            var kode = $(this).attr("kode");

            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });

        $("#konfirmasi").click(function() {
            var kode = $("#idhapus").val();

            $.ajax({
                url: "<?php echo site_url('dosen/hapus'); ?>",
                type: "POST",
                data: "kode=" + kode,
                cache: false,
                success: function(html) {
                    location.href = "<?php echo site_url('dosen/index/delete_success'); ?>";
                }
            });
        });
    });
</script>