<?php

require_once 'Conexao.php';
require_once 'admDAO.php';


class produto extends Conexao{
    public function CadastrarProduto($produto, $valor, $quantidade){
        if($produto == '' || $valor == '' || $quantidade == ''){
            return 0;
        }

        else{
            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_produto(nome_produto, valor_produto, quantidade_produto, adm_id_adm) values(?, ?, ?, ?)';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $produto);
            $sql->bindValue(2, $valor);
            $sql->bindValue(3, $quantidade);
            $sql->bindValue(4, admDAO::UsuarioLogado());

            try{
                $sql->execute();
                return 1;
            } catch (Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
            
        }
    }
}

?>
