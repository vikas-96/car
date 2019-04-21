<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Add Manufacturer</h1>
            </div>
            <div class="col-sm-6">
                <?php 
                    echo form_open('', ['id' => 'frmManu','name'=>'frmManu','enctype'=>'multipart/form-data']);
                        echo form_label('Manufacturer Name:', 'mname');
                        echo form_input('mname', '',['id'=>'mname','class'=>'form-control','autocomplete'=>'off']);
                        echo form_submit('', 'Submit',['class'=>'btn btn-primary']);
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
