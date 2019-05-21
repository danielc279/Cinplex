<?php echo form_open_multipart("slot/edit/{$slot['id']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
              <?php echo form_error('slot-movie'); ?>
              <?php echo form_dropdown('slot-movie', $movies, $slot['movie_id'] ?: set_value('slot-movie')); ?>

              <?php echo form_error('slot-room'); ?>
              <?php echo form_dropdown('slot-room', $room, $slot['room_id'] ?: set_value('slot-room')); ?>

              <?php echo form_error('slot-date'); ?>
              <?php echo custom_form_input('Date', [
                  'name'          => 'slot-date',
                  'class'         => 'form-control',
                  'placeholder'   => 'Date',
                  'value'         => $slot['date'] ?: set_value('movie-runtime')

              ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'slot-time[]',
                    $time,
                    $slot['time'] ?: set_value('slot-time'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($time)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
