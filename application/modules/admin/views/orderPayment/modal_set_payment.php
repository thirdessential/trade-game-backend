<div class="modal-header"> 
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title ?></h4>
</div>
<form role="form" id="changePaymentForm" class="sky-form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/orderPayment/save_payment_status/<?php echo $payment_info->id ?>" method="post"> 
    <div class="modal-body wrap-modal wrap" style="max-height: 900px;">
        <div class="row" style="padding: 10px">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" value="<?php echo $payment_info->name ?> [ <?php echo $payment_info->userId ?>] " class="form-control" readonly="">
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Amount*</label>
                    <input type="text" value="<?php echo $payment_info->remaining_amount ?>" class="form-control" readonly>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Payment Type*</label>
                    <select name="payment_type" class="form-control">
                        <option value="">Select a Payment Type</option>
                        <option value="Tez">Tez</option>
                        <option value="Payphone">Payphone</option>
                        <option value="Paytm">Paytm</option>
                        <option value="Online">Online</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Transaction Id*</label>
                    <input type="text" name="transaction_id" placeholder="Transaction Id" value=""
                           class="form-control" >
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" > 
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitBtn" name="submit" >Submit</button>
    </div>
</form>

<script type="text/javascript">

    if ($("#changePaymentForm").length > 0) {
        $("#changePaymentForm").validate({
            rules: {
                transaction_id: {
                    required: true,
                    maxlength: 100,
                },
                payment_type: {
                    required: true,
                },
            },
            messages: {
                transaction_id: {
                    required: "Please enter transaction id.",
                    maxlength: "The transction id should less than or equal to 100 characters. ",
                },
                payment_type: {
                    required: "Please select a payment type",
                },
            },

            submitHandler: function (form) {
                $('#submitBtn').prop('disabled',true);
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'html'
                }).done(function (response) {
                    if (response.success == '1') {
                     
                        $('#myModal').modal('hide');
                        $('#submitBtn').prop('disabled',false);
                        window.setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);
                    } else {
                        $('#myModal').modal('hide');
                        $('#submitBtn').prop('disabled',false);
                        window.setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);

                    }
                });
                return false; // required to block normal submit since you used ajax
            }
        });
    }

</script>