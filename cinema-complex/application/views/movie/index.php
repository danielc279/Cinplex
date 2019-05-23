<div class="row content">
    <div class="col">

        <div class="card m-5">
            <div class="card-header border-bottom-0 d-flex">
                <a href="<?php echo site_url('movie/create'); ?>" class="ml-auto">New Movie</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="" style="width: 30%">Title</th>
                            <th scope="col">Release Date</th>
                            <th scope="col">Runtime</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$movies): ?>
                        <tr>
                            <td colspan="12">No movies in the database.</td>
                        </tr>
<?php else: foreach ($movies as $movie): ?>
                        <tr>
                            <td class="text-left"><?php echo $movie['title']; ?></td>
                            <td class=""><?php echo date('d M Y', strtotime($movie['release_date'])); ?></td>
                            <td class=""><?php echo $movie['runtime']; ?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("movie/edit/{$movie['slug']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo site_url("movie/delete/{$movie['slug']}"); ?>" class="d-block mx-2">
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
