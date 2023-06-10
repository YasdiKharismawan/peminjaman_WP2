<?php
class buku extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'pagination', 'form_validation', 'upload'));
        $this->load->model('m_buku');
    }

    function index()
    {
        $data['buku'] = $this->m_buku->tampilData()->result();
        $config['base_url'] = site_url('buku/index/');

        if ($this->uri->segment(3) == "delete_success")
            $data['message'] = "<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if ($this->uri->segment(3) == "add_success")
            $data['message'] = "<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message'] = '';
        $this->template->display('buku/index', $data);
    }
    function tambah()
    {
        $kd_buku = $this->input->post('kd_buku');
        if ($kd_buku <> "") {
            $cek = $this->m_buku->cek($kd_buku);
            if ($cek->num_rows() > 0) {
                $data['message'] = "<div class='alert alert-warning'>Buku sudah digunakan</div>";
                $this->template->display('buku/tambah', $data);
            } else {
                $isidata = array(
                    'kd_buku' => $this->input->post('kd_buku'),
                    'judul' => $this->input->post('judul'),
                    'pengarang' => $this->input->post('pengarang'),
                    'jenis' => $this->input->post('jenis')
                );
                $this->m_buku->simpan($isidata);
                redirect('buku/index/add_success');
            }
        } else {
            $data['message'] = "";
            $this->template->display('buku/tambah', $data);
        }
    }
    function hapus()
    {
        $kd_buku = $this->input->post('kode');
        $this->m_buku->hapus($kd_buku);
    }
    function edit($id)
    {
        $kd_buku = $this->input->post('kd_buku');
        $judul = $this->input->post('judul');
        $pengarang = $this->input->post('pengarang');
        $jenis = $this->input->post('jenis');
        if ($kd_buku <> "" and $judul <> "" and $pengarang <> "" and $jenis <> "") {
            $isidata = array(
                'judul' => $this->input->post('judul'),
                'pengarang' => $this->input->post('pengarang'),
                'jenis' => $this->input->post('jenis')
            );
            $this->m_buku->update($kd_buku, $isidata);
            $data['message'] = "<div class='alert alert-success'>Data Berhasil diupdate</div>";
            $data['bk'] = $this->m_buku->cek($id)->row_array();
            $this->template->display('buku/edit', $data);
        } else {
            $data['bk'] = $this->m_buku->cek($id)->row_array();
            $data['message'] = "";
            $this->template->display('buku/edit', $data);
        }
    }
}
