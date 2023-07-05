<?php
include_once('index.php');

?>
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Dashboard</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="">Add New</a>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Dashboard</h2>
                            <ul class="header-dropdown dropdown">                                
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                               <div class="card">
                        <div class="header">
                            <h2>All Games</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TEAMS</th>
										<th>LEAGUE</th>
                                        <th>TIPS</th>
                                        <th>ODD</th>
										<th>TYPE</th>
										<th>OUTCOME</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
									$no = 1;
									$result = predict_true_fetch();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                        <td><?php echo $fetch['teama'] .' vs '.$fetch['teamb'];?></td>
										<td><?php echo $fetch['league']; ?> </td>
                                        <td><?php echo $fetch['tips']; ?></td>
										<td><?php echo $fetch['odd']; ?></td>
										<td><?php echo $fetch['postype']; ?></td>
										<td><?php echo $fetch['outcome'];?></td>
										<td><a class="pdel btn btn-danger" id="<?php echo $fetch['id']; ?>" title="delete">X</a></td>
                                        </tr>
										<?php
									   }
									}else{
										echo'<tr><td><td><td><td>No data</td></td></td></td></tr>';
									}
										?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                            <h4>Stater Page</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>