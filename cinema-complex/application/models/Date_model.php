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

    // Replaces the categories for an article.
    public function replace_genre($id, $genre = [])
    {
        $this->db->trans_start();

            $this->db->delete('tbl_movie_genre', ['movie_id' => $id]);

            // Multiple categories can be chosen, we'll need to loop.
            if (count($genre) > 0)
            {
                $inserts = [];
                foreach ($genre as $gen)
                {
                  $inserts[] = [
                      'movie_id'   => $id,
                      'genre_id'   => $gen
                  ];
                }
                $this->db->insert_batch('tbl_movie_genre', $inserts);
            }

        $this->db->trans_complete();

        // If the query was not successful, we won't register
        // anything on the database.
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
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
