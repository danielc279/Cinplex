<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slot_model extends CI_Model
{
    // Creates an article and assigns its categories.
    public function create_slot($movie, $room, $date, $time)
    {
        // Create a slug from the title, and make sure we have categories.
        if ($time == NULL) $time = [];

        // Transactions will make queries temporary unless committed.
        // Queries will not work between start and complete.


        $this->db->trans_start();

            // Start with inserting the article.
            $slot = [
                'movie_id' => $movie,
                'room_id'  => $room,
                'date'     => $date
            ];
            $this->db->insert('tbl_showing', $slot);
            $insert_id = $this->db->insert_id();

            // Multiple categories can be chosen, we'll need to loop.
            if (count($time) > 0)
            {
                $inserts = [];
                foreach ($time as $tim)
                {
                    $inserts[] = [
                        'showing_id'    => $insert_id,
                        'time_id'   => $tim
                    ];
                }
                $this->db->insert_batch('tbl_showing_time', $inserts);
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
            return $insert_id;
        }
    }

    public function delete_slot($id)
    {
        $this->db->delete('tbl_showing_time', ['showing_id' => $id]);
        $this->db->delete('tbl_showing', ['id' => $id]);
    }

    public function delete_movie_slot($movie)
    {
      $this->db->delete('tbl_showing_time', ['movie_id' => $movie]);
      $this->db->delete('tbl_showing', ['movie_id' => $movie]);
    }

    // Retrieves a single article from the database.
    public function get_slot($id)
    {
        return $this->db
                    ->get_where('tbl_showing', ['id' => $id])
                    ->row_array();
    }

    public function get_slot_info($id, $movie_id, $time_id)
    {
      return $this->db->select('a.*, b.room_no AS cinema, c.title, d.rati')
                      ->order_by('c.title')
                      ->join('tbl_room b', 'a.room_id = b.id', 'left')
                      ->join('tbl_movies c', 'a.movie_id = c.id', 'left')
                      ->join('tbl_rating d', 'c.rating_id = d.id', 'left')
                      ->get_where('tbl_showing', ['id' => $id] && ['movie_id' => $movie_id] && ['id' => $time_id] )
                      ->row_array();
    }

    public function get_date_by_movie($movie_id)
    {
      return $this->db->select('date')
                      ->group_by('date')
                      ->get_where('tbl_showing', ['movie_id' => $movie_id])
                      ->result_array();
    }

    public function get_time_by_movie($movie_id)
    {
      return $this->db->select('a.date, c.time')
                      ->join('tbl_showing_time b', 'a.id = b.showing_id', 'left')
                      ->join('tbl_time c', 'b.time_id = c.id', 'left')
                      ->get_where('tbl_showing a', ['movie_id' => $movie_id])
                      ->result_array();
                    }

    // Retrieves articles from the database.
    public function get_slots()
    {
        return $this->db->select('a.*, b.room_no AS cinema, c.title')
                        ->order_by('c.title')
                        ->join('tbl_room b', 'a.room_id = b.id', 'left')
                        ->join('tbl_movies c', 'a.movie_id = c.id', 'left')
                        ->get('tbl_showing a')
                        ->result_array();
    }

    // Retrieves the categories for an article
    public function get_showing_time($id)
    {
        $results = $this->db->select('showing_id')
                            ->get_where('tbl_showing_time', ['showing_id' => $id])
                            ->result_array();

        $ids = [];
        foreach ($results as $row) $ids[] = $row['showing_id'];

        return $ids;
    }

    // Retrieve the list of categories as an array.
    public function get_times()
    {
        return $this->db->get('tbl_time')->result_array();
    }

    public function get_rooms()
    {
        return $this->db->get('tbl_room')->result_array();
    }

    public function get_room_seats($room_id)
    {
      return $this->db->select('columns')
                      ->get_where('tbl_room', ['id' => $room_id])
                      ->row_array();
    }

    public function get_rooms_array()
    {
        // use a defined function to get the rows we need.
        $results = $this->get_rooms();
        $rooms = [];

        // fill in the blank array using a foreach loop.
        foreach ($results as $row) $rooms[$row['id']] = $row['room_no'];
        return $rooms;
    }

    public function get_showing_room($id)
    {
      return $this->db->select('b.columns, b.rows')
                          ->join('tbl_room b', 'a.room_id = b.id', 'left')
                          ->get_where('tbl_showing a', ['a.id' => $id])
                          ->row_array();
    }
    // Retrieve a list of categories as an [id = name] array.
    public function get_times_array()
    {
        // use a defined function to get the rows we need.
        $results = $this->get_times();
        $time = [];

        // fill in the blank array using a foreach loop.
        foreach ($results as $row) $time[$row['id']] = $row['time'];
        return $time;
    }

    // Replaces the categories for an article.
    public function replace_time($id, $time = [])
    {
        $this->db->trans_start();

            $this->db->delete('tbl_showing_time', ['showing_id' => $id]);

            // Multiple categories can be chosen, we'll need to loop.
            if (count($time) > 0)
            {
                $inserts = [];
                foreach ($time as $tim)
                {
                  $inserts[] = [
                      'showing_id'   => $id,
                      'time_id'   => $tim
                  ];
                }
                $this->db->insert_batch('tbl_showing_time', $inserts);
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

    public function check_showing($movie, $room, $date)
    {
        return $this->db->where('tbl_showing', [
            'movie_id'  => $movie,
            'room_id'   => $room,
            'date'      => $date
        ])->count_all_results() == 1;
    }

    public function get_movies_showing($id = NULL)
    {
        $this->db->select('a.*, a.id AS slot_id, b.*, c.name AS rating, d.room_no AS cinema')
                    ->order_by('b.release_date')
                    ->group_by('a.movie_id')
                    ->join('tbl_movies b', 'a.movie_id = b.id', 'left')
                    ->join('tbl_rating c','b.rating_id = c.id', 'left')
                    ->join('tbl_room d','d.id = a.room_id', 'left');

        if ($id == NULL)
        {
            return $this->db->get('tbl_showing a')
                            ->result_array();
        }
        else
        {
            return $this->db->get_where('tbl_showing a', ['a.id' => $id])
                            ->row_array();
        }
    }

    public function get_movie_times($id)
    {
        return $this->db->select('a.date, b.time_id')
                        ->order_by('a.date')
                        ->join('tbl_showing_time b', 'a.id = b.get_showing_timeid', 'left')
                        ->get_where('tbl_showing a', ['id' => $id])
                        ->result_array();
    }

    // Updates the article title in the database.
    public function update_showing($id, $movie, $room, $date)
    {

        $this->db->where('id', $id)
                ->update('tbl_showing', [
                  'movie_id'  => $movie,
                  'room_id'   => $room,
                  'date'      => $date
                ]);

        // to check that this query worked, we'll check the affected rows.
        return $this->db->affected_rows() == 1;
    }
}
