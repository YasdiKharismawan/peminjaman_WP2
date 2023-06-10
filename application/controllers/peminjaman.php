<?php
class Peminjaman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'pagination', 'form_validation', 'upload'));
        $this->load->model('M_peminjaman');
    }
    function index()
    {
        $data['title'] = "Transaksi Peminjaman";
        $data['tanggalpinjam'] = date('Y-m-d');
        $data['tanggalkembali'] = strtotime('+7 day', strtotime($data['tanggalpinjam']));
        $data['noauto'] = $this->M_peminjaman->nootomatis();
        $data['anggota'] = $this->M_peminjaman->getMhs()->result();
        $data['tanggalkembali'] = date('Y-m-d', $data['tanggalkembali']);
        $this->template->display('peminjaman/index', $data);
    }
    function tampil()
    {
        $data['tmp'] = $this->M_peminjaman->tampilTmp()->result();
        $data['jumlahTmp'] = $this->M_peminjaman->jumlahTmp();
        $this->load->view('peminjaman/tampil', $data);
    }
    function sukses()
    {
        $tmp = $this->M_peminjaman->tampilTmp()->result();
        foreach ($tmp as $row) {
            $info = array(
                'id_peminjaman' => $this->input->post('nomer'),
                'nim' => $this->input->post('nim'),
                'kd_buku' => $row->kd_buku,
                'tanggal_pinjam' => $this->input->post('pinjam'),
                'tanggal_kembali' => $this->input->post('kembali'),
                'status' => "N"
            );
            $this->M_peminjaman->simpan($info);
            //hapus data di temporary
            $this->M_peminjaman->hapusTmp($row->kd_buku);
        }
    }
    function cariMahasiswa()
    {
        $nim = $this->input->post('nim');
        $mhs = $this->M_peminjaman->cariMahasiswa($nim);
        if ($mhs->num_rows() > 0) {
            $mhs = $mhs->row_array();
            echo $mhs['nama'];
        }
    }
    function cariBuku()
    {
        $kode = $this->input->post('kode');
        $buku = $this->M_peminjaman->cariBuku($kode);
        if ($buku->num_rows() > 0) {
            $buku = $buku->row_array();
            echo $buku['judul'] . "|" . $buku['pengarang'];
        }
    }
    function tambah()
    {
        $kode = $this->input->post('kode');
        $cek = $this->M_peminjaman->cekTmp($kode);
        if ($cek->num_rows() < 1) {
            $isidata = array(
                'kd_buku' => $this->input->post('kode'),
                'judul' => $this->input->post('judul'),
                'pengarang' => $this->input->post('pengarang')
            );
            $this->M_peminjaman->simpanTmp($isidata);
        }
    }
    function hapus()
    {
        $kode = $this->input->post('kode');
        $this->M_peminjaman->hapusTmp($kode);
    }
    function pencarianbuku()
    {
        $cari = $this->input->post('caribuku');
        $data['buku'] = $this->M_peminjaman->pencarianbuku($cari)->result();
        $this->load->view('peminjaman/pencarianbuku', $data);
    }
}
