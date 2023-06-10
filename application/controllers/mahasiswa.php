    <?php
    class mahasiswa extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->library(array('template', 'pagination', 'form_validation', 'upload'));
            $this->load->model('m_mahasiswa');
        }
        function index()
        {
            $data['mahasiswa'] = $this->m_mahasiswa->tampilData()->result();
            $config['base_url'] = site_url('mahasiswa/index/');
            if ($this->uri->segment(3) == "delete_success")
                $data['message'] = "<div class='alert alert-success'>Data berhasil dihapus</div>";
            else if ($this->uri->segment(3) == "add_success")
                $data['message'] = "<div class='alert alert-success'>Data Berhasil disimpan</div>";
            else
                $data['message'] = '';
            $this->template->display('mahasiswa/index', $data);
        }
        function tambah()
        {
            $nim = $this->input->post('nim');
            if ($nim <> "") {
                $cek = $this->m_mahasiswa->cek($nim);
                if ($cek->num_rows() > 0) {
                    $data['message'] = "<div class='alert alert-warning'>NIM sudah digunakan</div>";
                    $this->template->display('mahasiswa/tambah', $data);
                } else {
                    $isidata = array(
                        'nim' => $this->input->post('nim'),
                        'nama' => $this->input->post('nama'),
                        'jurusan' => $this->input->post('jurusan'),
                        'alamat' => $this->input->post('alamat')
                    );
                    $this->m_mahasiswa->simpan($isidata);
                    redirect('mahasiswa/index/add_success');
                }
            } else {
                $data['message'] = "";
                $this->template->display('mahasiswa/tambah', $data);
            }
        }
        function hapus()
        {
            $nim = $this->input->post('kode');
            $this->m_mahasiswa->hapus($nim);
        }

        function edit($id)
        {
            $nim = $this->input->post('nim');
            $nama = $this->input->post('nama');
            $jurusan = $this->input->post('jurusan');
            $alamat = $this->input->post('alamat');
            if ($nim <> "" and $nama <> "" and $jurusan <> "" and $alamat <> "") {
                $isidata = array(
                    'nama' => $this->input->post('nama'),
                    'jurusan' => $this->input->post('jurusan'),
                    'alamat' => $this->input->post('alamat')
                );
                $this->m_mahasiswa->update($nim, $isidata);
                $data['message'] = "<div class='alert alert-success'>Data Berhasil diupdate</div>";
                $data['mhs'] = $this->m_mahasiswa->cek($id)->row_array();
                $this->template->display('mahasiswa/edit', $data);
            } else {
                $data['mhs'] = $this->m_mahasiswa->cek($id)->row_array();
                $data['message'] = "";
                $this->template->display('mahasiswa/edit', $data);
            }
        }
    }
