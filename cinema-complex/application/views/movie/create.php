<?php echo form_open_multipart('movie/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('movie-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'movie-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Title',
                    'value'         => set_value('movie-title')
                ]); ?>

                <?php echo form_error('movie-desc'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'movie-desc',
                    'placeholder'   => 'This is the start of your next work!',
                    'class'         => 'form-control mb-3',
                    'value'         => set_value('movie-desc')
                ]); ?>

                <?php echo form_error('movie-release'); ?>
                <?php echo custom_form_input('Release Date', [
                    'name'          => 'movie-release',
                    'class'         => 'form-control',
                    'placeholder'   => 'Release Date',
                    'value'         => set_value('movie-release')
                ]); ?>

                <?php echo form_error('movie-runtime'); ?>
                <?php echo custom_form_input('Runtime', [
                    'name'          => 'movie-runtime',
                    'class'         => 'form-control',
                    'placeholder'   => 'Runtime',
                    'value'         => set_value('movie-runtime')
                ]); ?>

                <?php echo form_error('movie-rating'); ?>
                <?php echo form_dropdown('movie-rating', $ratings); ?>

                <?php echo form_error('movie-poster'); ?>
                <?php echo custom_form_upload('Choose Poster', [
                    'type'          => 'file',
                    'name'          => 'movie-poster',
                    'accept'        => 'posters/*'
                ]); ?>

                <?php echo form_error('movie-image'); ?>
                <?php echo custom_form_upload('Choose Image', [
                    'type'          => 'file',
                    'name'          => 'movie-image',
                    'accept'        => 'images/*'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'movie-genre[]',
                    $genre,
                    set_value('movie-genre'),
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
