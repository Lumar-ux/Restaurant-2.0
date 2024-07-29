<?php
require_once(__DIR__ . '/backoffice.php');
if(isset($_POST['submit']) && isset($_POST['user_id'])) {
    $userIdASupprimer=$_POST['user_id'];
    echo $userIdASupprimer;
    try {
        $deleteTavolaStatement = $mysqlClient->prepare('DELETE FROM users WHERE user_id = :user_id');
        $deleteTavolaStatement->bindParam(':user_id', $userIdASupprimer, PDO::PARAM_INT);
        $deleteTavolaStatement->execute();
        echo "Entrée supprimée avec succès !";
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit(); 
    } catch(PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID utilisateur non valide.";
}
header("Location: backoffice.php");
exit();