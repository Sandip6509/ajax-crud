<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/AjaxModel.php');
session_start();

class AjaxCrudController extends AjaxModel
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SERVER['PATH_INFO'])) {
            switch ($_SERVER['PATH_INFO']) {
                case '/index':
                    include 'Views/index.php';
                    break;
                case '/get_emp_data':
                    try {
                        $all = $this->SelectData('employee');
                        echo json_encode($all);
                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                case '/ins_emp_data':
                    try {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $insertData = [
                                'emp_id' => $this->htmlValidation($_POST['emp_id']),
                                'name' => $this->htmlValidation($_POST['name']),
                                'email' => $this->htmlValidation($_POST['email']),
                                'department' => $this->htmlValidation($_POST['department']),
                                'designation' => $this->htmlValidation($_POST['designation']),
                                'joining_date' => $this->htmlValidation($_POST['joining_date']),
                                'gender' => $this->htmlValidation($_POST['gender']),
                            ];
                            $insert = $this->InsertData('employee', $insertData);
                            echo json_encode($insert);
                        } else {
                            $response["data"] = null;
                            $response["message"] = 'Method must be POST.';
                            $response["status"] = 0;
                            echo json_encode($response);
                        }
                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                case '/get_edit_data':
                    try {
                        $all = $this->SelectData('employee', ['id' => $this->htmlValidation($_REQUEST['checkid'])]);
                        echo json_encode($all);
                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                case '/upd_emp_data':
                    try {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $updateData = [
                                'emp_id' => $this->htmlValidation($_POST['emp_id']),
                                'name' => $this->htmlValidation($_POST['name']),
                                'email' => $this->htmlValidation($_POST['email']),
                                'department' => $this->htmlValidation($_POST['department']),
                                'designation' => $this->htmlValidation($_POST['designation']),
                                'joining_date' => $this->htmlValidation($_POST['joining_date']),
                                'gender' => $this->htmlValidation($_POST['gender']),
                            ];
                            $update = $this->UpdateData('employee', $updateData, ['id' => $this->htmlValidation($_POST['id'])]);
                            echo json_encode($update);
                        } else {
                            $response["data"] = null;
                            $response["message"] = 'Method must be POST.';
                            $response["status"] = 0;
                            echo json_encode($response);
                        }
                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                case '/delete_emp_data':

                    try {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $delete_data = $this->DeleteData('employee', ['id' => $this->htmlValidation($_REQUEST['deleteid'])]);
                            echo json_encode($delete_data);
                        }
                    } catch (\Exception $ex) {
                        throw $ex;
                    }

                    break;
                default:
                    break;
            }
        } else {
?>
            <script type="text/javascript">
                window.location.href = 'index';
            </script>
<?php
        }
    }
}

$obj = new AjaxCrudController;
