
<div class="container col-8">
  <div>
    &nbsp;
  </div>
  <div class="padding titlesmall pl-3 pb-3">
    Click on any film time to book.
  </div>
  <?php if (!$movies): ?>
                          <tr>
                              <td colspan="3">No movies on display.</td>
                          </tr>
  <?php else: foreach ($movies as $movie): ?>
  <div class="">
    <div class="row justify-content-around">
      <div class="justify-content-around flex">
        <div class="pb-3">
          <img class="posters" src="<?php echo base_url('uploads/movies/posters/'.$movie['movie_id'].'.jpg'); ?>">
        </div>
      </div>
      <div class="text col-9">
        <div class="titlebig pb-3">
          <?php echo $movie['title']; ?>
        </div>
        <div class="">
          <a class="details"> Rating: <?php echo $movie['rating']; ?> </a>
          <a class="details"> Run Time: <?php echo $movie['runtime']; ?> </a>
          <a class="details"> Release Date: <?php echo date('d M Y', strtotime($movie['release_date'])); ?> </a>
        </div>
      </div>
    </div>
    <div class="hr">
    </div>
      <?php foreach ($movie['date'] as $date): ?>
    <div class="row justify-content-around">
      <div class="col-12">
        <div class="row">
          <div class="center titlesmall col-3">
            <?php echo date('d M Y', strtotime($date['date'])); ?>
          </div>
          <div class="col-7">
            <div class="row">
              <?php foreach ($movie['time'] as $time): ?>
                <?php if ($time['date'] == $date['date']): ?>
                      <a href="<?php echo site_url("pages/seats/{$time['date']}/{$time['time']}/{$movie['slot_id']}"); ?>" class="d-block mx-2">
                <div class="date col-2">

                  <button class="btn"><?php echo $time['time']; ?></button>
                </div>
                    </a>
    <?php endif; endforeach;  ?>
            </div>
          </div>
        </div>
        <div class="hr">
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
<?php endforeach; endif; ?>
