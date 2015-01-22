<?php require('header.php'); 
    try{
            $sql = 'SELECT * FROM voter'; 
            $res = $db->query($sql); 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }?>?>
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
        <h2><i class="glyphicon glyphicon-user"></i> Daftar Voter</h2>

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
        <th>Username</th>
        <th>Nama Lengkap</th>
        <th>Nomor KTP</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Dapil</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $No=1;
    foreach($res as $data){
        echo '
            <tr>
                <td>$No</td>
                <td class="center">'.$data['username'].'</td>
                <td class="center">'.$data['nama_lengkap'].'</td>
                <td class="center">'.$data['no_ktp'].'</td>
                <td class="center">'.$data['alamat'].'</td>
                <td class="center">'.$data['email'].'</td>
                <td class="center">'.$data['dapil'].'</td>
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