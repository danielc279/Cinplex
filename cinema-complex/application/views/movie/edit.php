<?php echo form_open_multipart("movie/edit/{$movie['slug']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('movie-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'movie-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Title',
                    'value'         => $movie['title'] ?: set_value('movie-title')
                ]); ?>

                <?php echo form_error('movie-desc'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'movie-desc',
                    'placeholder'   => 'This is the start of your next work!',
                    'class'         => 'form-control mb-3',
                    'value'         => $movie['desc'] ?: set_value('movie-desc')
                ]); ?>

                <?php echo form_error('movie-release'); ?>
                <?php echo custom_form_input('Release Date', [
                    'name'          => 'movie-release',
                    'class'         => 'form-control',
                    'placeholder'   => 'Release Date',
                    'value'         => $movie['release_date'] ?: set_value('movie-release')
                ]); ?>

                <?php echo form_error('movie-runtime'); ?>
                <?php echo custom_form_input('Runtime', [
                    'name'          => 'movie-runtime',
                    'class'         => 'form-control',
                    'placeholder'   => 'Runtime',
                    'value'         => $movie['runtime'] ?: set_value('movie-runtime')
                ]); ?>

                <?php echo form_error('movie-rating'); ?>
                <?php echo form_dropdown('movie-rating', $ratings, $movie['rating_id'] ?: set_value('movie-rating')); ?>


                <?php echo form_error('movie-poster'); ?>
                <?php echo custom_form_upload('Choose poster', [
                    'type'          => 'file',
                    'name'          => 'movie-poster',
                    'accept'        => 'image/*'
                ]); ?>
                <small>Upload a new poster to replace the current one.</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'movie-genre[]',
                    $genre,
                    $movie['genre'] ?: set_value('movie-genre'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($genre)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
