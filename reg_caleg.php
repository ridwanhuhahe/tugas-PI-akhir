<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['Daftar']))
		{
			if($_POST['Daftar']){
				if($_POST['pass'] == $_POST['pass2']){
					$namafolder="caleg/";
					if (!empty($_FILES["image"]["tmp_name"])) {     
						$jenis_gambar=$_FILES['image']['type'];
						if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")     {                    
								$gambar = $namafolder . basename($_FILES['image']['name']);                
								if (move_uploaded_file($_FILES['image']['tmp_name'], $gambar)) {             
									
									try{
										$tgllahir = date("Y-m-d", strtotime($_POST['tgl_lahir']));
										$sql = 'insert into caleg value 
												(:username, :password, :nama_lengkap, :tempat_lahir, :tanggal_lahir, :alamat, :email, :website, :partai, :dapil, :visi, :foto, :url)';
										$ssql = $db->prepare($sql);
										$ssql->execute(array(':username' => $_POST['username'], ':password' => md5($_POST['pass']), 
															':nama_lengkap' => $_POST['nama_lengkap'], ':tempat_lahir' => $_POST['tempat'], ':tanggal_lahir' => $tgllahir, 
															':alamat' => $_POST['alamat'], ':email' => $_POST['email'], ':website' => $_POST['website'],
															':partai' => $_POST['Partai'], ':dapil' => $_POST['Daerah'], ':visi' => $_POST['visi'], ':foto' => $gambar, ':url' => ""));
											$_SESSION['username'] = $_POST['username'];
											$_SESSION['akses'] = 'caleg';?>
											<script language="JavaScript">alert('Daftar Sukses!!');
											document.location='index.php'</script> <?php
									} catch (PDOException $e){
										echo '<script>alert("Daftar Gagal");</script>'.$e->getMessage(); 
									}
								} else {            
									echo "Gambar gagal dikirim";         
							}    } else {         
								echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";    
							} } else {     
								echo "Anda belum memilih gambar"; 
							}
						}
					}
				}else{
				echo '<script>alert("Ulangi Password Tidak Sama");</script>'; 
			}
			
		
	}
?>
				<h2 class="isi">Registrasi Caleg</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="daftar" method="post" enctype="multipart/form-data">
							<table>
							<td>Username <td>: <input id="username" type="text" name="username" value="" placeholder="Username" required><tr>
							<td>Password <td>: <input id="pass" type="password" name="pass" value="" placeholder="Password" required><tr>
							<td>Ulang Password <td>: <input id="pass2" type="password" name="pass2" value="" placeholder="Ulangi Password" required><tr>
							<td>Nama Lengkap <td>: <input id="nama_lengkap" type="text" name="nama_lengkap" value="" placeholder="Nama Lengkap" required><tr>
							<td>Tempat Lahir <td>: <input id="tempat" type="text" name="tempat" value="" placeholder="Tempat" required><tr>
							<td>Tanggal Lahir <td>: <input type="text" id="datepicker" name="tgl_lahir" value="" placeholder="Tanggal Lahir" required><tr>
							<td>Alamat <td>: <input id="alamat" type="text" name="alamat" value="" placeholder="Alamat" required><tr>
							<td>Email <td>: <input id="email" type="email" name="email" value="" placeholder="Email" required><tr>
							<td>Website <td>: <input id="website" type="text" name="website" value="" placeholder="Website" required><tr>
							<td>Partai <td>: <select name="Partai">
														  <option value="">Select...</option>
														  <option value="Demokrat">Demokrat</option>
														  <option value="GOLKAR">GOLKAR</option>
														  <option value="PDIP">PDIP</option>
														  <option value="Gerindra">Gerindra</option>
														  <option value="PAN">PAN</option>
														  <option value="PKS">PKS</option>
														</select><tr>
							<td>Daerah Pemilihan <td>: <select name="Daerah">
														  <option value="">Select...</option>
														  <option value="Semarang Tengah">Semarang Tengah</option>
														  <option value="Semarang Selatan">Semarang Selatan</option>
														  <option value="Semarang Utara">Semarang Utara</option>
														  <option value="Semarang Timur">Semarang Timur</option>
														  <option value="Semarang Barat">Semarang Barat</option>
														</select><tr>
							<td>Visi Misi <td><textarea name="visi" rows="10" cols="40"></textarea><tr>
							<td>Pilih File <td>: <input type="file" name="image"><tr>
							<td><p class="submit"><input type="submit" name="Daftar" value="Daftar"> <button type="reset" class="cancel">Cancel</button></p><tr>
							</table>
						</form>
				</article>
				<!-- isi penjelasan halaman -->
