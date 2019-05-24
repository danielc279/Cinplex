<div class="justify-content-around col-12">
  <div class="container col-8">

    <div class="flex">
      <div class="col-12">
          <div class="">
              <div class="header">
                Thank You For Booking With Cinplex!
              </div>

              <div class="p-4 containersmall  m-auto col-3">
                  <div class="padding">
                    <a class="details pt-3"> Email: <?php echo $booking['email']; ?>  </a>
                    <a class="details pt-3"> Title: <?php echo $booking['title']; ?> </a>
                    <a class="details pt-3"> Cinema: <?php echo $booking['cinema']; ?> </a>
                    <a class="details pt-3"> Seats: <?php echo $booking['seat']; ?> </a>
                    <a class="details pt-3"> Date: <?php echo date('d M Y', strtotime($booking['date'])); ?> </a>
                    <a class="details pt-3"> Time: <?php echo $booking['time']; ?> </a>
                  </div>
              </div>

              <div class="padding center m-auto block ">
                <img class="" src="<?php echo base_url('uploads/movies/images/barcode.png'); ?>" />
                <div class="pt-5">
                    Please print this ticket and provide it at the cinema check in.
                </div>
              </div>
          </div>

</div>
