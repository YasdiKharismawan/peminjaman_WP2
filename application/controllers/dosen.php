<?php
class dosen extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'pagination', 'form_validation', 'upload'));
        $this->load->model('m_dosen');
    }

    function index()
    {
        $data['dosen'] = $this->m_dosen->tampilData()->result();
        $config['base_url'] = site_url('dosen/index/');

        if ($this->uri->segment(3) == "delete_success")
            $data['message'] = "<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if ($this->uri->segment(3) == "add_success")
            $data['message'] = "<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message'] = '';
        $this->template->display('dosen/index', $data);
    }
    function tambah()
    {
        $nip = $this->input->post('nip');
        if ($nip <> "") {
            $cek = $this->m_dosen->cek($nip);
            if ($cek->num_rows() > 0) {
                $data['message'] = "<div class='alert alert-warning'>NIP sudah digunakan</div>";
                $this->template->display('dosen/tambah', $data);
            } else {
                $isidata = array(
                    'nip' => $this->input->post('nip'),
                    'nama_dosen' => $this->input->post('nama_dosen'),
                    'bidang' => $this->input->post('bidang'),
                    'telp' => $this->input->post('telp')
                );
                $this->m_dosen->simpan($isidata);
                redirect('dosen/index/add_success');
            }
        } else {
            $data['message'] = "";
            $this->template->display('dosen/tambah', $data);
        }
    }
    function hapus()
    {
        $nip = $this->input->post('kode');
        $this->m_dosen->hapus($nip);
    }
    function edit($id)
    {
        $nip = $this->input->post('nip');
        $nama_dosen = $this->input->post('nama_dosen');
        $bidang = $this->input->post('bidang');
        $telp = $this->input->post('telp');
        if ($nip <> "" and $nama_dosen <> "" and $bidang <> "" and $telp <> "") {
            $isidata = array(
                'nama_dosen' => $this->input->post('nama_dosen'),
                'bidang' => $this->input->post('bidang'),
                'telp' => $this->input->post('telp')
            );
            $this->m_dosen->update($nip, $isidata);
            $data['message'] = "<div class='alert alert-success'>Data Berhasil diupdate</div>";
            $data['dsn'] = $this->m_dosen->cek($id)->row_array();
            $this->template->display('dosen/edit', $data);
        } else {
            $data['dsn'] = $this->m_dosen->cek($id)->row_array();
            $data['message'] = "";
            $this->template->display('dosen/edit', $data);
        }
    }
}
