<?php

include_once "../model/search.model.php";

class ShowSearch
{
    public $idCustomer;
    public $result;

    public function showSearch($search)
    {
        $objRespuesta = ShowSearchModel::mdlShowSearch($this->result, $this->idCustomer, $search);
        return $objRespuesta;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $showSearch = new ShowSearch();

    $showSearch->idCustomer = $_POST['idCustomer'] ?? null;

    $search = $_POST['search'] ?? '';

    $response = $showSearch->showSearch($search);

    echo json_encode($response);
} else {
    echo json_encode(["codigo" => "400", "mensaje" => "Bad Request"]);
}
