<?php

class AjaxModel
{
    public $connection = '';

    function __construct()
    {
        try {
            $this->connection = new mysqli("localhost", "root", "password", "ajax_crud");
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "Connection Failed: " . $msg;
            exit;
        }
    }
    function htmlValidation($form_data)
    {
        $form_data = trim(stripslashes(htmlspecialchars($form_data)));
        $form_data = mysqli_real_escape_string($this->connection, $form_data);
        return $form_data;
    }

    function InsertData($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode("','", $data);
        $insertSQL = "INSERT INTO $table($columns)VALUES('$values')";
        $insert = $this->connection->query($insertSQL);
        if ($insert == 1) {
            $response["data"] = null;
            $response["message"] = 'Data inserted successfully.';
            $response["status"] = 1;
        } else {
            $response["data"] = null;
            $response["message"] = 'Please try again later.';
            $response["status"] = 0;
        }

        return $response;
    }

    function SelectData($table, $where = '')
    {
        $SQL = "SELECT * FROM $table";
        if ($where != '') {
            $SQL .= " WHERE ";
            foreach ($where as $key => $value) {
                $SQL .= " $key LIKE '$value' AND";
            }
            $SQL = rtrim($SQL, 'AND');
        }
        $SQL .= " order by id desc";
        $get = $this->connection->query($SQL);
        if ($get->num_rows > 0) {
            while ($FetchData = $get->fetch_object()) {
                $allData[] = $FetchData;
            }
            $response["data"] = $allData;
            $response["message"] = 'success';
            $response["status"] = 1;
        } else {
            $response["data"] = null;
            $response["message"] = 'No data found';
            $response["status"] = 0;
        }
        return $response;
    }

    function UpdateData($table, $data, $where)
    {
        $UpdateSQL = "UPDATE $table set ";
        foreach ($data as $key => $value) {
            $UpdateSQL .= "$key = '$value',";
        }
        $UpdateData = rtrim($UpdateSQL, ',');
        $UpdateData .= " WHERE ";
        foreach ($where as $key => $value) {
            $UpdateData .= "$key = '$value' AND";
        }
        $UpdateData = rtrim($UpdateData, 'AND');
        return $SelectEx = $this->connection->query($UpdateData);
    }

    function DeleteData($table, $where)
    {
        $DeleteSQl = "DELETE FROM $table WHERE ";
        foreach ($where as $key => $value) {
            $DeleteSQl .= " $key = '$value'";
        }
        $DeleteSQlAfterTrim = rtrim($DeleteSQl);
        return $DeleteSQlEx = $this->connection->query($DeleteSQlAfterTrim);
    }
}
