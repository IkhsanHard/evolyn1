<?php
class Graph_model extends CI_Model
{

    public function getGraphData()
    {
        $this->db->select('menu.kategori, COUNT(menu.id_menu) AS jumlah_menu');
        $this->db->from('detail_order');
        $this->db->join('menu', 'detail_order.id_menu = menu.id_menu');
        $this->db->group_by('menu.kategori');
        $query = $this->db->get();

        return $query->result();
    }

    public function getDailySummary()
    {
        // SELECT tanggal_pemesanan, SUM(total_bayar) AS total_harian FROM orders GROUP BY DATE(tanggal_pemesanan)
        $this->db->select('DATE(tanggal_pemesanan) AS tanggal_pemesanan, SUM(total_bayar) AS total_harian');
        $this->db->from('orders');
        $this->db->group_by('DATE(tanggal_pemesanan)');

        return $this->db->get()->result();
    }
}
