<div class="container col-8">
  <div>
    &nbsp;
  </div>
  <?php if (!$movies): ?>
                          <tr>
                              <td colspan="3">No movies on display.</td>
                          </tr>
  <?php else: foreach ($movies as $movie): ?>
  <div class="row justify-content-around">
    <div class="padding col-4">
      <img class="postersbig" src="<?php echo base_url('uploads/movies/posters/<?php echo $movie['posters']; ?>'); ?>" alt="Dumbo">
    </div>
    <div class="text col-8 padding">
      <div class="title">
        <?php echo $movie['title']; ?>
      </div>
      <div class="details">
        <a class=""> Release Date: <?php echo $movie['release_date']; ?> </a>
        <a class=""> &nbsp; | &nbsp; </a>
        <a class=""> Rating : <?php echo $movie['rating']; ?> </a>
        <a class=""> &nbsp; | &nbsp; </a>
        <a class=""> Run Time: <?php echo $movie['runtime']; ?> </a>
      </div>
      <div class="description">
        <?php echo $movie['desc']; ?>
      </div>
    </div>
  </div>

  <hr>
  <?php endforeach; endif; ?>
