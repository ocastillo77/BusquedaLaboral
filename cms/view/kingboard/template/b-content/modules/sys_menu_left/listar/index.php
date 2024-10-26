<?php if(isset($data['tree_table'])) echo $data['tree_table']; ?>
<script>
$(document).ready(function () {
  $('#list-table').treeTable();
});
</script>