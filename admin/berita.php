<?php require('header.php'); 
    try{
            $sql = 'SELECT * FROM berita'; 
            $res = $db->query($sql); 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Tables</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Berita</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <a href="tambah.php"><button class="btn btn-info btn-sm">Tambah Berita</button></a>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Berita 1</th>
        <th>Berita 2</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $No=1;
    foreach($res as $data){
        echo '
        <tr>
            <td>'.$No.'</td>
            <td class="center">'.$data['judul'].'</td>
            <td class="center">'.$data['berita1'].'</td>
            <td class="center">'.$data['berita2'].'</td>
            <td class="center">
                <a class="btn btn-info" href="#">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                    Edit
                </a>
                <a class="btn btn-danger" href="#">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Delete
                </a>
            </td>
        </tr>';
        $No++;
    }?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->

<?php require('footer.php'); ?>