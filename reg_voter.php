<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST['Daftar']))
	{
		if($_POST['Daftar']){
			if($_POST['pass'] == $_POST['pass2']){
				try{
					$sql = 'insert into voter value 
							(:username, :nama_lengkap, :no_ktp, :password, :alamat, :email, :dapil)';
					$ssql = $db->prepare($sql);
					$ssql->execute(array(':username' => $_POST['user'], ':nama_lengkap' => $_POST['nama_lengkap'], 
										':no_ktp' => $_POST['ktp'], ':password' => md5($_POST['pass']),  ':alamat' => $_POST['alamat'], 
										':email' => $_POST['email'], ':dapil' => $_POST['Daerah'] ));
						$_SESSION['username'] = $_POST['user'];
						$_SESSION['akses'] = 'voter';?>
						<script language="JavaScript">alert('Daftar Sukses!!');
						document.location='index.php'</script> <?php
				} catch (PDOException $e){
					echo '<script>alert("Daftar Gagal");</script>'.$e->getMessage(); 
				}
			}else{
				echo '<script>alert("Ulangi Password Tidak Sama");</script>'; 
			}
		}
	}
}
?>
				<h2 class="isi">Registrasi Voter</h2>
				<!-- untuk judul halaman -->
				<article class="isi">
						<form name="daftar" method="post" action="">
							<table>
							<td>Username <td>: <input id="user" type="text" name="user" value="" placeholder="Username" required><tr>
							<td>Password <td>: <input id="pass" type="password" name="pass" value="" placeholder="Password" required><tr>
							<td>Ulang Password <td>: <input id="pass2" type="password" name="pass2" value="" placeholder="Ulangi Password" required><tr>
							<td>Nama Lengkap <td>: <input id="nama_lengkap" type="text" name="nama_lengkap" value="" placeholder="Nama Lengkap" required><tr>
							<td>No. KTP <td>: <input id="ktp" type="text" name="ktp" value="" placeholder="No. KTP" required><tr>
							<td>Alamat <td>: <input id="text" type="text" name="alamat" value="" placeholder="Alamat" required><tr>
							<td>Email <td>: <input id="email" type="email" name="email" value="" placeholder="Email" required><tr>
							<td>Daerah Pemilihan <td>: <select name="Daerah">
														  <option value="">Select...</option>
														  <option value="Semarang Tengah">Semarang Tengah</option>
														  <option value="Semarang Selatan">Semarang Selatan</option>
														  <option value="Semarang Utara">Semarang Utara</option>
														  <option value="Semarang Timur">Semarang Timur</option>
														  <option value="Semarang Barat">Semarang Barat</option>
														</select><tr>
							<td><p class="submit"><input type="submit" name="Daftar" value="Daftar"> <button type="reset" class="cancel">Cancel</button></p><tr>
							</table>
						</form>
				</article>
				<!-- isi penjelasan halaman -->