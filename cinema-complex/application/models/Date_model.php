<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Date_model extends CI_Model
{
    // Retrieves articles from the database.
    public function get_date()
    {
        return $this->db->select('*')
                        ->get_where('tbl_cycle', ['id' => '0'])
                        ->row_array();
    }

    public function get_dates()
    {
        return $this->db->select('*')
                        ->get('tbl_cycle')
                        ->result_array();
    }

    // Updates the article title in the database.
    public function update_dates($id, $date)
    {
          $this->db->where('id', $id)
                  ->update('tbl_cycle', [
                    'date'         => $date
                  ]);

          // to check that this query worked, we'll check the affected rows.
          return $this->db->affected_rows() == 1;

    }
}
