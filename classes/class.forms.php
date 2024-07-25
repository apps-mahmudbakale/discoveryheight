<?php 
/**
 * 
 */
class Form
{
	
	public function Input($props = array())
	{
		if ($props['isDisabled'] == true) {
			echo "
		<label>".$props['label']."</label>
		 <input type='".$props['type']."' name='".$props['name']."' class='".$props['class']."' id='".$props['id']."' value='{$props['value']}' placeholder='".$props['holder']."' readonly>
		";
		}else{
			echo "
		<label>".$props['label']."</label>
		 <input type='".$props['type']."' name='".$props['name']."' value='{$props['value']}' class='".$props['class']."' id='".$props['id']."' placeholder='".$props['holder']."'>
		";
		}
		
	}

	public function Option($value = array())
	{

			echo $value['label']."
			<select name=".$value['name']." class='".$value['class']."' id=".$value['id'].">";

				foreach ($value['options'] as $option) 
					{
						echo "<option>".$option."</option>";
					}

			echo "</select>";
	}
}

 ?>