<?php
	if (isset($_SESSION['username']) && isset($_GET['module']) && ($_GET['module'] == 'akun' || $_GET['module'] == 'url')){
		$sql = 'SELECT * FROM caleg where username=:username';
		$query = $db->prepare($sql);
		$query->execute(array(
			'username' => $_SESSION['username']
		));
		$edit = $query->fetch();	
	}else if (isset($_SESSION['username']) && isset($_GET['module']) && $_GET['module'] == 'voter'){
		$sql = 'SELECT * FROM voter where username=:username';
		$query = $db->prepare($sql);
		$query->execute(array(
			'username' => $_SESSION['username']
		));
		$edit = $query->fetch();	
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['Edit']))
		{
			if($_POST['Edit']){
				if($_POST['pass'] == $_POST['pass2']){
									try{
										$tgllahir = date("Y-m-d", strtotime($_POST['tgl_lahir']));
										$sql = 'update caleg set 
												username = :username, password = :password, nama_lengkap = :nama_lengkap, 
												tempat_lahir = :tempat_lahir, tanggal_lahir = :tanggal_lahir, alamat = :alamat, 
												email = :email, website = :website, partai = :partai, dapil = :dapil, visi = :visi
												where username = :username';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':username' => $_POST['username'], ':password' => md5($_POST['pass']), 
															':nama_lengkap' => $_POST['nama_lengkap'], ':tempat_lahir' => $_POST['tempat'], ':tanggal_lahir' => $tgllahir, 
															':alamat' => $_POST['alamat'], ':email' => $_POST['email'], ':website' => $_POST['website'],
															':partai' => $_POST['Partai'], ':dapil' => $_POST['Daerah'], ':visi' => $_POST['visi']));;?>
											<script language="JavaScript">alert('Edit Sukses!!');
											document.location='index.php'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Edit Gagal");</script>'.$e->getMessage(); 
									}
				}else{
				echo '<script>alert("Ulangi Password Tidak Sama");</script>'; 
				}
			}
		}else if (isset($_POST['edit_url']))
		{
									try{
										$sql = 'update caleg set 
												username = :username, url = :url
												where username = :username';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':username' => $_POST['username'], ':url' => $_POST['url']));?>
											<script language="JavaScript">alert('Edit URL Sukses!!');
											document.location='index.php'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Edit URL Gagal");</script>'.$e->getMessage(); 
									}
		}else if (isset($_POST['Foto']))
		{
			if($_POST['Foto']){
				$namafolder="caleg/";
					if (!empty($_FILES["image"]["tmp_name"])) {     
						$jenis_gambar=$_FILES['image']['type'];
						if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")     {                    
								$gambar = $namafolder . basename($_FILES['image']['name']);                
								if (move_uploaded_file($_FILES['image']['tmp_name'], $gambar)) {
									try{
										$sql2 = "SELECT * FROM caleg where username = :username";
										$query2 = $db->prepare($sql2);
										$query2->execute(array(
											'username' => $_SESSION['username']
										));
										$poto = $query2->fetch();
										unlink($poto['foto']);} 
									catch (PDOException $e) { 
										echo $e->getMessage(); 
									}
									try{
										$sql = 'update caleg set 
												username = :username, foto = :foto
												where username = :username';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':username' => $_SESSION['username'], ':foto' => $gambar));?>
											<script language="JavaScript">alert('Ganti Foto Sukses!!');
											document.location='index.php'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Ganti Foto Gagal");</script>'.$e->getMessage(); 
									}
								} else {            
									echo "Gambar gagal dikirim";         
							}    } else {         
								echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";    
							} } else {     
								echo "Anda belum memilih gambar"; 
							}
			}
		}else if (isset($_POST['voter']))
		{
			if($_POST['voter']){
				if($_POST['pass'] == $_POST['pass2']){
									try{
										$sql = 'update voter set 
												username = :username, nama_lengkap = :nama_lengkap, no_ktp = :no_ktp,
												password = :password, alamat = :alamat, email = :email, dapil = :dapil
												where username = :username';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':username' => $_POST['user'], ':nama_lengkap' => $_POST['nama_lengkap'], 
															':no_ktp' => $_POST['ktp'], ':password' => md5($_POST['pass']), 
															':alamat' => $_POST['alamat'], ':email' => $_POST['email'], ':dapil' => $_POST['Daerah']));;?>
											<script language="JavaScript">alert('Edit Sukses!!');
											document.location='index.php'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Edit Gagal");</script>'.$e->getMessage(); 
									}
				}else{
				echo '<script>alert("Ulangi Password Tidak Sama");</script>'; 
				}
			}
		}
	}	

	if (isset($_GET['module']) && $_GET['module'] == 'akun'){
				echo '<h2 class="isi">Edit Data Caleg</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="daftar" method="post" enctype="multipart/form-data">
							<table>
							<input id="username" type="hidden" name="username" value="'.$edit['username'].'">
							<td>Password <td>: <input id="pass" type="password" name="pass" value="" placeholder="Password" required><tr>
							<td>Ulang Password <td>: <input id="pass2" type="password" name="pass2" value="" placeholder="Ulangi Password" required><tr>
							<td>Nama Lengkap <td>: <input id="nama_lengkap" type="text" name="nama_lengkap" value="'.$edit['nama_lengkap'].'" placeholder="Nama Lengkap" required><tr>
							<td>Tempat Lahir <td>: <input id="tempat" type="text" name="tempat" value="'.$edit['tempat_lahir'].'" placeholder="Tempat" required><tr>
							<td>Tanggal Lahir <td>: <input type="text" id="datepicker" name="tgl_lahir" value="'.$edit['tanggal_lahir'].'" placeholder="Tanggal Lahir" required><tr>
							<td>Alamat <td>: <input id="alamat" type="text" name="alamat" value="'.$edit['alamat'].'" placeholder="Alamat" required><tr>
							<td>Email <td>: <input id="email" type="email" name="email" value="'.$edit['email'].'" placeholder="Email" required><tr>
							<td>Website <td>: <input id="website" type="text" name="website" value="'.$edit['website'].'" placeholder="Website" required><tr>
							<td>Partai <td>: <select name="Partai">';
														if($edit['partai'] == 'Demokrat'){
															echo '<option value="">Select...</option>
															<option value="Demokrat" selected>Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS">PKS</option>';
														}else if($edit['partai'] == 'GOLKAR'){
															echo'<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR" selected>GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS">PKS</option>';
														}else if($edit['partai'] == 'PDIP'){
															echo'<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP" selected>PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS">PKS</option>';
														}else if($edit['partai'] == 'Gerindra'){
															echo'<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra" selected>Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS">PKS</option>';
														}else if($edit['partai'] == 'PAN'){
															echo '<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN" selected>PAN</option>
															<option value="PKS">PKS</option>';
														}else if($edit['partai'] == 'PKS'){
															echo '<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS" selected>PKS</option>';
														}else{
															echo '<option value="">Select...</option>
															<option value="Demokrat">Demokrat</option>
															<option value="GOLKAR">GOLKAR</option>
															<option value="PDIP">PDIP</option>
															<option value="Gerindra">Gerindra</option>
															<option value="PAN">PAN</option>
															<option value="PKS">PKS</option>';
														}  ?>
														</select><tr>
							<td>Daerah Pemilihan <td>: <select name="Daerah">
														<?php if($edit['dapil'] == 'Semarang Tengah'){
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah" selected>Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Selatan'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan" selected>Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Utara'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara" selected>Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Timur'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur" selected>Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Barat'){
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat" selected>Semarang Barat</option>';
														}else{
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}  ?>
														</select><tr>
							<?php echo'<td>Visi Misi <td><textarea name="visi" rows="10" cols="40">'.$edit['visi'].'</textarea><tr>
							<td><p class="submit"><input type="submit" name="Edit" value="Edit"></p><tr>
							</table>
						</form>
				</article>';
	}else if (isset($_GET['module']) && $_GET['module'] == 'foto'){
		echo '<h2 class="isi">Ganti Foto Caleg</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="daftar" method="post" enctype="multipart/form-data">
							<table>
								<td>Pilih File <td>: <input type="file" name="image"><tr>
								<td><p class="submit"><input type="submit" name="Foto" value="Ganti Foto"></p><tr>
							</table>
						</form>
				</article>';
	}else if (isset($_GET['module']) && $_GET['module'] == 'voter'){
		echo '<h2 class="isi">Edit Data Voter</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="voter" method="post" action="">
							<table>
							<input id="user" type="hidden" name="user" value="'.$edit['username'].'">
							<td>Password <td>: <input id="pass" type="password" name="pass" value="" placeholder="Password" required><tr>
							<td>Ulang Password <td>: <input id="pass2" type="password" name="pass2" value="" placeholder="Ulangi Password" required><tr>
							<td>Nama Lengkap <td>: <input id="nama_lengkap" type="text" name="nama_lengkap" value="'.$edit['nama_lengkap'].'" placeholder="Nama Lengkap" required><tr>
							<td>No. KTP <td>: <input id="ktp" type="text" name="ktp" value="'.$edit['no_ktp'].'" placeholder="No. KTP" required><tr>
							<td>Alamat <td>: <input id="text" type="text" name="alamat" value="'.$edit['alamat'].'" placeholder="Alamat" required><tr>
							<td>Email <td>: <input id="email" type="email" name="email" value="'.$edit['email'].'" placeholder="Email" required><tr>
							<td>Daerah Pemilihan <td>: <select name="Daerah">';
														if($edit['dapil'] == 'Semarang Tengah'){
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah" selected>Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Selatan'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan" selected>Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Utara'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara" selected>Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Timur'){
															echo'<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur" selected>Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}else if($edit['dapil'] == 'Semarang Barat'){
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat" selected>Semarang Barat</option>';
														}else{
															echo '<option value="">Select...</option>
														    <option value="Semarang Tengah">Semarang Tengah</option>
														    <option value="Semarang Selatan">Semarang Selatan</option>
														    <option value="Semarang Utara">Semarang Utara</option>
														    <option value="Semarang Timur">Semarang Timur</option>
														    <option value="Semarang Barat">Semarang Barat</option>';
														}
														echo '</select><tr>
							<td><p class="submit"><input type="submit" name="voter" value="Edit"></p><tr>
							</table>
						</form>
				</article>';
	}else if (isset($_GET['module']) && $_GET['module'] == 'url'){
		echo '<h2 class="isi">Edit Data Voter</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="voter" method="post" action="">
							<table>
							<input id="user" type="hidden" name="username" value="'.$edit['username'].'">
							<td>URL Berita <td>: <input id="url" type="text" name="url" value="'.$edit['url'].'" placeholder="URL Berita" required><tr>
							<td><p class="submit"><input type="submit" name="edit_url" value="Edit"></p><tr>
							</table>
						</form>
				</article>';
	}?>
				<!-- isi penjelasan halaman -->
