<?php
	try{
		$sql = 'SELECT * FROM partai'; 
		$res = $db->query($sql); 
	} catch (PDOException $e) {
		echo $e->getMessage();
	}	
?>	
				<h2 class="isi">Daftar Partai</h2>
				<!-- untuk judul halaman -->
				<article class="isi2>
				<table>
					<?php
						foreach($res as $data){
							echo '<td width = "10"><center><a href="?page=caleg&partai='.$data['partai'].'"><img src="'.$data['foto'].'" /></a><br /><b>'.$data['partai'].'</b><br />'.$data['nama'].'<td></center>';
						}
					
					/*<a href="?page=profil_partai"><img src="foto.jpg" /></a>
					<a href="?page=profil_partai"><img src="foto1.jpg" /></a>
					<a href="?page=profil_partai"><img src="foto2.jpg" /></a>
					<a href="?page=profil_partai"><img src="foto3.jpg" /></a>
					<a href="?page=profil_partai"><img src="foto4.jpg" /></a>
					<a href="?page=profil_partai"><img src="foto5.jpg" /></a>*/?>
				</article>
				<!-- isi penjelasan halaman -->
