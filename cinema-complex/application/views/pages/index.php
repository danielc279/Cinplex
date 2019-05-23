<div class="justify-content-around col-12">
  <div class="container col-8">
    <div class="padding center pt-3 m-auto ">
      <img class="" src="<?php echo base_url('uploads/movies/images/banner.jpg'); ?>" />
    </div>
    <div class="flex">
      <div class="col-12">
        <div class="">
          <div class="header">
            Now Showing
          </div>
          <div class="flex m-auto">
  <?php foreach ($weekdates as $weekdate): ?>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/{$weekdate['date']}"); ?>" class="d-block mx-2">
            <div class="">
              <td class=""><?php echo $weekdate['weekday']; ?><br></td>
              <td class=""><?php echo date('d M Y', strtotime($weekdate['date'])); ?></td>
            </div>
            </a>
            </div>
<?php endforeach; ?>
          </div>
          <div class="hr">
          </div>
        </div>

      <?php if (!$movies): ?>
                              <tr>
                                  <td colspan="3">No movies on display.</td>
                              </tr>
      <?php else: foreach ($movies as $movie): ?>
      <?php foreach ($movie['date'] as $date): ?>
          <?php if ($date['date'] == $datecode): ?>
            <div class="">
      <div class="row justify-content-around">

        <div class="padding center col-4">
          <img class="postersmedium" src="<?php echo base_url('uploads/movies/posters/'.$movie['movie_id'].'.jpg'); ?>" />
        </div>
        <div class="text col-sm-8 padding">
          <div class="titlebig">
            <?php echo $movie['title']; ?>
          </div>
          <div class="">
            <a class="details"> Rating: <?php echo $movie['rating']; ?> </a>
                  <a class="details"> Run Time: <?php echo $movie['runtime']; ?> </a>
                  <a class="details"> Release Date: <?php echo date('d M Y', strtotime($movie['release_date'])); ?> </a>
                </div>
                <div class="row col-12 mt-2">
          <?php foreach ($movie['time'] as $time): ?>
                <?php if ($time['date'] == $date['date']): ?>
                      <a href="<?php echo site_url("pages/seats/{$datecode}/{$time['time']}/{$movie['slot_id']}"); ?>" class="d-block mx-2">
                    <div class="date col-2">
                      <button class="btn"><?php echo $time['time']; ?></button>
                    </div>
                    </a>
          <?php endif; endforeach;?>
                </div>
              </div>

            </div>
            <div class="hr">
            </div>

          </div>
<?php endif; ?>
          <?php endforeach;?>
<?php endforeach; endif; ?>
      </div>
  </div>
</div>
