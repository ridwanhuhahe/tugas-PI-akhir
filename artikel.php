<?php
	try{
			$sql2 = 'SELECT * FROM artikel where caleg = "'.$_SESSION['username'].'"'; 
			$artikel = $db->query($sql2); 
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	if (isset($_GET['page']) && $_GET['page'] == 'artikel')
	{
		if(isset($_GET['act']) &&$_GET['act']=='hapus')
		{
			$sql = "DELETE FROM artikel WHERE id = :id";
			$ssql = $db->prepare($sql);
			$ssql->bindParam(':id', $id);
			$id = ($_GET['id']);
			$ssql->execute(); ?>
			<script language="JavaScript">alert('Hapus Artikel Sukses');
			document.location='?page=artikel'</script> <?php
		}else if(isset($_GET['act']) &&$_GET['act']=='edit')
		{
			try{
				$sql2 = 'SELECT * FROM artikel where id = ?'; 
				$ssql = $db->prepare($sql2);
				$art = ($_GET['id']);
				$ssql->execute(array($art));
				$detail = $ssql->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['tambah']))
		{
									try{
										$sql = 'insert into artikel value 
												(:id, :judul, :artikel1, :artikel2, :caleg)';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':id' => "", ':judul' => $_POST['judul'], 
															':artikel1' => $_POST['artikel1'], ':artikel2' => $_POST['artikel2'], 
															':caleg' => $_SESSION['username']));?>
											<script language="JavaScript">alert('Tambah Artikel Sukses!!');
											document.location='?page=artikel'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Tambah Artikel Gagal");</script>'.$e->getMessage(); 
									}
		}else if (isset($_POST['edit']))
		{
			try{
				$sql = 'update artikel set id = :id, judul = :judul, 
						artikel1 = :artikel1, artikel2 = :artikel2, caleg = :caleg
						where id = :id';
				$ssql = $db->prepare($sql);
				$ssql->execute(array(':id' => $_GET['id'], ':judul' => $_POST['judul'], ':artikel1' => $_POST['artikel1'], 
									':artikel2' => $_POST['artikel2'], ':caleg' => ($_SESSION['username']) ));?>
					<script language="JavaScript">alert('Edit Artikel Sukses!!');
					document.location='?page=artikel'</script> <?php
			} catch (PDOException $e){
				echo '<script>alert("Edit Artikel Gagal");</script>'.$e->getMessage(); 
			}					
		}
	}
?>
				<h2 class="isi">Tambah Artikel</h2>
				<!-- untuk judul halaman -->
					<?php
					if(isset($_GET['act']) && $_GET['act']=='edit'){
						echo '
						<form name="daftar" method="post">
							<table>
							<td>Judul <td><input id="judul" size="48" type="text" name="judul" value="'.$detail[0]['judul'].'" placeholder="Judul Artikel" required><tr>
							<td>Artikel <td><textarea name="artikel1" rows="10" cols="50">'.$detail[0]['artikel1'].'</textarea><tr>
							<td>Artikel Learn More <td><textarea name="artikel2" rows="10" cols="50">'.$detail[0]['artikel2'].'</textarea><tr>
							<td><p class="submit"><input type="submit" name="edit" value="Edit"> <button type="reset" class="cancel">Cancel</button></p><tr>
							</table>
						</form>';
					}else{
						echo '
						<form name="daftar" method="post">
							<table>
							<td>Judul <td><input id="judul" size="48" type="text" name="judul" value="" placeholder="Judul Artikel" required><tr>
							<td>Artikel <td><textarea name="artikel1" rows="10" cols="50"></textarea><tr>
							<td>Artikel Learn More <td><textarea name="artikel2" rows="10" cols="50"></textarea><tr>
							<td><p class="submit"><input type="submit" name="tambah" value="Tambah"> <button type="reset" class="cancel">Cancel</button></p><tr>
							</table>
						</form>';
					}?>
				<article class="isi">
					<?php
					if($artikel != null){
							$no=1;
							foreach($artikel as $data){
								echo '<h3>'.$data['judul'].'</h3>
									<a href="?page=artikel&act=edit&id='.$data['id'].'">Edit</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="?page=artikel&act=hapus&id='.$data['id'].'"';?>" onclick="return confirm('Apakah anda yakin akan menghapus artikel ini?')"<?php echo '>Hapus</a>
									<p>'.$data['artikel1'].'</p>
									<p class="panel'.$no.'">'.$data['artikel2'].'</p><div class="flip'.$no.'">Learn More</div>';
								$no++;
							}
					}else{
						echo '<p align="center">Belum pernah menambah artikel</p>';
					}?>
				</article>