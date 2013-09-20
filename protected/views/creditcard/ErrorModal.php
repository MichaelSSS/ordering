<!-- Modal -->
<div id="errorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="errorModalLabel">Error</h3>
  </div>
  <div class="modal-body">
    <p><?php echo $form->error($model,$model->$attribute); ?></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
  </div>
</div>
