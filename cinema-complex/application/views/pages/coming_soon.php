<div class="container col-8 pr-5">
  <div>
    &nbsp;
  </div>
  <?php if (!$movies): ?>
                          <tr>
                              <td colspan="3">No movies on display.</td>
                          </tr>
  <?php else: foreach ($movies as $movie): ?>
    <?php if (strtotime($movie['release_date']) > strtotime($datecode['date'])): ?>


  <div class="row justify-content-around">
    <div class="padding col-4">
      <img class="postersbig" src="<?php echo base_url('uploads/movies/posters/'.$movie['id'].'.jpg'); ?>">
    </div>
    <div class="text col-8 padding">
      <div class="title">
        <?php echo $movie['title']; ?>
      </div>
      <div class="details">
        <a class=""> Release Date: <?php echo date('d M Y', strtotime($movie['release_date'])); ?> </a>
        <a class=""> &nbsp; | &nbsp; </a>
        <a class=""> Rating : <?php echo $movie['rating']; ?> </a>
        <a class=""> &nbsp; | &nbsp; </a>
        <a class=""> Run Time: <?php echo $movie['runtime']; ?> </a>
      </div>
      <div class="description mt-3">
        <?php echo file_get_contents('uploads/movies/descriptions/'.$movie['id'].'.txt');?>
      </div>
    </div>
  </div>
  <hr>
        <?php endif; ?>
  <?php endforeach; endif; ?>
