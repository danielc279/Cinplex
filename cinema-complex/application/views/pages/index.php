<div class="justify-content-around col-12">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url('uploads/movies/images/uslarge.jpg'); ?>" alt="Us">
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url('uploads/movies/images/shazamlarge.jpg'); ?>" alt="Us">
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url('uploads/movies/images/glasslarge.jpg'); ?>" alt="Us">
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url('uploads/movies/images/toystory4large.jpg'); ?>" alt="Us">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only icon">Previous</span>
  </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only icon">Next</span>
  </a>
  </div>

  <div class="container col-8">
    <div class="flex">
      <div class="col-12">
        <div class="">
          <div class="header">
            Now Showing
          </div>
          <div class="flex m-auto">
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
            <div class="date titlesmall center">
              <a href="<?php echo site_url("pages/index/date"); ?>" class="d-block mx-2">
            <div class="date">
              2018-08-08
            </div>
            </a>
            </div>
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
          <?php if ($date['date'] == "2019-08-03"): ?>
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
                  <a class="details"> Release Date: <?php echo $movie['release_date']; ?> </a>
                </div>
                <div class="row col-12 mt-2">
                  <?php foreach ($movie['time'] as $time): ?>
                                    <?php if ($time['date'] == $date['date']): ?>
                      <a href="<?php echo site_url("pages/ticket/{$movie['id']}"); ?>" class="d-block mx-2">
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



        <div class="row">
          <div class="justify-content-around flex">
            <div class="">
              <img class="postersmedium" src="<?php echo base_url('/uploads/movies/images/advert.jpg'); ?>" />
            </div>
          </div>
          <div class="justify-content-around flex">
            <div class="pb-3">
              <img class="ads " src=<?php echo base_url('/uploads/movies/images/advert.jpg'); ?> alt="Ad">
            </div>
          </div>
          <div class="justify-content-around flex">
            <div class="pb-3">
              <img class="ads " src=<?php echo base_url('/uploads/movies/images/advert.jpg'); ?> alt="Ad">
            </div>
          </div>
          <div class="justify-content-around flex">
            <div class="pb-3">
              <img class="ads " src=<?php echo base_url('/uploads/movies/images/advert.jpg'); ?> alt="Ad">
            </div>
          </div>
          <div class="justify-content-around flex">
            <div class="pb-3">
              <img class="ads " src=<?php echo base_url('/uploads/movies/images/advert.jpg'); ?> alt="Ad">
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
