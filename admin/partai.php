<?php require('header.php'); 
    try{
            $sql = 'SELECT * FROM partai'; 
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
        <h2><i class="glyphicon glyphicon-user"></i> Daftar Partai</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>No</th>
        <th>Partai</th>
        <th>Nama Partai</th>
        <th>Foto</th>
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
                <td class="center">'.$data['partai'].'</td>
                <td class="center">'.$data['nama'].'</td>
                <td class="center"><img src="../'.$data['foto'].'" width = 150/></td>
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