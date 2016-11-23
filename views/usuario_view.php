<?php
include_once("../models/clientes.php");
include_once("../models/adon.php");
$cl=new cliente();
$ad=new adon();
$query=$cl::listar();
?>


          <div class="row page-header">
              
              <div  class="col-sm-3 col-md-12">
              <h1>Cadastrar Usuario do Sistema</h1>
              </div>
              
          </div>

          <div class="col-md-12">
                <!-- Checkout-Form -->
                <form action="javascript:;" class="new" value="new_usuario" method="post">
                     <div  class="col-sm-3 col-md-12">
                 <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="usuarios">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    <header>Checkout form</header>
                    
						<fieldset class="panel panel-default">
                        
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-caret-square-o-up"></span></span>
                            <select class="form-control" required name="estado" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Estado</option>
                                        <option value="1">Ativo</option>
                                        <option value="0">Desativo</option>
                            </select>
                        </div>
                        <div class="input-group col col-md-4">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-users"></span></span>
                            <select class="form-control" name="tipo" placeholder="Nº Contribuite" aria-describedby="basic-addon1">
                                        <option value="-1" selected="" disabled="">Tipo</option>
																				<option value="0">Administrador</option>
																				<option value="1">Colaborador</option>
																				<option value="2">Operador</option>
                                        
                            </select>
                        </div>
                        <br>
                        <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" required name="nome" placeholder="Nome completo" aria-describedby="basic-addon1">
                        </div>
                             <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope-o"></span></span>
                          <input type="text" class="form-control" name="email" placeholder="E-mail" aria-describedby="basic-addon1">
                        </div>
                        
                        </fieldset>
									<fieldset class="panel panel-default">
									 <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user"></span></span>
                          <input type="text" class="form-control" name="username" minlength="3" placeholder="Nome de usuario" aria-describedby="basic-addon1">
                        </div>
										 <div class="input-group col col-md-8">
                          <span class="input-group-addon" id="basic-addon1"><span class="fa fa-key"></span> Password </span>
                          <input type="text" class="form-control" required minlength="8" name="password" placeholder="Palavra passe" aria-describedby="basic-addon1"
																 value="<?php	$pos="a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,Y,X,Z,1,2,3,4,5,6,7,8,9,0,@,#,$,%,&";
																					$pos=explode(',',$pos);
																				for($i=0;$i<8;$i++){
																					echo $pos[rand(0,sizeof($pos)-1)];
																				}
																				
																				?>"
																 >
                        </div>
									</fieldset>
                    
            
                    <footer>
                        <div  class="col-sm-3 col-md-12">
                 <div class="btn-group navbar-right" role="group" aria-label="...">
                      <button type="submit" class="btn btn-primary">
                         <span class="fa fa-save"></span></button>
                      <button type="reset" class="btn btn-default">
                         <span class="fa fa-refresh"></span></button>
                      <button type="button" class="btn btn-default link" value="client_list">
                         <span class="fa fa-ban"></span></button>
                        </div></div>
                    </footer>
                </form>
                
            </div>
          

