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
          <img class="posters" src="<?php echo base_url('uploads/movies/posters/'.$movie['id'].'.jpg'); ?>">
        </div>
      </div>
      <div class="text col-9">
        <div class="titlebig pb-3">
          <?php echo $movie['title']; ?>
        </div>
        <div class="">
          <a class="details"> Rating: <?php echo $movie['rating']; ?> </a>
          <a class="details"> Run Time: <?php echo $movie['runtime']; ?> </a>
          <a class="details"> <?php echo $movie['cinema']; ?> </a>
        </div>
      </div>
    </div>
    <div class="hr">
    </div>
    <div class="row justify-content-around">
      <div class="col-12">
        <div class="row">
        <?php foreach ($timeslots as $timeslot): ?>
          <div class="center titlesmall col-3">
            <?php echo $timeslot['date']; ?>
          </div>
          <div class="col-7">
            <div class="row">

              <form action="http://127.0.0.1:3000/ticketpage.html">
                <div class="date col-2">
                  <button class="btn"><?php echo $timeslot['time']; ?></button>
                </div>
              </form>

            </div>
          </div>
                <?php endforeach; ?>
        </div>
        <div class="hr">
        </div>
      </div>
    </div>
  </div>
<?php endforeach; endif; ?>
