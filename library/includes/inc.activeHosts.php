<?php 
foreach($dbResults as $res){
	echo '<tr class="active-hosts-row">';
		echo '<td class="active-hosts-data-item">'.ucwords($res['site_name']).'</td>';
		echo '<td class="active-hosts-data-item">'.ucwords($res['domain_name']).'</td>';
		echo '<td class="active-hosts-data-item">'.ucwords($res['user_name']).'</td>';
		echo '<td class="active-hosts-data-item">'.ucwords($res['folder_name']).'</td>';
		echo '<td class="active-hosts-data-item">'.ucwords($res['client_type']).'</td>';
		echo '<td class="active-hosts-data-item">'.ucwords($res['active']).'</td>';
		echo '<td class="active-hosts-data-item active-hosts-icons"><a href="#'.$res["id"].'" class="edit-'.$res["id"].'"><i class="icon-cog"></i></a><a href="#'.$res["id"].'" class="trash-'.$res["id"].'"><i class="icon-trash"></i></a></td>';
	echo '</tr>';
}
?>