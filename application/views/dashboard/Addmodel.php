<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Add Model</h1>
            </div>
            <div class="col-sm-6">
                <?php 
                    $hidden = array('name' => 'frmModel','id' => 'frmModel', 'method' => 'post');
                    echo form_open_multipart('', $hidden);
                ?>
                    <div class="row">
                        <div class="col-sm-6">
                <?php 
                    echo form_label('Model Name:', 'modelname');
                    echo form_input('modelname', '',['class'=>'form-control','autocomplete'=>'off']);
                ?>
                        </div>
                        <div class="col-sm-6">
                <?php
                    echo form_label('Select Manufacturer:', 'manufacturer');
                    echo form_dropdown('manufacturer', $manufacturer, '', 'class="form-control"');
                ?>
                        </div>
                    </div>
                <?php
                    echo form_label('Color:', 'color');
                    echo form_input('color', '',['class'=>'form-control','autocomplete'=>'off']);

                    echo form_label('Manufacturing year:', 'year');
                    echo form_input('year', '',['class'=>'form-control','autocomplete'=>'off']);

                    echo form_label('Registration number:', 'Rnumber');
                    echo form_input('Rnumber', '',['class'=>'form-control','autocomplete'=>'off']);

                    echo form_label('Note:', 'note');
                    echo form_textarea('note', '', ['class'=>'form-control','autocomplete'=>'off']);

                    echo form_label('Add Car images:', 'Image');
                ?>
                    <div class="dropzone" id="Image" name="Image"></div>
                <?php
                    echo form_submit('', 'Submit',['class'=>'btn btn-primary']);
                    echo form_close();
                ?>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->