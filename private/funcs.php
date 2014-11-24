<?php
/* funcs.php */

function getProducts($category_id){

	global $mysqli,$db_table_prefix;

		$query = "SELECT 
			p.id,
			p.category_id,
			c.name AS category,
			c.folder AS folder,
			c.description AS category_desc,
			c.img_url AS category_img,
			p.name,
			p.code,
			p.filename,
			p.created,
			p.modified
			FROM ".$db_table_prefix."products p
			JOIN ".$db_table_prefix."categories c
			ON p.category_id = c.id
			WHERE p.category_id =" . $category_id; 
	 
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$stmt->bind_result($id, $category_id, $category, $folder, $category_desc, $category_img, $name, $code, $filename, $created, $modified);
	
	$row = NULL;
	
	while ($stmt->fetch()){
	
		$row[] = array('id' => $id,
                  	   'category_id' => $category_id, 
                  	   'category' => $category,
                  	   'folder' => $folder,
                  	   'category_desc' => $category_desc,
                  	   'category_img' => $category_img,  
					   'name' => $name, 
					   'code' => $code, 
					   'filename' => $filename, 
					   'created' => $created,
					   'modified' => $modified);
	}
	$stmt->close();
	return ($row);

}




?>