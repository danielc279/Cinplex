<div class="row content">
    <div class="col">

        <div class="card m-5">
            <div class="card-header border-bottom-0 d-flex">
                <a href="<?php echo site_url('date/edit'); ?>" class="ml-auto">Update Cycle</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="" style="width: 50%">Weekday</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($dates as $date): ?>
                        <tr>
                            <td class=""><?php echo $date['weekday']; ?></td>
                            <td class=""><?php echo date('d M Y', strtotime($date['date'])); ?></td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
