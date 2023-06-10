<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Content-type: application/json; charset=utf-8");

    require_once("std_db.php");
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
        $std_fullname = $user->test_input($_POST['std_fullname']);
        $std_id = $user->test_input($_POST['std_id']);
        $std_level = $user->test_input($_POST['std_level']);
        $std_class = $user->test_input($_POST['std_class']);
        $std_phone = $user->test_input($_POST['std_phone']);

        if ($user->insert($std_fullname, $std_id, $std_level, $std_class, $std_phone)) {
            echo $user->message("User added successfully", false);
        } else {
            echo $user->message("Failed to add an user", true);
        }
    }

    //update Data
    if ($api == "PUT") {
        parse_str(file_get_contents('php://input'), $post_input);
        $std_fullname = $user->test_input($post_input['std_fullname']);
        $std_id = $user->test_input($post_input['std_id']);
        $std_level = $user->test_input($post_input['std_level']);
        $std_class = $user->test_input($post_input['std_class']);
        $std_phone = $user->test_input($post_input['std_phone']);

        if ($id != null) {
            if ($user->update($std_fullname, $std_id, $std_level, $std_class, $std_phone)) {
                echo $user->message("User Updated successfully", false);
            } else {
                echo $user->message("Failed to update", true);
            }
        } else {
            echo $user->message("User not found!", true);
        }
    }
?>