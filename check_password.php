<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $password = $data['password'];
    $strength = checkPasswordStrength($password);
    echo json_encode(['strength' => $strength]);
}

function checkPasswordStrength($password) {
    $strength = 0;
    if (strlen($password) >= 8) $strength++;
    if (preg_match('/[A-Z]/', $password)) $strength++;
    if (preg_match('/[a-z]/', $password)) $strength++;
    if (preg_match('/[0-9]/', $password)) $strength++;
    if (preg_match('/[^A-Za-z0-9]/', $password)) $strength++;
    
    switch($strength) {
        case 0:
        case 1:
            return 'Very Weak';
        case 2:
            return 'Weak';
        case 3:
            return 'Moderate';
        case 4:
            return 'Strong';
        case 5:
            return 'Very Strong';
        default:
            return 'Unknown';
    }
}
?>
