<?php
class m_buku extends CI_Model
{
    private $table = "buku";
    private $primary = "kd_buku";

    function tampilData()
    {
        if (empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary, 'asc');
        else
            $this->db->order_by();
        return $this->db->get($this->table);
    }

    function jumlah()
    {
        return $this->db->count_all($this->table);
    }

    function cek($kode)
    {
        $this->db->where($this->primary, $kode);
        $query = $this->db->get($this->table);

        return $query;
    }

    function simpan($coba)
    {
        $this->db->insert($this->table, $coba);
        return $this->db->insert_id();
    }

    function update($kode, $jenis)
    {
        $this->db->where($this->primary, $kode);
        $this->db->update($this->table, $jenis);
    }

    function hapus($kode)
    {
        $this->db->where($this->primary, $kode);
        $this->db->delete($this->table);
    }

    function cari($cari)
    {
        $this->db->like($this->primary, $cari);
        $this->db->or_like("nama", $cari);
        return $this->db->get($this->table);
    }
}
