<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
  // Creates an article and assigns its categories.
  public function create_ticket($user_id, $showing_id, $slot, $seats, $code)
  {
      // Transactions will make queries temporary unless committed.
      // Queries will not work between start and complete.
      $this->db->trans_start();

          // Multiple categories can be chosen, we'll need to loop.
          if (count($seats) > 0)
          {
              $inserts = [];
              foreach ($seats as $seat)
              {
                  $inserts[] = [
                    'user_id'     => $user_id,
                    'showing_id'  => $showing_id,
                    'time'        => $slot,
                    'seat'       => $seat,
                    'code'        => $code
                  ];
              }
              $this->db->insert_batch('tbl_ticket', $inserts);
          }

      // The querying is done.
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
      }
  }
  public function get_bookings_by_code($code)
  {
      return $this->db->select("a.time, e.email, b.date, d.title, c.room_no AS cinema, GROUP_CONCAT(a.seat SEPARATOR',') AS seat")
                  ->join('tbl_showing b', 'b.id = a.showing_id', 'left')
                  ->join('tbl_room c', 'c.id = b.room_id', 'left')
                  ->join('tbl_movies d', 'd.id = b.movie_id', 'left')
                  ->join('tbl_users e', 'e.id = a.user_id', 'left')
                  ->group_by('code')
                  ->get_where('tbl_ticket a', ['code' => $code])
                  ->row_array();
  }

  public function get_bookings_by_user($user_id)
  {
      return $this->db->select("*,GROUP_CONCAT(a.seat SEPARATOR',') AS seat")
                  ->join('tbl_showing b', 'b.id = a.showing_id', 'left')
                  ->join('tbl_room c', 'c.id = b.room_id', 'left')
                  ->join('tbl_movies d', 'd.id = b.movie_id', 'left')
                  ->group_by('code')
                  ->get_where('tbl_ticket a', ['user_id' => $user_id])
                  ->result_array();
  }

  public function get_seats_taken($showing_id, $time)
  {
      $seats = $this->db->select('seat')
                  ->get_where('tbl_ticket', ['showing_id' => $showing_id, 'time' => $time])
                  ->result_array();

        $data = [];
        foreach ($seats as $seat) $data[] = $seat['seat'];

        return $data;
  }
}
