<?php
require_once 'lib/connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$username = isset($data['username']) ? $data['username'] : null;
$password = isset($data['password']) ? $data['password'] : null;
$c_password = isset($data['c_password']) ? $data['c_password'] : null;

if ($username || $password || $c_password) {
    $conn = connect();
    if($password != $c_password) {
        echo json_encode(['success' => false, 'message' => 'Password not match.'], JSON_UNESCAPED_UNICODE);
    } else {
        $check = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $check->execute([
            $username
        ]);
        if($check->rowCount() == 0) {
            $reg = $conn->prepare("INSERT INTO user (`username`, `password`, `cart`) VALUES (?, ?, NULL)");
            $reg->execute([
                $username,
                $password
            ]);
            $find = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
            $find->execute([
                $username,
                $password
            ]);
            $exe = $find->fetch();
            $_SESSION['id'] = $exe['ID'];
            $_SESSION['username'] = $exe['username'];
            echo json_encode(['success' => true, 'message' => 'Success'], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['success' => false, 'message' => 'Username already taken'], JSON_UNESCAPED_UNICODE);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'What.'], JSON_UNESCAPED_UNICODE);
}
?>