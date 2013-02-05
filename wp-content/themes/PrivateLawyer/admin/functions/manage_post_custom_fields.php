<?php
//Custom Settings
if(!function_exists('templ_get_post_custom_fields_array')){
function templ_get_post_custom_fields_array()
{
	$pt_metaboxes = array();
	return apply_filters('templ_admin_post_custom_fields_filter',$pt_metaboxes);
}
}

if(!function_exists('ptthemes_meta_box_content')){
function ptthemes_meta_box_content() {
    global $post;
	$pt_metaboxes = templ_get_post_custom_fields_array();
    $output = '';
    if($pt_metaboxes){
   $output .= '<div class="pt_metaboxes_table">'."\n";
   foreach ($pt_metaboxes as $pt_id => $pt_metabox) {
    if($pt_metabox['type'] == 'text' OR $pt_metabox['type'] == 'select' OR $pt_metabox['type'] == 'checkbox' OR $pt_metabox['type'] == 'textarea')
            $pt_metaboxvalue = get_post_meta($post->ID,$pt_metabox["name"],true);
            if ($pt_metaboxvalue == "" || !isset($pt_metaboxvalue)) {
                $pt_metaboxvalue = $pt_metabox['default'];
            }
            if($pt_metabox['type'] == 'text'){
            
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input size="100" class="pt_input_text" type="'.$pt_metabox['type'].'" value="'.$pt_metaboxvalue.'" name="ptthemes_'.$pt_metabox["name"].'" id="'.$pt_id.'"/></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
                              
            }
            
            elseif ($pt_metabox['type'] == 'textarea'){
            			
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><textarea rows="5" cols="98" class="pt_input_textarea" name="ptthemes_'.$pt_metabox["name"].'" id="'.$pt_id.'">' . $pt_metaboxvalue . '</textarea></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
                              
            }

            elseif ($pt_metabox['type'] == 'select'){
                            
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><select class="pt_input_select" id="'.$pt_id.'" name="ptthemes_'. $pt_metabox["name"] .'"></p>'."\n";
                $output .= '<option>Select a Upload</option>';
                
                $array = $pt_metabox['options'];
                
                if($array){
                    foreach ( $array as $id => $option ) {
                        $selected = '';
                        if($pt_metabox['default'] == $option){$selected = 'selected="selected"';} 
                        if($pt_metaboxvalue == $option){$selected = 'selected="selected"';}
                        $output .= '<option value="'. $option .'" '. $selected .'>' . $option .'</option>';
                    }
                }
                $output .= '</select><p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
            elseif ($pt_metabox['type'] == 'checkbox'){
                if($pt_metaboxvalue == 'on') { $checked = 'checked="checked"';} else {$checked='';}
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input type="checkbox" '.$checked.' class="pt_input_checkbox"  id="'.$pt_id.'" name="ptthemes_'. $pt_metabox["name"] .'" /></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
        }
	$output .= '</div>'."\n\n";
    }
	echo $output;
}
}

if(!function_exists('ptthemes_metabox_insert')){
function ptthemes_metabox_insert() {
    global $globals;
   $pt_metaboxes = templ_get_post_custom_fields_array();
   $pID = $_POST['post_ID'];
    $counter = 0;

    
    foreach ($pt_metaboxes as $pt_metabox) { // On Save.. this gets looped in the header response and saves the values submitted
    if($pt_metabox['type'] == 'text' OR $pt_metabox['type'] == 'select' OR $pt_metabox['type'] == 'checkbox' OR $pt_metabox['type'] == 'textarea') // Normal Type Things...
        {
            $var = "ptthemes_".$pt_metabox["name"];
           // if (isset($_POST[$var])) {            
                if( get_post_meta( $pID, $pt_metabox["name"] ) == "" )
                    add_post_meta($pID, $pt_metabox["name"], $_POST[$var], true );
                elseif($_POST[$var] != get_post_meta($pID, $pt_metabox["name"], true))
                    update_post_meta($pID, $pt_metabox["name"], $_POST[$var]);
                elseif($_POST[$var] == "")
                    delete_post_meta($pID, $pt_metabox["name"], get_post_meta($pID, $pt_metabox["name"], true));
          // }  
        } 
    }
}
}


if(!function_exists('ptthemes_meta_box')){
	function ptthemes_meta_box() {
		$pt_metaboxes = templ_get_post_custom_fields_array();
		if ( function_exists('add_meta_box') && $pt_metaboxes ) {
			apply_filters('templ_admin_post_type_custom_filter',add_meta_box('ptthemes-settings',apply_filters('templ_admin_post_custom_fields_title_filter','Custom Settings'),'ptthemes_meta_box_content','post','normal','high'));
		}
	}
}

add_action('admin_menu', 'ptthemes_meta_box');
add_action('save_post', 'ptthemes_metabox_insert');
?>