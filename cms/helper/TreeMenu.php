<?php

/*
 * -------------------------------------
 * www.ideacreativa.com.ar | Oscar Castillo
 * Framework CMS WebAdmin
 * TreeTable.php
 * -------------------------------------
 */

class TreeMenu
{

  const table = 'sys_menu_left';

  private $_registry;
  protected $_db;
  protected $_base_url;

  public function __construct($base_url)
  {
    $this->_registry = Registry::getInstance();
    $this->_db = $this->_registry->_db;
    $this->_base_url = $base_url;
  }

  public function getMenuLeft()
  {
    $tabla = DB_PREF . self::table;
    $tree = $this->_db->query("SELECT ID,Publico,Titulo,PadreID,Tabla FROM " . $tabla . " ORDER BY Posicion");
    return $tree->fetchall();
  }

  public function getItemTree()
  {
    $tree = array(
        'items' => array(),
        'parents' => array()
    );

    $items = $this->getMenuLeft();

    foreach ($items as $item) {
      $tree['items'][$item['ID']] = $item;
      $tree['parents'][$item['PadreID']][] = $item['ID'];
    }
    return $tree;
  }

  public function getRowTable($item, $parent = false, $folder =  '')
  {
    switch ($item['Publico']) {
      case 1:
        $icon = '<span class="label label-success">Publicado</span>';
        break;
      case 2:
        $icon = '<span class="label label-warning">Borrador</span>';
        break;
      case 3:
        $icon = '<span class="label label-warning">Archivado</span>';
    }

    $class = ($parent) ? 'child-of-node-' . $parent : '';
    $tabla = (!empty($item['Tabla'])) ? $item['Tabla'] : 'No';

    $url_edit = URL_CMS . $this->_base_url . 'editar/' . $item['ID'];

    $html = '<tr id="node-' . $item['ID'] . '" class="' . $class . '">
								<td class="center">
									<input type="checkbox" value="' . $item['ID'] . '" name="selected[]">
								</td>
								<td>
									<span class="' . $folder . '">' . $item['Titulo'] . '</span>
								</td>
								<td class="center">' . $tabla . '</td>
								<td class="center">' . $icon . '</td>
								<td class="center" width="100">
									<a class="btn btn-info btn-sm" href="' . $url_edit . '">
										Editar</a>
								</td>
						</tr>';

    return $html;
  }

  public function recursiveTree($parent, $tree)
  {
    $html = '';
    if (isset($tree['parents'][$parent])) {
      foreach ($tree['parents'][$parent] as $itemID) {
        if (!isset($tree['parents'][$itemID])) {
          $html .= $this->getRowTable($tree['items'][$itemID], $parent, 'file');
        }
        if (isset($tree['parents'][$itemID])) {
          $html .= $this->getRowTable($tree['items'][$itemID], $parent, 'folder');
          $html .= $this->recursiveTree($itemID, $tree);
        }
      }
    }
    return $html;
  }

  public function render()
  {
    $tree = $this->getItemTree();
    $output = $this->recursiveTree(0, $tree);

    $html = '
  		<table class="table table-bordered table-striped" id="list-table">
				<thead>
			  <tr>
			  	<th width="1" class="center">
			  		<input type="checkbox" onclick="checker(this);" />
					</th>
				  <th class="center">T&iacute;tulo</th>
				  <th class="center">Tabla</th>
				  <th class="center" width="90">Estado</th>
				  <th class="center" width="100">Acci&oacute;n</th>
			  </tr>
		  </thead>';
    $html .= (!empty($output)) ? $output : '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No se encontraron resultados</td></tr>';
    $html .= '</tbody>
						</table>';

    return $html;
  }

}
