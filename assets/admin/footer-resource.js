setTimeout(function () {
    $(".alert").fadeOut("slow", function () {
        $(".alert").remove();
    });

}, 5000);

function readURL(input, id) {
    id = id || '#blah';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function print_invoice(printableArea) {
    if ($('#dataTables-example').length > 0) {
        var table = $('#dataTables-example').DataTable();
        table.destroy();
    }
//$('#dataTables-example').attr('id','none');
    var printContents = document.getElementById(printableArea).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.document.close(); // necessary for IE >= 10
    window.focus(); // necessary for IE >= 10
    window.print();
    window.close();
    //$('table').attr('id','dataTables-example');
    location.reload(document.body.innerHTML = originalContents);
    //document.body.innerHTML = originalContents;
}




function deleteData(url) {
   var link = $('body').data('baseurl');
  //alert('hello');
    swal({
        title: "Are you sure to delete records ?",
        text: "You will not be able to recover this record !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, Delete it!',
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted !", "Your record has been deleted !", "success");
                    window.setTimeout(function () {
                        window.location.href = link + url;
                    }, 2000);

                } else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            });
}


$(document).ready(function () {

    var link = $('body').data('baseurl');
   
    
    if ($('[id^="changeStatus-"]').length > 0) {
        $('body').off('click', '[id^="changeStatus-"]').on('click', '[id^="changeStatus-"]', function (e) {
            var self = $(this);
            var tbl = $(this).attr('id').split('-')[1];

            var status = $(this).attr('id').split('-')[2];
            var id = $(this).attr('id').split('-')[3];
            var link = $('body').data('baseurl');
            var msgStatus = status == 'Active' ? 'inactive' : 'active';
            swal({
                title: "Are you sure?",
                text: "You want " + msgStatus + " this record !!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, ' + msgStatus + ' it!',
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.post(link + "admin/ajax/change_status", {table: tbl, id: id},
                                    function (data) {
                                        if (data == '1') {
                                            if (status == 'Active') {
                                                self.attr('id', 'changeStatus-' + tbl + '-Inactive-' + id).removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-thumbs-down"> Inactive</i>');
                                            } else {
                                                self.attr('id', 'changeStatus-' + tbl + '-Active-' + id).removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-thumbs-up"> Active</i>');
                                            }
                                        }
                                    });
                            swal(msgStatus + "!", "Your record has been " + msgStatus + "!", "success");
                        } else {
                            swal("Cancelled", "Your imaginary record is safe :)", "error");
                        }
                    });

        });
    }
   

    // fancy box
    //if ($('.fancybox').length > 0) {
    $(".fancybox").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside'
            }
        }
    });
    //}
    //Initialize Select2 Elements
    if ($('.select2').length > 0) {
        $(".select2").select2();
    }
    if ($('.tags').length > 0) {
        $(".tags").select2({
            tags: true,
            tokenSeparators: [',']
        });
    }
 
/*    if ($('#datetimepicker').length > 0) {
        // Datetime Picker
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm A'
        });
    }
    if ($('#datepicker').length > 0) {
        // Date Picker
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    }
    if ($('#datepickerDob').length > 0) {
        // Date Picker
        $('#datepickerDob').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: moment().add(-1, 'days'),
        });
    }
    if ($('#startDate').length > 0 && $('#endDate').length > 0) {
        // Start and End Date picker
        $('#startDate').datetimepicker({
            format: 'YYYY-MM-DD hh:mm A'
        });
        $('#endDate').datetimepicker({
            format: 'YYYY-MM-DD hh:mm A',
            useCurrent: false //Important! See issue #1075
        });
        $("#startDate").on("dp.change", function (e) {
            $('#endDate').data("DateTimePicker").minDate(e.date);
        });
        $("#endDate").on("dp.change", function (e) {
            $('#startDate').data("DateTimePicker").maxDate(e.date);
        });
    }*/
   
  if('#startDate')
     { 
        $('#startDate').datetimepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayBtn: true
    });
    
    }
     if('#endDate')
     { 
        $('#endDate').datetimepicker({
        format: ' dd-mm-yyyy' ,
         autoclose: true,


    });
    
    }

    if ($("#admin_id").length > 0)
        $("#admin_id").change(function () {
            var id = $(this).val();
            var link = $('body').data('baseurl');
            $.ajax({
                url: link + 'admin/ajax/getBranchByAdmin',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function (msg)
                {
                    if (msg) {
                        var opt = '<option value="">Select a branch</option>';
                        $.each(msg, function (i, item) {
                            opt += '<option value="' + item.id + '">' + item.first_name + '</option>';
                        });
                        $('#branch_id').html(opt);
                    } else
                    {
                        var opt = '<option value="">Select a branch</option>';

                        $('#branch_id').html(opt);
                    }
                }
            });
        });

  
    $.fn.dataTable.ext.errMode = 'none';
    // DataTable
    if ($('#dataTables-example').length > 0) {
        $('#dataTables-example').DataTable({
            /* Disable initial sort */
            "aaSorting": []
        });
    }
    
      // DataTable
    if ($('#dataTables-job').length > 0) {
       $('#dataTables-job').DataTable({
            "aaSorting": [0],
               
        });
    }

    if ($('#dataTables').length > 0) {
        $('#dataTables').DataTable({
            /* Disable initial sort */
            "aaSorting": [],
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
    }

 
});