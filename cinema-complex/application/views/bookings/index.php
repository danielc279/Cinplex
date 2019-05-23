<div class="row content">
    <div class="col">

        <div class="card m-5">
            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="" style="width: 30%">Movie</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Cinema</th>
                            <th scope="col">Seat/s</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$bookings): ?>
                                                <tr>
                                                    <td colspan="12">No bookings on this account.</td>
                                                </tr>
<?php else: foreach ($bookings as $booking): ?>
                        <tr>
                            <td class=""><?php echo $booking['title']; ?></td>
                            <td class=""><?php echo $booking['date']; ?></td>
                            <td class=""><?php echo $booking['time']; ?></td>
                            <td class=""><?php echo $booking['room_no']; ?></td>
                            <td><?php echo $booking['seat']; ?></td>
                        </tr>
<?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
