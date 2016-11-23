<?php
include_once("../models/servicos.php");
include_once("../models/adon.php");
$sr=new servico();
$ad=new adon();
?>


          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Cadastrar Produto</h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="new_servico" method="post" enctype="multipart/form-data">
                   <div  class="col-sm-3 col-md-12">
                 <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="servicos_list">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    <header>Checkout form</header>
                    
						<fieldset class="panel panel-default">
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" name="estado" aria-describedby="basic-addon1" required>
                                        <option value="0" selected="" disabled="">Estado</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Desativo</option>
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1"  required>
                        </div>
                             <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="tipo" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Tipo</option>
																				<?php
																				$query=$sr::tipo();
                                        while($dado = $query->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->tipo.'</option>';
                                           }
                                        ?>
                                    </select>
                        </div>
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-globe"></span></span>
                          <select class="form-control" name="categoria" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Categoria</option>
                                        <?php
																				$query=$sr::categoria();
                                        while($dado = $query->fetch(PDO::FETCH_OBJ)){
                                           echo '<option value="'.$dado->id.'">'.$dado->categoria.'</option>';
                                           }
                                        ?>
																				
                                    </select>
                        </div>
                        </fieldset>
                    
                        <fieldset class="panel panel-default">
                        
                            <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-money"></span></span>
                          <input type="number" class="form-control" name="preco" placeholder="Preço" aria-describedby="basic-addon1"  required>
                            <span class="input-group-addon" id="basic-addon1">,00 kzs</span>
                        </div>
                        
                            
						</fieldset>
                    
                    <fieldset class="panel panel-default" >
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <textarea class="form-control" name="text_factura" placeholder="Detalhes" aria-describedby="basic-addon1"  required></textarea>
                        </div>
						</fieldset>
                    
                    <fieldset class="panel panel-default">
                        <div class="col-sm-12">
                            <div class="input-group input-group-transparent">
                                <input id="transparent-input" class="form-control" type="file" name="imagem" accept="image/jpeg">
                                <span class="input-group-addon"><i class="fa fa-camera"></i></span></div>
                        </div> </fieldset>

                    <footer>
                        <div  class="col-sm-3 col-md-12">
                  <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-default">
                         <span class="fa fa-save"></span> Salvar</button>
                      <button type="reset" class="btn btn-default" >
                         <span class="fa fa-ban"></span> Canselar</button>
                    </div>
                  
              </div>
                    </footer>
                </form>
                
            </div>
          

