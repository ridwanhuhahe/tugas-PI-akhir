<?php
	if(!isset($_SESSION['akses']) && $_SESSION['akses'] != 'voter'){
		?>
		<script language="JavaScript">document.location='?page=index'</script> <?php
	}
	try{
		$sql2 = 'SELECT * FROM voter where username=:username';
				$query = $db->prepare($sql2);
				$query->execute(array(
					'username' => $_SESSION['username']
				));
		$user = $query->fetch();	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	try{
		$sql2 = 'SELECT * FROM vote where username=:username';
				$query = $db->prepare($sql2);
				$query->execute(array(
					'username' => $_SESSION['username']
				));
		$cek = $query->fetch();	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	try{
			$sql = 'SELECT * FROM caleg where dapil=:partai';
				$query = $db->prepare($sql);
				$query->execute(array(
					'partai' => $user['dapil']
				));
			$res = $query->fetch();	
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	if($res != null){
		try{
			$sql = 'SELECT * FROM caleg where dapil = "'.$user['dapil'].'"'; 
			$res = $db->query($sql); 
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	if (isset($_GET['caleg']))
	{
		if($_GET['caleg']){
				try{
					$sql = 'insert into vote value 
							(:username, :pilihan)';
					$ssql = $db->prepare($sql);
					$ssql->execute(array(':username' => $_SESSION['username'], ':pilihan' => $_GET['caleg'] ));?>
						<script language="JavaScript">alert('Terima Kasih Sudah Melakukan Pemilihan!!');
						document.location='?page=index'</script> <?php
				} catch (PDOException $e){
					echo '<script>alert("Voting Gagal");</script>'.$e->getMessage(); 
				}
		}
	}
?>
		<?php
			if($cek == null){?>
				<h2 class="isi">Voting Caleg</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
				<?php
				if($res != null){
					echo '<p align="center">Silahkan klik foto caleg untuk melakukan vote</p>
					<table>';
						foreach($res as $data){
							echo '<td width = "100"><a href="?page=voting&caleg='.$data['username'].'"';?>" onclick="return confirm('Apakah anda yakin akan memilih caleg ini?')"<?php echo '><img src="'.$data['foto'].'" /></a><br />Nama : '.$data['nama_lengkap'].' <br /> Partai : '.$data['partai'].' <br /> Dapil : '.$data['dapil'].'<td>';
						}
						
						//<td width = "100"><a href="?page=profil_caleg"><img src="image.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image1.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image2.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td><tr>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image3.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image4.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image5.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td><tr>
				}else{
					echo 'Belum terdaftar caleg di dapil ini';
				}
				
					echo '</table>
				</article>';
			}else{?>
				<h2 class="isi">Voting Caleg</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
				<p align="center">Anda telah melakukan pemilihan pada caleg berikut :</p>
					<table>
					<?php
					
					try{
						$sql2 = 'SELECT * FROM caleg where username=:username';
								$query = $db->prepare($sql2);
								$query->execute(array(
									'username' => $cek['pilihan']
								));
						$data = $query->fetch();
					} catch (PDOException $e) {
						echo $e->getMessage();
					}
							echo '<td width = "100"><a href="?page=profil_caleg&caleg='.$data['username'].'"><img src="'.$data['foto'].'" /></a><br />Nama : '.$data['nama_lengkap'].' <br /> Partai : '.$data['partai'].' <br /> Dapil : '.$data['dapil'].'<td>';
						
						//<td width = "100"><a href="?page=profil_caleg"><img src="image.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image1.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image2.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td><tr>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image3.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image4.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td>
						//<td width = "100"><a href="?page=profil_caleg"><img src="image5.jpg" /></a><br />Nama : Deny Septianto <br /> Partai : Golkar<td><tr>
					echo '</table>
				</article>';
			}?>