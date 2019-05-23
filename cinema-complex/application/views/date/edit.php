<?php echo form_open_multipart("date/edit/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('cycle-date'); ?>
                <?php echo custom_form_input('Date', [
                    'name'          => 'cycle-date',
                    'class'         => 'form-control',
                    'placeholder'   => 'Cycle Date',
                    'value'         => $date['date'] ?: set_value('cycle-date')
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
