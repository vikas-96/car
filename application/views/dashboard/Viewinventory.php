<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>View inventory</h1>
                <table id="inventory" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Manufacturer Name</th>
                            <th>Model Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- datatable is server side processing -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog inventorymodal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="inventorybind"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript">
      $(document).ready(function(){
        inventorydatatable();
      });
  </script>