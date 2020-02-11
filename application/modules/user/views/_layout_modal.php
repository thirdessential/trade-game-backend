<!-- Modal -->
<div class="modal fade modal-wide" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="product_modal" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style='text-align: center;'><img width="100" height="100" src="<?php echo base_url(); ?>assets/uploads/images/preloader.gif"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
        $(this).find('.modal-content').html('<div style="text-align: center;"><img width="100" height="100" src="<?php echo base_url(); ?>assets/uploads/images/preloader.gif"></div>');
    });
</script>

