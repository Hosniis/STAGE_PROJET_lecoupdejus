<?php
require '../constants/config.php';
require '../constants/check-login.php';
error_reporting(0);

if ($logged == "1") {
       if ($myrole == "admin") {

       }else{

        header("location:../");

       }

    }else{

        header("location:../");

    }


?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $site_title; ?> - Utilisateur</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a target="_blank" class="navbar-brand" href="../"><?php echo $site_title; ?></a>
            </div>
        

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $myusername; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="account"><i class="fa fa-gear fa-fw"></i> Paramètre du compte</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                        </li>
                    </ul>

                </li>

            </ul>
           

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="./"><i class="fa fa-dashboard fa-fw"></i> Menu</a>
                        </li>
                        <li>
                            <a href="pub-ads"><i class="fa fa-edit fa-fw"></i> Annonces</a>
                        </li>
                        <li>
                            <a href="active-ads"><i class="fa fa-check-circle-o fa-fw"></i> Annonces en ligne</a>
                        </li>
                        <li>
                            <a href="pending-ads"><i class="fa fa-spinner fa-fw"></i> Annonces en attente</a>
                        </li>
                        <li>
                            <a href="featured-ads"><i class="fa fa-star-o fa-fw"></i> Annonces vedette</a>
                        </li>
                        <li>
                            <a href="users"><i class="fa fa-users fa-fw"></i> utilisateurs</a>
                        </li>
                        <li>
                            <a href="account"><i class="fa fa-cog fa-fw"></i> Paramètre du compte</a>
                        </li>
                        <li>
                            <a href="faq"><i class="fa fa-question-circle fa-fw"></i> FAQ</a>
                        </li>
                        <li>
                            <a href="about"><i class="fa fa-info-circle fa-fw"></i> A Propos</a>
                        </li>
                         <li>
                            <a href="../logout"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                        </li>

                    </ul>
                </div>
              
            </div>
        
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
            <h4 class="page-header">Utilisateur</h4>
        </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                     <?php require 'constants/check-reply.php'; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Users
                        </div>

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Reg: Date</th>
                                        <th>ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
                                  $stmt = $conn->prepare("SELECT * FROM tbl_users");
                                  $stmt->execute();
                                  $result = $stmt->fetchAll();

                                  foreach($result as $row)
                                  {

                                    $avatar = $row['avatar'];
                                    $ver = $row['verified'];


                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="width:60px">
                                            <?php 
                                        if ($avatar == null) {

                                         print '<img style="width:60px" class="user_avatar" src="../assets/img/blank_avatar.png" alt="">';

                                         }else{
                                            print '<img style="width:60px" class="user_avatar" src="../uploads/avatar/'.$avatar.'" alt="">';

                                         }

                                        ?>
                                        </td>
                                        <td style="width:200px"><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td ><?php echo $row['reg_date']; ?></td>
                                        <td ><?php echo $row['user_id']; ?> </td>
                                        <td >
                                             <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Select Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                        <?php
                                                        if ($ver == "YES") { 
                                               ?> <li><a href="app/unver.php?node=<?php echo $row['user_id'];?>">Supprimer la certification</a><?php
                                                        }else{
                                               ?> <li><a href="app/ver.php?&node=<?php echo $row['user_id'];?>">Ajouter la certification</a><?php
                                                        }

                                                        ?>
                                                <li><a onclick = "return confirm('La suppression de cet utilisateur supprimera également les annonces publiées par celuis ci. Continuez ? ');" href="app/drp-user.php?img=<?php echo $row['avatar'];?>&node=<?php echo $row['user_id'];?>">Supprimer</a>
                                                    </li>
         
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <?php
        

                                  }
                      
                                 }catch(PDOException $e)
                                   {
                                     echo "Connection failed: " . $e->getMessage();
                                  }

                                    ?>

                                  
                                </tbody>
                            </table>

                        </div>

                    </div>
    
                </div>
             
            </div>
         

        </div>


    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>


    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
