<?php /*Unused*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("
SELECT CONCAT(`u`.`firstName`,' ', `u`.`lastName`) AS `name`, `u`.`jobTitle`,
    SUM(CASE WHEN u.id = o.user_id THEN o.fix_bugs_cnt ELSE 0 END) AS `fixBugsCnt`,
    SUM(CASE WHEN u.id = o.user_id THEN o.responsive_cnt ELSE 0 END) AS `responsiveCnt`,
    SUM(CASE WHEN u.id = o.user_id THEN o.backup_cnt ELSE 0 END) AS `backupCnt`,
    SUM(CASE WHEN u.id = o.user_id THEN o.optimize_cnt ELSE 0 END) AS `optimizeCnt`,
    SUM(CASE WHEN u.id = o.user_id THEN o.misc_cnt ELSE 0 END) AS `miscCnt`
    FROM `ojt_webdev_tracker` `o`
    INNER JOIN `users` `u`
    ON YEAR(`o`.`track_date`) = YEAR(CURRENT_DATE())
    AND `o`.`user_id` = `u`.`id`
    GROUP BY `u`.`id`
");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Name":"'  . $rs["name"] . '",';
    $outp .= '"JobTitle":"'   . $rs["jobTitle"]        . '",';
    $outp .= '"FixBugsCnt":"'   . $rs["fixBugsCnt"]        . '",';
    $outp .= '"ResponsiveCnt":"'   . $rs["responsiveCnt"]        . '",';
    $outp .= '"BackupCnt":"'   . $rs["backupCnt"]        . '",';
    $outp .= '"OptimizeCnt":"'   . $rs["optimizeCnt"]        . '",';
    $outp .= '"MiscCnt":"'   . $rs["miscCnt"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>
