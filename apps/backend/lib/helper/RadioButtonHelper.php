<?php

function object_admin_check_list($object, $method, $options = array(), $callback = null)
{
  $options = _parse_attributes($options);

  // get the lists of objects
  list($objects, $objects_associated, $assoc_ids) = _get_object_list($object, $method, $options, $callback);

  // override field name
  unset($options['control_name']);
  $name = 'associated_'._convert_method_to_name($method, $options).'[]';
  $html = '';

  if (!empty($objects))
  {
    // which method to call?
    $methodToCall = '__toString';
    foreach (array('__toString', 'toString', 'getPrimaryKey') as $method)
    {
      if (method_exists($objects[0], $method))
      {
        $methodToCall = $method;
        break;
      }
    }

    $html .= "<ul class=\"sf_admin_checklist\">\n";
    foreach ($objects as $related_object)
    {
      $relatedPrimaryKey = $related_object->getPrimaryKey();

      // multi primary key handling
      if (is_array($relatedPrimaryKey))
      {
        $relatedPrimaryKeyHtmlId = implode('/', $relatedPrimaryKey);
      }
      else
      {
        $relatedPrimaryKeyHtmlId = $relatedPrimaryKey;
      }

      $html .= '<li>'.checkbox_tag($name, $relatedPrimaryKeyHtmlId, in_array($relatedPrimaryKey, $assoc_ids)).' <label for="'.get_id_from_name($name, $relatedPrimaryKeyHtmlId).'">'.$related_object->$methodToCall()."</label></li>\n";
    }
    $html .= "</ul>\n";
  }

  return $html;
}

?>