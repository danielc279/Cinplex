<?php echo form_open_multipart("pages/ticket/{$movie['id']}", ['class' => 'row content']); ?>
<div class="container col-8">
  <div class="padding titlesmall pl-3 pb-3">
    Select Ticket Types
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
          <a class="details"> <?php echo $slot['date']; ?> @ time </a>
          <a class="details"> Showing in <?php echo $slot['room_no']; ?>  </a>
          <a class="details"> Run Time: <?php echo $movie['runtime']; ?> </a>
          <a class="details"> Rating: <?php echo $slot['name']; ?> </a>
        </div>
      </div>
    </div>
    <div class="ticketcontainer m-4">
      <div class="row col-12">
        <div class="dropdown col-4">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ticket Amount
            <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a class="icon" href="#">1</a></li>
            <li><a class="icon" href="#">2</a></li>
            <li><a class="icon" href="#">3</a></li>
            <li><a class="icon" href="#">4</a></li>
            <li><a class="icon" href="#">5</a></li>
            <li><a class="icon" href="#">6</a></li>
          </ul>
        </div>
        <div class="titlesmall col-8 mt-auto mb-auto">
          Adult Regular Tickets @ €7.90
        </div>
      </div>
      <div class="row col-12">
        <div class="dropdown col-4">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ticket Amount
            <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a class="icon" href="#">1</a></li>
            <li><a class="icon" href="#">2</a></li>
            <li><a class="icon" href="#">3</a></li>
            <li><a class="icon" href="#">4</a></li>
            <li><a class="icon" href="#">5</a></li>
            <li><a class="icon" href="#">6</a></li>
          </ul>
        </div>
        <div class="titlesmall col-8 mt-auto mb-auto">
          Child Tickets @ €4.80
        </div>
      </div>
    </div>
    <div class="row justify-content-around pt-4">
      <form action="http://127.0.0.1:3000/home.html">
        <div class="date col-2">
          <button class="btn">Cancel</button>
        </div>
      </form>
      <form action="http://127.0.0.1:3000/seat.html">
        <div class="date col-2">
          <button class="btn">Proceed</button>
        </div>
      </form>
<?php echo form_close(); ?>
