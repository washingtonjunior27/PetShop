<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Vacinacao;

class VacinacaoRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection;
        $this->pdo = $conn->getConn();
    }

    public function CreateVacinacaoRepository(Vacinacao $vacinacao)
    {
        $sql = "INSERT INTO vacinacao (data_aplicacao, data_prox_dose, id_cliente_vacinacao, 
                                        id_pet_vacinacao, id_vet_vacinacao, resolvido)
                VALUES (:data_aplicacao, :data_prox_dose, :id_cliente_vacinacao, :id_pet_vacinacao, 
                        :id_vet_vacinacao, :resolvido)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':data_aplicacao' => $vacinacao->getData_de_aplicação(),
            ':data_prox_dose' => $vacinacao->getData_prox_dose(),
            ':id_cliente_vacinacao' => $vacinacao->getCliente_id_vacinacao(),
            ':id_pet_vacinacao' => $vacinacao->getPet_id_vacinacao(),
            ':id_vet_vacinacao' => $vacinacao->getVeterinario_id_vacinacao(),
            ':resolvido' => $vacinacao->getResolvido()
        ]);
    }
}
