<?php
/**
 * Store Extension for DataMapper classes.
 *
 * Saves purified/unpurified data.
 *
 * @license 	MIT License
 * @package	DMZ-Included-Extensions
 * @category	DMZ
 * @author  	A.B. Zainuddin
 * @version 	1.0
 */

// --------------------------------------------------------------------------

/**
 * DMZ_Store Class
 *
 * @package		DMZ-Included-Extensions
 */
class DMZ_Store 
{
    /**
     * Save both purified and unpurified data.
     *
     * @param DataMapper $my_object
     * @param DataMapper $object
     * @param type $related_field
     * @return boolean Ture on success, false otherwise. 
     */
    function store($my_object, $object = '', $related_field = '')
    {
        // Save purfiy/unpurified.
        $suffix = '_unpurified';
        $pattern = '/(' . $suffix . ')$/';
        
        foreach($my_object->fields as $field_unpurified)
        {
            // Find unpurified fields.
            if(preg_match($pattern, $field_unpurified))
            {   
                // Found an unpurified field.
                $field = substr($field_unpurified, 0, strlen($field_unpurified) - strlen($suffix));                
                
                if(isset($my_object->{$field}) && purify($my_object->{$field_unpurified}) != $my_object->{$field})
                {
                    $my_object->{$field_unpurified} = $my_object->{$field};
                    $my_object->{$field} = purify($my_object->{$field});
                }
            }
        }
        
        return $my_object->save($object, $related_field);
    }
}

/* End of file array.php */
/* Location: ./application/datamapper/array.php */
