<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Pesquisar
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  Pesquisar
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <form method="post" action="<?php echo URL;?>index">
                        <div class="form-group">
                            <label>Pesquisa</label>
                            <input class="form-control" name="livro" placeholder="Digite o nome do livro">
                        </div>
                        <button type="submit" class="btn btn-default">Pesquisar</button>
                    </form>
                </div>
                <?php if(isset($_POST['livro'])){?>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h2>Meus Livros</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Livro</th>
                                        <th>Alugado</th>
                                        <th>Reservado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	foreach ($this->livros as $obj) {
                                		echo"<tr>
                                        <td>".$obj['name']."</td>
                                        <td>";

                                        if ($obj['alugado'] == true)
                                        {
                                            if(!Session::get('role'))
                                            {
                                                echo "Alugado</td><td>";
                                            }
                                            else
                                            {
                                                foreach ($this->users as $user) {
                                                    if($user['id']==$obj['alugado'])
                                                    {
                                                        echo $user['name'].' <form method="post" action="'.URL.'index/devolverLivro"><input type="hidden" value="'.$obj['id'].'" name="idLivro"/> <button type="submit" class="btn btn-default">Devolver Livro</button></form></td><td>';
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        else
                                        {
                                            if(!Session::get('role'))
                                            {
                                                echo 'Disponível</td><td>';    
                                            }
                                            else
                                            {
                                                echo '<form method ="post" action="'.URL.'index/alugarLivro"> <div class="form-group">
                                                <input type = "number" class="form-control" name="idUser" placeholder="Digite id do usuário">
                                                <input type="hidden" name="idLivro" value="'.$obj['id'].'">
                                                </div>                                                
                                                <button type="submit" class="btn btn-default">Alugar</button></form></td><td>';
                                            }
                                        }


                                        if ($obj['reservado'] == true)
                                        {
                                            if(!Session::get('role'))
                                            {echo "Reservado</td>";}
                                            else
                                            {
                                                foreach ($this->users as $user) {
                                                    if($user['id']==$obj['reservado'])
                                                    {
                                                        echo $user['name'].' <form method="post" action="'.URL.'index/undoReserva"><input type="hidden" value="'.$obj['id'].'" name="idLivro"/> <button type="submit" class="btn btn-default">Desfazer Reserva</button></form></td>';
                                                        break;
                                                    }
                                                }   
                                            }
                                        }
                                        else
                                        {
                                            echo '<form method="post" action="'.URL.'index/reserva">
                                            <input type="hidden" name="idLivro" value="'.$obj['id'].'">';
                                            if(Session::get('role'))
                                            {
                                                echo '<div class="form-group">
                                                <input type="number" class="form-control" name="idUser" placeholder="Digite id do usuário">
                                                </div>';
                                            }
                                            else
                                            {
                                                echo '<input type="hidden" name="idUser" value="'.Session::get('id').'">';
                                            }
                                            echo '<button type="submit" class="btn btn-default">Reservar</button>
                                            </form></td>';
                                        }
                                    	"</tr>";
                                	}?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-- /.row -->

               

            </div>
            <!-- /.container-fluid -->