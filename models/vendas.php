<?php

include_once("../models/system.php");
include_once("../models/adon.php");
include_once("../models/servicos.php");
//include_once("../done/phpqrcode/");


header('Content-type:text/html');
header('Acess-Control-Allow-Origin:*');

include_once('database.conf.php');

class vendas extends database
{

    public function cadastrar($query)
    {
        $db = new database();
        //$query=$us->toString($query);
        try {
            extract($query);

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO
                        clientes
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7,:d8,:d9,:d10,:d11,:d12,:d13,:d14,:d15)
                        "
            );
            $query->bindValue(':d0', $d0);
            $query->bindValue(':d1', $d1);
            $query->bindValue(':d2', $d2);
            $query->bindValue(':d3', $d3);
            $query->bindValue(':d4', $d4);
            $query->bindValue(':d5', $d5);
            $query->bindValue(':d6', $d6);
            $query->bindValue(':d7', $d7);
            $query->bindValue(':d8', $d8);
            $query->bindValue(':d9', $d9);
            $query->bindValue(':d10', $d10);
            $query->bindValue(':d11', $d11);
            $query->bindValue(':d12', $d12);
            $query->bindValue(':d13', $d13);
            $query->bindValue(':d14', $d14);
            $query->bindValue(':d15', $d15);
            $res = $query->execute();
            if ($res) {
                $res = 1;
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function venda_painel_rem($iv)
    {
        $db = new database();
        $us = new usuario();
        try {
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("DELETE FROM itemVenda WHERE id = ?");
            $query->bindParam(1, $iv);
            $executa = $query->execute();
            if ($executa) {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function venda_painel_new($tutor = 1)
    {
        $db = new database();
        //$query=$us->toString($query);
        try {
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO
                        vendas
                        (tutor)
                    VALUES (:d0)
                        "
            );
            $query->bindValue(':d0', $tutor);
            $res = $query->execute();
            if ($res) {
                $query = $pdo->prepare("SELECT max(id) as id FROM vendas order by data DESC");
                $executa = $query->execute();
                if ($executa) {
                    while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                        setcookie('vend_actual', $dado->id, 36000, '/');

                        return true;
                    }
                }
                $res = 1;
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function venda_painel_reload($iv = '')
    {

        $sr = new servico();
        $venda_actual = $sr->venda_actual();
        $iv = ($iv == "0") ? 'true' : 's.nome="' . $iv . '"';
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "SELECT
                      i.id     AS id,
                      sum(s.preco)  AS preco,
                      s.id as sid,
                      s.nome   AS nome,
                      count(s.codigo) as qtd,
                      s.codigo AS codigo,
                      t.tipo   AS tipo
                    FROM
                      itemVenda i,
                      servicos s,
                      servico_tipo t
                    WHERE
                      i.idVenda = " . $venda_actual . "  AND
                      i.idItem = s.id AND
                      s.tipo = t.id and
                      " . $iv . "
                    GROUP BY s.codigo
                    ORDER BY s.nome, estado;
"
            );
            $i = 1;
            $executa = $query->execute();
            if ($executa) {
                $executa = '';
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    $executa .= '
                    <div class="btn-group col-md-12" role="group" aria-label="Default button group">
                        <button type="button" class="btn btn-danger col-md-1 rem" pr="' . $dado->id . '">< ' . $dado->qtd . '</button>
                        <button type="button" class="btn btn-default col-md-1">' . $i++ . '</button>
                        <button type="button" class="btn btn-default col-md-8" style="text-align: left">' . $dado->nome . '</button>
                        <button type="button" class="btn btn-default col-md-2 total_g" style="text-align: right" value="' . $dado->preco . '">' . money_format(
                            '%!n',
                            $dado->preco
                        ) . '</button>
                    </div>';
                }

                return $executa;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function venda_painel_print($venda_actual = 0)
    {

        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "SELECT
                      i.id     AS id,
                      sum(s.preco)  AS preco,
                      s.id as sid,
                      s.nome   AS nome,
                      count(s.codigo) as qtd,
                      s.codigo AS codigo,
                      t.tipo   AS tipo
                    FROM
                      itemVenda i,
                      servicos s,
                      servico_tipo t
                    WHERE
                      i.idVenda = " . $venda_actual . "  AND
                      i.idItem = s.id AND
                      s.tipo = t.id 
                    GROUP BY s.codigo
                    ORDER BY s.nome, estado;
"
            );
            //echo money_format('%.2n', $number)
            $i = 0;
            $executa = $query->execute();
            if ($executa) {
                $executa = '';
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    $executa .= '
                        <tr class="item">
                            <td>
                                ' . $dado->qtd . ' x ' . $dado->nome . ' - ' . $dado->id . '
                            </td>
                
                            <td class="moedax">
                                ' . money_format('%!n', $dado->preco) . '
                            </td>
                        </tr>';
                    $i += $dado->preco;
                }
                $executa .= '
        <tr class="total">
            <td></td>

            <td>
                Total: ' . money_format('%!n', $i) . '
            </td>
        </tr>';

                return $executa;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function addItemVenda($query)
    {
        $db = new database();

        try {
            extract($query);

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO
                        itemVenda
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6)
                        "
            );
            $query->bindValue(':d0', null);
            $query->bindValue(':d1', $idVenda);
            $query->bindValue(':d2', $idItem);
            $query->bindValue(':d3', $qtd);
            $query->bindValue(':d4', $preco);
            $query->bindValue(':d5', '0');
            $query->bindValue(':d6', $tipo);
            $res = $query->execute();
            if ($res) {
                $res = 1;
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function venda_painel_add($iv)
    {
        $db = new database();
        $sr = new servico();
        $venda_actual = $sr->venda_actual();
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO
                        itemVenda
                        (idVenda,idItem)
                    VALUES (
                        :d0,:d1)
                        "
            );
            $query->bindValue(':d0', $venda_actual);
            $query->bindValue(':d1', $iv);
            $res = $query->execute();
            if ($res) {
                $res = 1;
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function proforma($id)
    {
        $db = new database();
        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare(
            "
					DELETE FROM itemvenda WHERE idVenda=" . $id
        );
        $res = $query->execute();
        $query = $pdo->prepare(
            "
					DELETE FROM vendas WHERE id=" . $id
        );
        $res = $query->execute();
    }

    public function addVenda()
    {
        $db = new database();
        $vn = new vendas();
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO
                        vendas
                    VALUES (
                        :d0,:d1,:d2,:d3,:d4,:d5,:d6,:d7)
                        "
            );
            $query->bindValue(':d0', null);
            $query->bindValue(':d1', $_COOKIE['_FAPR'] . '' . $vn::idVenda() + 1);
            $query->bindValue(':d2', '0');
            $query->bindValue(':d3', '0');
            $query->bindValue(':d4', '0');
            $query->bindValue(':d5', '1');
            $query->bindValue(':d6', date('Y-m-d h:i:s'));
            $query->bindValue(':d7', $_COOKIE['user']);
            $res = $query->execute();
            if ($res) {
                return $vn::idVenda();
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function idVenda()
    {
        $db = new database();
        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare(
            "
                            SELECT * FROM vendas order by id DESC
                            "
        );
        $executa = $query->execute();
        if ($executa) {
            while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                return $dado->id;
            }
        }

        return 0;
    }

    public function cadastrar_def($d0)
    {
        $db = new database();
        $us = new usuario();
        try {
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    INSERT INTO conf_agente (idAgente) VALUES (:d0)"
            );
            $query->bindValue(':d0', $d0);
            $res = $query->execute();

            if ($res) {
                $res = 1;
            } else {
                $res = 0;
            }
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function estado_venda($query)
    {
        $db = new database();
        $d0 = explode("?", $query);
        print_r($query);
        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare(
            "
                    UPDATE
                        vendas
                    SET
                        estado = ?,
												data = ?
                    WHERE
                        id=?
                        "
        );
        $query->bindValue(1, $d0[0]);
        $query->bindValue(2, date('Y-m-d h:i:s'));
        $query->bindValue(3, $d0[1]);
        $res = $query->execute();

        if ($res) {
            return 1;
        }
    }

    public function up_venda($query)
    {
        $db = new database();
        extract($query);

        $PDO = new database();
        $pdo = $PDO->getDB();
        $query = $pdo->prepare(
            "
                    UPDATE
                        vendas
                    SET
                        idCliente = ?,
												data = ?
                    WHERE
                        id=?
                        "
        );
        $query->bindValue(1, $nome);
        $query->bindValue(2, date('Y-m-d h:i:s'));
        $query->bindValue(3, $id);
        $res = $query->execute();

        if ($res) {
            //print_r($query);
            //return 1;
        }
    }

    public function delete($query)
    {
        $db = new database();
        $us = new usuario();
        $d0 = explode("?", $query);
        try {
            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare("DELETE FROM " . $d0[0] . " WHERE id = ?");
            $query->bindParam(1, $d0[1]);
            $executa = $query->execute();
            if ($executa) {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function listar($d0 = "v.data", $d1 = "1=1")
    {
        if (isset($d1['usuario'])) {
            $d1 = $d1['usuario'];
        }
        $db = new database();
        if ($_COOKIE['tipo_usr'] == 2) {
            $d2 = " u.id=" . $_COOKIE['user'] . " and ";
        }

        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                    SELECT
						v.id as venda,
						v.data as data,
						v.estado as estado,
						v.total as total,
						u.nome as tutor,
                        idCliente as cliente
					FROM
					    vendas v,
					    utilizador u
					WHERE
						u.id=v.tutor and
                        " . $d1 . "
                    order by data DESC, estado"
            );
            $executa = $query->execute();
            if ($executa) {
                return $query;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function listar_pn($d0 = "v.data", $d1 = "1=1")
    {
        $db = new database();
        $d2 = "";
        if ($_COOKIE['tipo_usr'] == 2) {
            $d2 = " u.id=" . $_COOKIE['user'] . " and ";
        }
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                            SELECT
															distinct (v.id) as venda,
															v.data as data,
															v.estado as estado,
															v.total as total,
															v.idCliente as idCliente,
															u.nome as tutor
														FROM
															vendas v,
															utilizador u
														WHERE
														
															u.id=v.tutor and
															idCliente=0 and
															" . $d2 . "
															" . $d1 . "
                            order by data DESC, estado"
            );
            $query->bindParam(1, $d0);
            $query->bindParam(2, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                return $query;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function buscarPersonalizada($d1 = "1=1", $d0 = 0)
    {
        $db = new database();
        $vn = new vendas();
        $vn = new vendas();
        $ad = new adon();
        $sy = new system();

        $si = $sy::verSistema();
        $resultado = "";
        $d2 = "";
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                '
                  SELECT
				  	v.id as venda,
					v.data as data,
					v.estado as estado,
				    v.total as total,
					u.nome as tutor,
                    idCliente as cliente
				FROM
					vendas v,
					utilizador u
				WHERE
					u.id=v.tutor and
					' . $d1['usuario'] . '
					and ' . $d1['data'] . '
                    order by v.data DESC, estado'
            );
            $executa = $query->execute();
            if ($executa) {
                $i = 1;
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    $data = explode(" ", $dado->data);
                    if ($data[0] == $d1) {
                        $total = $vn::totalItem($dado->venda) - $vn::totalItem(
                                $dado->venda
                            ) * ($dado->desconto + $dado->desconto2) / 100 + ($vn::totalItem(
                                    $dado->venda
                                ) * $si->iV / 100);
                        $resultado .= '
                <tr>
                  <td>' . $i++ . '</td>
                  <td>' . $dado->venda . '</td>
                  <td>' . $dado->idCliente . '#' . $dado->cliente . '</td>
                  <td class="text - right">' . $total . '</td>
                  <td><span class="label es - ' . $vn::venda_estado($dado->estado) . '">' . $vn::venda_estado($dado->estado) . '</span></td>
                  <td>' . $ad::data($dado->data) . '</td>
                  <td><b>' . $dado->tutor . '</b></td>
                  <td class="btn - group pull - right" role="group" aria-label="...">';
                        if ($dado->estado == 1) {
                            $resultado .= '<button class="btn btn -default btn invoice_view" value="venda_new ? ' . $dado->venda . '"><span class="fa fa - edit "></span></button>';
                        }
                        $resultado .= '<button class="btn btn -default btn invoice_view" value="invoice ? ' . $dado->venda . '"><span class="fa fa - file - text - o "></span></button></td>
                </tr>';

                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $resultado;
    }

    public function listar_itemVenda($d0, $d1)
    {
        $db = new database();
        try {


            $PDO = new database();
            $pdo = $PDO->getDB();
            if ($d1 == 1) {
                $busca = "
                            SELECT
																v.id as id,
															  a.codigo as codigo,
																a.nome as descricao,
																u.unidade as unidade,
																a.preco as preco,
																a.text_factura as texto,
																a.qtd_unidade as qtdUni,
																v.tipo as tipo,
																v.qtd as qtd,
																(v.qtd * a.preco) as total
														FROM
															itemVenda v,
															unidade u,
																artigos a
														WHERE
															v.tipo = 1 and
                                                            v.idItem = a.id and
                                                            v.idVenda =? and
															u.id = a.unidade
															";
            } else {
                $busca = "	
	
	SELECT
                      i.id     AS id,
                      s.preco AS preco,
                      s.nome as descricao,
                      s.text_factura as texto,
                      sum(i.qtd) AS qtd,
                      s.id as sid,
                      s.nome   AS nome,
                      count(s.codigo) as qtd,
                      s.codigo AS codigo,
                      t.tipo   AS tipo
                    FROM
                      itemVenda i,
                      servicos s,
                      servico_tipo t,
                      vendas v
                    WHERE
                      v.id=i.idVenda and
                      i.idVenda = ?  AND
                      i.idItem = s.id AND
                      s.tipo = t.id
                    GROUP BY s.codigo
                    ORDER BY s.nome;
	";
            }
            $query = $pdo->prepare($busca);
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                return $query;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function totalItem($d0 = "data")
    {
        $db = new database();
        $soma = 0;
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                            SELECT(sum(a.preco * i.qtd)) as preco
														FROM
															itemVenda i,
															artigos a
														WHERE
															i.iditem = a.id and i.idVenda =?"
            );
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {

                }

            }
            $query = $pdo->prepare(
                "
                            SELECT s.preco  as preco, i.qtd as qtd, s.nome as nome
														FROM
															itemVenda i,
															servicos s
														WHERE
															i.iditem = s.id and i.idVenda =?"
            );
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    $soma += $dado->preco;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $soma;
    }

    public function valor_venda($d0)
    {
        $db = new database();
        //$us=new usuario();
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                            SELECT * FROM vendas
                            where idVenda = ?"
            );
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                return $query;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function soma_stock($d0)
    {
        $db = new database();
        //$us=new usuario();
        //return $d0;
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                            SELECT sum(quantidade) as stock FROM stock
                            where idItem = ?"
            );
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {

                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    return $dado->stock;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function venda_estado($d0)
    {
        $db = new database();
        try {

            $PDO = new database();
            $pdo = $PDO->getDB();
            $query = $pdo->prepare(
                "
                            SELECT * FROM venda_estado
                            where id = ?"
            );
            $query->bindParam(1, $d0, PDO::PARAM_STR);
            $executa = $query->execute();
            if ($executa) {
                while ($dado = $query->fetch(PDO::FETCH_OBJ)) {
                    return $dado->estado;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function qr($code, $data)
    {
        $PNG_TEMP_DIR = '../imgs/qr/tmp/';//dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

        //html PNG location prefix
        $PNG_WEB_DIR = '../imgs/qr/';

        include "../dones / phpqrcode / qrlib.php";

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR)) //   mkdir($PNG_TEMP_DIR);


        {
            $filename = $PNG_TEMP_DIR . 'test.png';
        }

        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'L';

        $matrixPointSize = 8;

        $filename = $PNG_TEMP_DIR . 'QR_' . $code . '.png';
        //$filename = $PNG_TEMP_DIR.'test'.$code.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        if (0) {
        } else {

            //default data
            //echo 'You can provide data in GET parameter: <a href=" ? data = like_that">like that</a><hr/>';
            QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        }
    }
}
