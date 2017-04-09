<div id="modalWindow" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
            <?php if (isset($modalTitle)): ?>
            <?= htmlspecialchars($modalTitle) ?>
            <?php else: ?>
            Editar
            <?php endif ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">