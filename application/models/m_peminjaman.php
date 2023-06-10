<?php
class M_peminjaman extends CI_Model
{
    private $table = "peminjaman";

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    function nootomatis()
    {
        $today = date('Ymd');
        $query = $this->db->query("SELECT MAX(id_peminjaman) AS last FROM peminjaman WHERE id_peminjaman LIKE '$today%'");
        $data = $query->row();
        $lastNoFaktur = $data->last;

        if ($lastNoFaktur) {
            $lastNoUrut = substr($lastNoFaktur, 8, 3);
        } else {
            $lastNoUrut = 0;
        }

        $nextNoUrut = $lastNoUrut + 1;

        $nextNoTransaksi = $today . sprintf('%03s', $nextNoUrut);

        return $nextNoTransaksi;
    }
        // ...

    // Fungsi-fungsi lainnya dalam model
    // ...



    function getMhs()
    {
        return $this->db->get("mahasiswa");
    }
    function cariMahasiswa($nim)
    {
        $this->db->where("nim", $nim);
        return $this->db->get("mahasiswa");
    }
    function cariBuku($kode)
    {
        $this->db->where("kd_buku", $kode);
        return $this->db->get("buku");
    }
    function simpanTmp($info)
    {
        $this->db->insert("tmp", $info);
    }
    function tampilTmp()
    {
        return $this->db->get("tmp");
    }
    function cekTmp($kode)
    {
        $this->db->where("kd_buku", $kode);
        return $this->db->get("tmp");
    }
    function jumlahTmp()
    {
        return $this->db->count_all("tmp");
    }
    function hapusTmp($kode)
    {
        $this->db->where("kd_buku", $kode);
        $this->db->delete("tmp");
    }
    function simpan($info)
    {
        $this->db->insert("peminjaman", $info);
    }
    function pencarianbuku($cari)
    {
        $this->db->like("judul", $cari);
        return $this->db->get("buku");
    }
}
