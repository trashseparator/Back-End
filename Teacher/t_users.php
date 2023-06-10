<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Content-type: application/json; charset=utf-8");

    require_once("t_db.php");
    $user = new Database();

    $api = $_SERVER["REQUEST_METHOD"];

    $id = intval($_GET['id'] ?? '');

    if ($api == "GET") {
        if ($id != 0) {
            $data = $user->fetch($id);
        } else {
            $data = $user->fetch(); 
        }
        echo json_encode($data);
    }

    if ($api == "POST") {
        $t_fullname = $user->test_input($_POST['t_fullname']);
        $t_phone = $user->test_input($_POST['t_phone']);

        if ($user->insert($t_fullname, $t_phone, $phone)) {
            echo $user->message("User added successfully", false);
        } else {
            echo $user->message("Failed to add an user", true);
        }
    }

    //update Data
    if ($api == "PUT") {
        parse_str(file_get_contents('php://input'), $post_input);
        $t_fullname = $user->test_input($post_input['t_fullname']);
        $t_phone = $user->test_input($post_input['t_phone']);

        if ($id != null) {
            if ($user->update($t_fullname, $t_phone, $id)) {
                echo $user->message("User Updated successfully", false);
            } else {
                echo $user->message("Failed to update", true);
            }
        } else {
            echo $user->message("User not found!", true);
        }
    }
?>