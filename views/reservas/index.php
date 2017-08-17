<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tables
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  Reservas
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h2>Minhas reservas</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Livro</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	foreach ($this->reservas as $obj) {
                                		echo'<tr>
                                        <td>'.$obj['name'].'</td>
                                        <td>'.$obj['time'].'</td>
                                        <td><form method = "post" action="'.URL.'index/undoReserva"> <input type="hidden" name="idLivro" value="'.$obj['id'].'"><button type="submit" class="btn btn-default">Desfazer Reserva</button></form></td>
                                    	</tr>';
                                	}?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

               

            </div>
            <!-- /.container-fluid -->
