<tr>
  <td class="text-center">
    <input type="text" class="form-control input-sm" 
           id="nombre<?php echo $item['ID']; ?>" 
           name="nombre<?php echo $item['ID']; ?>"
           value="<?php echo $item['Nombre']; ?>">
  </td>
  <td class="text-center">
    <select id="tipo<?php echo $item['ID']; ?>" name="tipo<?php echo $item['ID']; ?>" data-rel="chosen">
      <option value="INT">INT</option>
      <option value="TINYINT">TINYINT</option>
      <option value="VARCHAR">VARCHAR</option>
      <option value="TEXT">TEXT</option>
      <option value="DATE">DATE</option>
      <option value="DATETIME">DATETIME</option>
      <option value="TIMESTAMP">TIMESTAMP</option>
      <option value="BIGINT">BIGINT</option>
      <option value="FLOAT">FLOAT</option>
    </select>
  </td>
  <td class="text-center">
    <input type="text" class="form-control input-sm" 
           id="tamanio<?php echo $item['ID']; ?>" 
           name="tamanio<?php echo $item['ID']; ?>" 
           value="<?php echo $item['Tamanio']; ?>">
  </td>
  <td class="text-center">
    <input type="checkbox" class="form-control" id="notnull" name="notnull" value="1" />
  </td>
  <td class="text-center">
    <input type="checkbox" class="form-control" id="notnull" name="notnull" value="1" />
  </td>
  <td class="text-center">
    <select id="clave" name="clave" data-rel="chosen">
      <option value="primary">Primaria</option>
      <option value="unique">Único</option>
      <option value="index">Índice</option>
      <option value="text">Texto Completo</option>
    </select>
  </td>
  <td class="text-center">
    <input type="text" class="form-control input-sm" id="defecto" name="defecto">
  </td>
  <td class="text-center">
    <a href="javascript:deleteItem('<?php echo $url_delete; ?>');" class="btn btn-danger">
      Borrar
    </a>
  </td>
</tr>