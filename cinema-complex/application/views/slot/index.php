<div class="row content">
    <div class="col">

        <div class="card m-5">
            <div class="card-header border-bottom-0 d-flex">
                <a href="<?php echo site_url('slot/create'); ?>" class="ml-auto">New Slot</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="" style="width: 30%">Movie</th>
                            <th scope="col">Cinema</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$slots): ?>
                        <tr>
                            <td colspan="12">No slots in the database.</td>
                        </tr>
<?php else: foreach ($slots as $slot): ?>
                        <tr>
                            <td class="text-left"><?php echo $slot['title']; ?></td>
                            <td class=""><?php echo $slot['cinema']; ?></td>
                            <td class=""><?php echo date('d M Y', strtotime($slot['date'])); ?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("slot/edit/{$slot['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo site_url("slot/delete/{$slot['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
<?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
