<a href="<?php echo site_url('buku/tambah'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<legend>Data Buku</legend>
<?php echo $message; ?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Kode Buku</td>
            <td>Judul</td>
            <td>Pengarang</td>
            <td>Jenis</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no = 0;
    foreach ($buku as $row) : $no++; ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row->kd_buku; ?></td>
            <td><?php echo $row->judul; ?></td>
            <td><?php echo $row->pengarang; ?></td>
            <td><?php echo $row->jenis; ?></td>
            <td><a href="<?php echo site_url('buku/edit/' . $row->kd_buku); ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
            <td><a href="#" class="hapus" kode="<?php echo $row->kd_buku; ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url: "<?php echo site_url('buku/hapus'); ?>",
                type: "POST",
                data: "kode=" + kode,
                cache: false,
                success: function(html) {
                    location.href = "<?php echo site_url('buku/index/delete_success'); ?>";
                }
            });
        });
    });
</script>