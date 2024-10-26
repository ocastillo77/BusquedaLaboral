<div class="panel-body table-responsive">
  <?php if (isset($data['heads']) && count($data['heads'])) : ?>
    <table class="table table-bordered table-striped" id="list-table">
      <thead>
        <tr class="odd">
          <?php
          foreach ($data['heads'] as $head) :
            ?>
            <th width="<?php echo!empty($head['width']) ? $head['width'] : ''; ?>" class="<?php echo $head['sort']; ?>" data-align="<?php echo $head['align']; ?>"><?php echo $head['title']; ?></th>
            <?php
          endforeach;
          ?>
          <th width="100" class="nosort center" data-align="center">Acci&oacute;n</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  <?php endif; ?>
</div>

