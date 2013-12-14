<?php
require_once "includes/format_n_math.php";

function get_disk_usage($file) {
    $usage = array('total' => 0, 'used' => 0, 'free' => 0);
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    if ($lines) {
        foreach ($lines as $line) {
            $sec = explode(" ", $line);
            $usage['total'] += (int)($sec[0]);
            $usage['used'] += (int)($sec[1]);
            $usage['free'] += (int)($sec[2]);
        }
        $percent = $usage['used'] * 100.0 / $usage['total'];
        foreach ($usage as $key => $value) {
            $usage[$key] = format_bytes($value * 1024);
        }
        $usage['percent'] = (string)(round($percent, 2));
        $usage['percent_int'] = (string)(round($percent));
    } else {
        $usage['total'] = $usage['used'] = $usage['free'] = $usage['percent'] = '未知';
        $usage['percent_int'] = '0';
    }
    return $usage;
}
$diskusage = get_disk_usage('/home/mirror/log/disk.txt');
?>

<script>
$(function() {
$("#diskusage").progressbar({value : <?php echo $diskusage['percent_int'];?>});
humane.timeout = 30000;
</script>
