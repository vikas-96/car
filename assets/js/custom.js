    $(document).ready(function(){
        $(".loader").fadeOut("slow");
    });

    function inventorydatatable(){
        $('#inventory').DataTable().destroy();
        $('#inventory').DataTable({
            // Processing indicator
            "processing": true,
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            // Load data from an Ajax source
            "ajax": {
                "url": BASE_URL+"/getinventory",
                "type": "POST"
            },
            //Set column definition initialisation properties
            "columnDefs": [{ 
                "targets": [0,2,3],
                "orderable": false
            }]
        });
    }

	$.validator.addMethod("NumberOnly", function (value) {
        return /^[0-9 ]+$/i.test(value);
    });

    $.validator.addMethod("acceptName", function (value) {
        return /^[a-zA-Z ']+$/.test(value);
    });

	function sendformdata(action,data){
		$.ajax({
            url: action,
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.loader').hide();
                var result = JSON.parse(response);
                $('.toast').remove();
                if (result.success) {
                    toastr.success(result.success);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                } else {
                    toastr.error(result.error);
                }
            }
        });
	}

    $('#frmManu').validate({
        rules: {
            'mname' : {
                required:true,
                acceptName:true,
                "remote":
                    {
                    url: BASE_URL+'/checkmanufacturername',
                    type: "post",
                    data:
                        {
                            email: function ()
                            {
                                return $('#mname').val();
                            }
                        }
                    }
            }
        },
        messages: {
            'mname': {
                acceptName: "Only alphabet,space and apostrophe only",
                remote : "Name already exist"
            },
        },
        submitHandler: function (form) {
            var action = BASE_URL+"/addmanufacturer";
            var data = new FormData(form);
            $('.loader').show();
            sendformdata(action,data);
        }
    });

    Dropzone.autoDiscover = false;
    $(document).ready(() => {
        const dropzones = [];
        var option = {
            url: window.location.pathname,
            autoProcessQueue: false,
            uploadMultiple: false,
            acceptedFiles: 'image/*',
            parallelUploads: 5,
            addRemoveLinks: true,
        };
        $('.dropzone').each(function(i, el) {
            option.maxFiles = 2;
            option.paramName = 'Image';
            option.dictDefaultMessage = "Add Car images";


            // console.log(option);
            var myDropzone = new Dropzone(el, option);
            // maxfilesexceeded
            myDropzone.on("maxfilesexceeded", function(file) {
                myDropzone.removeFile(file);
                $('.toast').remove();
                toastr.error('Max Limit Exceeded');
            });
            dropzones.push(myDropzone);
        });

        $('#frmModel').validate({
            rules: {
                'modelname' : {
                    required:true
                },
                'manufacturer' : {
                    required:true
                },
                'color' : {
                    required:true,
                    acceptName:true
                },
                'year' : {
                    required:true,
                    NumberOnly:true,
                    minlength: 4,
                    maxlength: 4
                },
                'Rnumber' : {
                    required:true,
                    NumberOnly:true
                },
                'note' : {
                    required:true
                },
            },
            messages: {
                'modelname': {
                    acceptName: "Only alphabet,space and apostrophe only"
                },
                'color': {
                    acceptName: "Only alphabet,space and apostrophe only"
                },
                'year': {
                    NumberOnly: "Only Numeric value"
                },
                'Rnumber': {
                    NumberOnly: "Only Numeric value"
                },
            },
            submitHandler: function (form,e) {
                e.preventDefault();
                e.stopPropagation();
                $('.loader').show();
                var action = BASE_URL+'/addmodels';
                var data = new FormData(form);
                // console.log(dropzones);
                dropzones.forEach(dropzone => {
                    let {
                        paramName
                    } = dropzone.options;
                    // console.log(paramName);
                    dropzone.files.forEach((file, i) => {
                        // console.log(file);
                        data.append(paramName + '[' + i + ']', file)
                    });
                });
                // var re = data;
                // debugger;
                sendformdata(action,data);
            }
        });

    });

    $(document).on('click','#inventory tbody tr',function(){
        var mn = $(this).find('span').attr('mn');
        var mdl = $(this).find('span').attr('mdl');
        $('.loader').show();
        $.ajax({
            url: BASE_URL+'/popupinventory',
            type: 'POST',
            data: {'mn':mn,'mdl':mdl},
            success: function (response) {
                $('.loader').hide();
                $('.inventorybind').html(response);
                $('#myModal').modal('toggle');
            }
        });
    });

    $(document).on('click','.soldbtn',function(){
        var revenge = $(this).parent().find('.revenge').attr('rev');
        $('.loader').hide();
        $.ajax({
            url: BASE_URL+'/soldinventory',
            type: 'POST',
            data: {rev:revenge},
            success: function (response) {
                $('.loader').hide();
                var result = JSON.parse(response);
                $('#myModal').modal('toggle');
                $('.toast').remove();
                if (result.success) {
                    toastr.success(result.success);
                    setTimeout(function() {
                        inventorydatatable();
                    }, 2000);

                } else {
                    toastr.error(result.error);
                }
            }
        });
    });