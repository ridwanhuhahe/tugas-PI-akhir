<?php
	if (isset($_GET['page']) && $_GET['page'] == 'profil_caleg')
	{
		try{
			$sql3 = 'SELECT * FROM artikel where caleg = "'.$_GET['caleg'].'"'; 
			$artikel = $db->query($sql3); 
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

			try{
				$sql = 'SELECT * FROM caleg where username=:username';
				$query = $db->prepare($sql);
				$query->execute(array(
					'username' => $_GET['caleg']
				));
				$profil = $query->fetch();	
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		if(isset($_SESSION['username'])){
			try{
				$sql2 = 'SELECT * FROM komentar where caleg="'.$_GET['caleg'].'"';
				$komentar = $db->query($sql2);	
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	else
	{
		?>
		<script language="JavaScript">
		document.location='?page=home'</script> <?php
	}
	if (isset($_POST['Posting']))
	{
		if($_POST['Posting']){
				try{
					$sql = 'insert into komentar value 
							(:id, :username, :komentar, :caleg)';
					$ssql = $db->prepare($sql);
					$ssql->execute(array(':id' => "", ':username' => $_SESSION['username'], ':komentar' => $_POST['komentar'], 
										':caleg' => $_GET['caleg'] ));?>
						<script language="JavaScript">alert('Komentar Berhasil!!');
						document.location='?page=profil_caleg</script> <?php
				} catch (PDOException $e){
					echo '<script>alert("Komentar Gagal");</script>'.$e->getMessage(); 
				}
		}
	}
?>

				<h2 class="isi">Profil Caleg</h2>
				<!-- untuk judul halaman -->			
			<article class="isi">
			<?php
					echo '
						<center><img src="'.$profil['foto'].'" /></center>
						<table>
						<td width="120"><b>Nama Lengkap</b><td>: '.$profil['nama_lengkap'].'<tr>
						<td><b>TTL</b><td>: '.$profil['tempat_lahir'].', '.$profil['tanggal_lahir'].'<tr>
						<td><b>Alamat</b><td>: '.$profil['alamat'].'<tr>
						<td><b>Email</b><td>: '.$profil['email'].'<tr>
						<td><b>Website</b><td>: '.$profil['website'].'<tr>
						<td><b>Partai</b><td>: '.$profil['partai'].'<tr>
						<td><b>DAPIL</b><td>: '.$profil['dapil'].'<tr>
						<td><b>Visi Misi</b><td>: '.$profil['visi'].'<tr>
						<td><b>Artikel</b><td>';if($artikel != null){
							$no=1;
							foreach($artikel as $data){
								echo '<h3>'.$data['judul'].'</h3>
									<p>'.$data['artikel1'].'</p>
									<p class="panel'.$no.'">'.$data['artikel2'].'</p><div class="flip'.$no.'">Learn More</div>';
								$no++;
							}
					}else{
						echo '<p>Belum pernah menambah artikel</p>';
					}?><tr><?php
						echo '<td><b>Url</b> <td>: <a href="'.$profil['url'].'" target="_blank">'.$profil['url'].'</a><tr>';?>
						</table>
						<br /> <br />
						<?php
						if(isset($_SESSION['username'])){
							$no = 1;
							echo '<table>';
								foreach($komentar as $data){
									echo '<td>'.$no.'. <td><i>'.$data['username'].'</i><tr>
										<td><td>'.$data['komentar'].'<tr>';
									$no++;
								}
								echo '</table>
							<br /><br />
							<form name="komentar" method="post" action="">
								<table>
								<td>Komentar <td><textarea name="komentar" rows="10" cols="50"></textarea><tr>
								</table>
								<p class="submit" align="center"><input type="submit" name="Posting" value="Posting"> &nbsp&nbsp&nbsp&nbsp&nbsp <button type="reset" class="cancel">Cancel</button></p>
							</form>';
						}?>
				</article>
				<!-- isi penjelasan halaman -->
