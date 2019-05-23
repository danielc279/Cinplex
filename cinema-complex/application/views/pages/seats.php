<?php echo form_open_multipart('pages/seats/submit', ['class' => 'row content']); ?>
<div class="container col-8">
  <div class="padding titlesmall pl-3 pb-3 pt-3">
    Select Seats
  </div>

  <div class="">
    <div class="row justify-content-around">
      <div class="justify-content-around flex">
        <div class="pb-3">
          <img class="posters" src="<?php echo base_url('uploads/movies/posters/'.$movie['id'].'.jpg'); ?>">
        </div>
      </div>
      <div class="text col-9">
        <div class="titlebig pb-3">
          <?php echo $movie['title']; ?>
        </div>
        <div class="">
          <a class="details"> <?php echo date('d M Y', strtotime($movie['date'])); ?> @ <?php echo $movie['time']; ?> </a>
          <a class="details"> Showing in <?php echo $movie['cinema']; ?>  </a>
          <a class="details"> Run Time: <?php echo $movie['runtime']; ?> </a>
          <a class="details"> Rating: <?php echo $movie['rating']; ?> </a>
        </div>
      </div>
    </div>
    <div class="ticketcontainer m-4">
      <div class="row col-12  justify-content-around p-3">
        <?php echo form_error('movie-rating'); ?>
        <div class="titlesmall col-8 mt-auto mb-auto">
          <div class="">
          Pick seats
          </div>
          <div class="">
          Each Seat @ €10
          </div>
          <div class="p-5  justify-content-around">
<?php
  $columns = $seats['columns'];
  $rows = $seats['rows'];
  for ($row = 0; $row < $rows; $row++):
?>
          <div style="overflow: hidden;" class="d-flex">

<?php
    for ($seat = 0; $seat < $columns; $seat++):
      $seat_num = ($row * $columns) + $seat;

      $booked = [0, 1, 3, 4, 6, 10, 12];
?>
            <input type="checkbox" name="seat[]" id="seat-<?php echo $seat_num; ?>" value="<?php echo $seat_num; ?>" class="seat" <?php if (in_array($seat_num, $booked)) echo " disabled"; ?>>

<?php endfor; ?>
      </div>

<?php endfor; ?>

          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-around pt-4">
        <a href="<?php echo site_url(""); ?>" class="d-block mx-2">
      <div class="date col-2">
        <button class="btn">Cancel</button>
      </div>
      </a>
      <a href="<?php echo site_url("pages/ticket"); ?>" class="d-block mx-2">
    <div class="date col-2">
      <button type="submit" class="btn">Submit</button>
    </div>
    </a>
<?php echo form_close(); ?>
