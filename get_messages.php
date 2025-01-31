<?php
include 'connection.php';

if (isset($_GET['group_id'])) {
    $group_id = intval($_GET['group_id']);

    $stmt = $con->prepare("
        SELECT gm.msg_id, gm.msg, gm.sent_at, u.username
        FROM group_messages gm
        JOIN users u ON gm.id = u.id
        WHERE gm.group_id = ?
        ORDER BY gm.sent_at
    ");
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode(['messages' => $messages]);
}
?>
