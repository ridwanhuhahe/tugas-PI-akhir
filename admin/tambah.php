<?php require('header.php'); 

    if (isset($_POST['tambah']))
    {
        if($_POST['tambah']){
                try{
                    $sql = 'insert into berita value 
                            (:id, :judul, :berita1, :berita2)';
                    $ssql = $db->prepare($sql);
                    $ssql->execute(array(':id' => "", ':judul' => $_POST['judul'], ':berita1' => $_POST['berita1'], ':berita2' => $_POST['berita2'] ));?>
                        <script language="JavaScript">alert('Tambah Berita Sukses!!');
                        document.location='berita.php'</script> <?php
                } catch (PDOException $e){
                    echo '<script>alert("Tambah Berita Gagal");</script>'.$e->getMessage(); 
                }
        }
    }
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Berita</a>
        </li>
        <li>
            <a href="#">Tambah Berita</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-globe"></i> Tambah Berita</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form name="tambah" method="post">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul Berita">
                    </div>
                    <div class="form-group">
                        <label for="berita1">Berita 1</label>
                        <textarea class="form-control" name="berita1" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="berita2">Berita 2</label>
                        <textarea class="form-control" name="berita2" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-default" name="tambah" value="tambah">Tambah Berita</button>
                </form>

            </div>

<?php require('footer.php'); ?>

