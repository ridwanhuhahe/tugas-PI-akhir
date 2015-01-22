<?php
	include ('db.php');
	if (isset($_SESSION['username']))
	{
		$sql = 'SELECT * FROM caleg where username=:username';
		$query = $db->prepare($sql);
		$query->execute(array(
			'username' => $_SESSION['username']
		));
		$foto = $query->fetch();
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['login']))
		{
			if($_POST['login']){
				if($_POST['akses'] == 'Caleg'){
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					$sql = 'SELECT * FROM caleg where username=:username';
					$query = $db->prepare($sql);
					$query->execute(array(
						'username' => $username
					));
					$user = $query->fetch();
					if($user && $user['password'] == $password){
						$_SESSION['username'] = $username;
						$_SESSION['akses'] = 'caleg';?>
						<script language="JavaScript">alert('Login Sukses!!');
						document.location='index.php'</script><?php
					}else{
						echo '<script>alert("Username atau Password Salah");</script>';
					}
				}else if($_POST['akses'] == 'Voter'){
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					$sql = 'SELECT * FROM voter where username=:username';
					$query = $db->prepare($sql);
					$query->execute(array(
						'username' => $username
					));
					$user = $query->fetch();
					if($user && $user['password'] == $password){
						$_SESSION['username'] = $username;
						$_SESSION['akses'] = 'voter';?>
						<script language="JavaScript">alert('Login Sukses!!');
						document.location='index.php'</script><?php
					}else{
						echo '<script>alert("Username atau Password Salah");</script>';
					}
				}else{
					echo '<script>alert("Akses Belum dipilih");</script>';
				}
			}
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>pemilu online</title>
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="jquery-ui.css" /> 
		<script src="java.js"></script>
		<script src="jquery-1.9.1.js"></script> 
		<script src="jquery-ui.js"></script>
		<script> 
			 $(function() { 
			 $( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true
				});
			 }); 
		 </script>
		<script>
			$(document).ready(function(){
			  $(".flip1").click(function(){
				$(".panel1").slideToggle("slow");
			  });
			});
		</script>
		<script>
			$(document).ready(function(){
			  $(".flip2").click(function(){
				$(".panel2").slideToggle("slow");
			  });
			});
		</script>
		<script>
			$(document).ready(function(){
			  $(".flip3").click(function(){
				$(".panel3").slideToggle("slow");
			  });
			});
		</script>
		<script>
			$(document).ready(function(){
			  $(".flip4").click(function(){
				$(".panel4").slideToggle("slow");
			  });
			});
		</script>
</head>
<body>
		<div id="content">
			<img id="banner" src="banner.jpg" />
			<!-- gambar banner -->
			<nav id="nav">	
				<ul>		
					<li>
						<a href="?page=home"><span>Home</span></a>
					</li>
					<li>
						<a href="?page=caleg"><span>Daftar Caleg</span></a>
					</li>
					<li>
						<a href="?page=partai"><span>Daftar Partai</span></a>
					</li>
					<?php
					if (isset($_SESSION['username']))
					{
						if (isset($_SESSION['akses']) && ($_SESSION['akses']) == 'caleg')
						{
							echo'
							<li>
								<a href="?page=artikel"><span>Tambah Artikel</span></a>
							</li>
							<li>
								<a href="logout.php"><span>Logout</span></a>
							</li>';
						}else{
							echo'
							<li>
								<a href="?page=voting"><span>Voting</span></a>
							</li>
							<li>
								<a href="logout.php"><span>Logout</span></a>
							</li>';
						}
					}else{
						echo'
						<li>
							<a href="javascript:void(0);"><span></span></a>
						</li>
						<li>
							<a href="javascript:void(0);"><span></span></a>
						</li>';
					}?>
				</ul>
			</nav> 
			
			<nav id="menu">
				<!-- berisi login, dan menu admin -->
				<div class="login">
					<h4>Search</h4>
						<?php echo'<form name="log" method="post" action="?page=caleg&act=search">
							<input type="text" name="kunci" size="16" value="" placeholder="Searching">
							<p class="submit"><input type="submit" name="search" value="Search"></p>';?>
						</form>
				</div>
			</nav>
			<div id="main">
				<?php
				if (isset($_GET['page']))
				{
					switch ($_GET['page']) {
					case 'home':
						include('home.php');
						break;
					case 'caleg':
						include('caleg.php');
						break;
					case 'partai':
						include('partai.php');
						break;
					case 'profil_caleg':
						include('profil_caleg.php');
						break;
					case 'profil_partai':
						include('profil_partai.php');
						break;
					case 'reg_caleg':
						include('reg_caleg.php');
						break;
					case 'reg_voter':
						include('reg_voter.php');
						break;
					case 'edit':
						include('edit.php');
						break;
					case 'voting':
						include('voting.php');
						break;
					case 'artikel':
						include('artikel.php');
						break;
					default:
						include('home.php');
						break;
					}
				}
				else
				{
					include('home.php');
				}
				?>
				<!-- isi penjelasan halaman -->
			</div>
			<nav id="menu2">
				<!-- berisi login, dan menu admin -->
				<div class="login">
					<?php
					if (isset($_SESSION['username']))
					{
						if (isset($_SESSION['akses']) && $_SESSION['akses'] == 'caleg')
						{
							echo'
								<h4>Selamat Datang '.($_SESSION["username"]).'</h4>
								<img src="'.$foto['foto'].'" width = 150/>
								<p class="submit"><form name="edit" method="post" action="?page=edit&module=akun"><input type="submit" name="edit" value="Edit Akun"></form></p>
								<p class="submit"><form name="edit" method="post" action="?page=edit&module=foto"><input type="submit" name="edit" value="Ganti Foto"></form></p>
								<p class="submit"><form name="edit" method="post" action="?page=edit&module=url"><input type="submit" name="edit" value="URL Berita"></form></p>';
						}else{
							echo'
								<h4>Selamat Datang '.($_SESSION["username"]).'</h4>
								<p class="submit"><form name="edit" method="post" action="?page=edit&module=voter"><input type="submit" name="edit" value="Edit Akun"></form></p>';
						}
					}else{
						echo'
							<h4>Login</h4>
							<form name="log" method="post" action="" onsubmit="return validateForm();">
								<input type="text" name="username" size="16" value="" placeholder="Username">
								<p><input type="password" name="password" size="16" value="" placeholder="Password"></p>
								<p>Akses : <select name="akses">
															  <option value="">Select...</option>
															  <option value="Voter">Voter</option>
															  <option value="Caleg">Caleg</option>
															</select></p>
								<p class="submit"><input type="submit" name="login" value="Login"></p>
							</form>';
					}?>
				</div>
				<?php
				if (isset($_SESSION['username']))
				{
					
				}else{
					echo'
						<div class="register">
							<h4>Register</h4>
								<a href="?page=reg_caleg">Buat Akun Caleg</a>
								</br></br>
								<a href="?page=reg_voter">Buat Akun Voter</a>
								</br></br>
						</div>';
				}?>
			</nav>
			<div class="clear"></div>
			<footer>TRACK RECORD LEGISLATIF</footer>
		</div>
	</body>
</html>