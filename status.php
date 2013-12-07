<?php
ini_set('default_socket_timeout', 3);
include "includes/bydistro.php";
include "includes/before.php";
?>
<?php
date_default_timezone_set('Asia/Shanghai');
$status = initialize_status(array(
    '/home/mirror/log/status.txt', 'http://mirror-nas.tuna.tsinghua.edu.cn/log/status.txt'));
$diskusage = get_disk_usage('/home/mirror/log/disk.txt');
?>
<script>
$(function() {
$("#diskusage").progressbar({value : <?php echo $diskusage['percent_int'];?>});
humane.timeout = 30000;
</script>
<?php
$specs = array(
    //第四个（下标3）表示是否为官方源，N表示不是，A表示是（并且官方分配了另外的域名）
    //B表示是（但是没有官方的域名），U表示不知道
    array('apache', 'apache software foundation的软件', 'fqj1994', array('B')),
    array('archlinux', '滚动更新的 Linux 发行版，极简主义哲学。', 'xiaq', array('B')),
    array('archlinuxarm', 'Archlinux ARM port.', 'xiaq', array('A', 'url' => 'cn.mirror.archlinuxarm.org')),
    array('centos', '由社区维护的与 RHEL 完全兼容的发行版。', 'alick', array('B')),
    array('chakra', '基于 KDE SC、无 Gtk 的桌面环境。前身是 Archlinux 的 [kde-mod]。', 'xiaq', array('N')),
    array('CPAN', 'Comprehensive Perl Archive Network', 'fqj1994', array('N')),
    array('CRAN', 'The Comprehensive R Archive Network', 'ray', array('N')),
    array('CTAN', 'Comprehensive TeX Archive Network', 'MichaelChou', array('N')),
    array('cygwin', 'Windows 平台下的类 Unix环境.', 'BYVoid', array('N')),
    array('debian', '一个完全由社区维护的 Linux 发行版。', 'heroxbd', array('N')),
    array('debian-backports', 'Debian Stable 上用的 Testing/Unstable 扩展包。', 'heroxbd', array('N')),
    array('debian-cd', 'Debian CD 镜像。', 'fqj1994', array('N')),
    array('debian-firmware', 'Debian 的闭源 firmware 和含有闭源 firmware 的 netinst CD。', 'fqj1994', array('N')),
    array('debian-multimedia', 'Debian 非官方多媒体套件。', 'heroxbd', array('N')),
    array('debian-security', 'Debian 安全情报', 'heroxbd', array('N')),
    array('debian-weekly-builds', 'Debian CD 镜像每周构建。', 'fqj1994', array('N')),
    array('deepin', '基于 Ubuntu 的面向中文桌面用户的发行版。', 'xiaq', array('B')),
    array('deepin-releases', 'Deepin 稳定版的 CD 镜像。', 'xiaq', array('B')),
    array('elrepo', 'RHEL 及其衍生版的一个社区仓库，软件包主要和硬件相关。', 'alick', array('N')),
    array('epel', 'Fedora 社区为 RHEL 等提供的额外软件包。', 'BYVoid', array('N')),
    array('fedora', '自由友爱杰出前卫的 Linux 发行版，Red Hat 公司赞助的社区项目。', 'alick', array('N')),
    array('freebsd', '拥有辉煌历史的 BSD 的一个重要分支。', 'xiaq', array('N')),
    array('gentoo', '一个快速的元发行版，软件包系统使用源代码。', 'cuckoo', array('N')),
    array('gentoo-portage', 'Gentoo 的 ports collection。', 'cuckoo', array('N')),
    array('gentoo-portage-prefix', 'Gentoo on a different level', 'heroxbd', array('A', 'url' => 'rsync.cn.prefix.freens.org')),
    array('gnu', 'GNU/Linux 的基础软件。', 'MichaelChou', array('N')),
    array('kernel', 'Linux 内核。', 'BYVoid', array('N')),
    array('linuxmint', '基于Ubuntu的发行版', 'fqj1994', array('B')),
    array('linuxmint-cd', 'LinuxMint的CD/DVD镜像', 'fqj1994', array('B')),
    array('macports', 'Mac OS X 与 Darwin 的包管理软件，GUI与CLI的结合。', 'VuryLeo', array('N')),
    array('npm', 'Node Packaged Modules', 'ray', array('N')),
    array('opensuse', '由 Novell 支持的 Linux 发行版。', 'xiaq', array('N')),
    array('pypi', 'Python Package Index', 'fqj1994', array('A', 'url' => 'e.pypi.python.org/')),
    array('rpmfusion', '一个用于 Fedora 和 RHEL 等的第三方软件仓库。', 'alick', array('N')),
    array('rubygems', 'Ruby Gems的仓库', 'fqj1994', array('N')),
    array('scientific', '由美国费米实验室维护的与 RHEL 兼容的发行版。', 'BYVoid', array('N')),
    array('sagemath', '一个整合了多个开源数学工具的开源数学工具。', 'fqj1994', array('B')),
    array('slackware', '最有资历的 Linux 发行版。', 'BYVoid', array('N')),
    array('tldp', 'The Linux Documentation Project 镜像', 'aron', array('N')),
    array('ubuntu', '基于 Debian 的以桌面应用为主的 Linux 发行版。', 'BYVoid', array('B')),
    array('ubuntu-ppa', 'Ubuntu PPA 精选镜像', 'aron', array('N')),
    array('ubuntu-releases', 'Ubuntu CD 镜像。', 'MichaelChou', array('B')),
    array('ubuntukylin-releases', 'Ubuntu Kylin CD 镜像。', 'xiaq', array('B')),
    array('raspbian', 'raspberry-pi debian镜像 剑桥大学发起的25美元的微小型廉价电脑', 'scateu', array('B')),
);

function maintainer($name)
{
    $mters = array(
        'BYVoid' => 'http://www.byvoid.com/',
        'xiaq' => 'http://wiki.tuna.tsinghua.edu.cn/xiaq',
        'MichaelChou' => 'http://michael.yuespot.org/',
        'heroxbd' => 'http://www.awa.tohoku.ac.jp/~benda/',
        'alick' => 'http://wiki.tuna.tsinghua.edu.cn/alick',
        'ray' => 'http://maskray.me',
        'VuryLeo' => 'http://www.vuryleo.com/',
        'fqj1994' => 'http://fqj.me/',
        'scateu' => 'http://wiki.tuna.tsinghua.edu.cn/scateu',
    );
    if (isset($mters[$name]))
        return "<a href='{$mters[$name]}' target='_blank'>{$name}</a>";
    else
        return $name;
}

function format_bytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' '. $units[$pow];
}

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

function initialize_status($status_files)
{
    $status = array();
    $context = stream_context_create(array(
        'http' => array(
            'timeout' => 3
        )
    ));
    foreach ($status_files as $file_idx => $status_file)
        {
            $lines = file($status_file, FILE_IGNORE_NEW_LINES, $context);
            foreach ($lines as $line)
                {
                    $sec = explode(",", $line);
                    if (count($sec) < 2)
                        continue;
                    $mirror = array();
                    $fields = array(
                        'name', 'current',
                        'stamp', 'files_count', 'files_transferred_count',
                        'size', 'size_transferred', 'literal', 'matched',
                        'file_list_size', 'file_list_generate_time',
                        'file_list_transfer_time', 'bytes_sent', 'bytes_received'
                    );
                    for ($i = 0; $i < count($sec); $i++)
                        {
                            $mirror[$fields[$i]] = $sec[$i];
                        }
                    $status[$mirror['name']] = $mirror;
                }
        }
    return $status;
}

function format_size($size)
{
    return str_replace(' bytes', 'B', $size);
}
?>

<div class="mirrors-stat">
<h2>状态统计</h2>
<div id="status-table">
<h3>各镜像状态表<a href="#status-table-footnote" title="到表尾脚注">↓</a></h3>
<table class="tablesorter" id="status-main-table">
<thead>
<tr>
<th><img height="16" width="16" src="files/official-header.png"
alt="Is an official mirror?"/></th>
<th>名称</th>
<th>维护者</th>
<th>状态</th>
<th>大小</th>
<th>文件总数</th>
<th>同步完成时间</th>
<th>请求次数</th>
<th>请求数据量</th>
</tr>
</thead>
<tbody>
<?php foreach ($specs as $spec): ?>
<?php $info = $status[$spec[0]] ?>
<tr>
<td class="official"><?php
switch ($spec[3][0]) {
case 'A':
echo '<a href="http://', $spec[3]['url'] ,'" target="_blank"><img height="16" width="16" src="files/official.png" alt="official"/></a>';
break;
case 'B':
echo '<img height="16" width="16" src="files/official.png" alt="official"/>';
break;
case 'N':
echo '<img height="16" width="16" src="files/non-official.png" alt="non-official"/>';
break;
case 'U':
echo '<img height="16" width="16" src="files/unknown.png" alt="unknown"/>';
break;
}
?></td>

<td>
<a name="<?php echo $spec[0] ?>" href="<?php echo $spec[0] ?>/" title="<?php echo $spec[1] ?>">
<?php echo $spec[0] ?>
</a>
</td>
<td><?php echo maintainer($spec[2]) ?></td>
<?php if ($info['current'] == 'success'): ?>
<td class="sync-state sync-ed">同步完成</td>
<?php elseif ($info['current'] == 'syncing'): ?>
<td class="sync-state sync-ing">正在同步</td>
<?php elseif ($info['current'] == 'failed'): ?>
<td class="sync-state sync-fail">同步失败</td>
<?php elseif ($info['current'] == 'checking'): ?>
<td class="sync-state sync-fail">人工维护</td>
<?php else: ?>
<td class="sync-state sync-unknown">未知</td>
<?php endif ?>

<td class="size"><?php echo format_size($info['size']) ?></td>
<td class="files_count"><?php echo $info['files_count'] ?></td>
<td><?php echo $info['stamp'] ? date('Y-m-d H:i', $info['stamp']) : '' ?></td>
<?php $stat = stat_by_distro_get($spec[0], 'week'); ?>
<td class="req_files_count"><?php echo $stat[0]; ?></td>
<td class="req_size"><?php echo convert_byte_to_text($stat[1]);?></td>
</tr>
<?php endforeach ?>
</tbody>
</table> <!-- id="status-main-table" -->
      <div id="status-table-footnote">
<ul>
<li>第一列显示是否为发行版/项目的官方软件源。</li>
<li>对于正在同步和同步失败的镜像，大小、文件总数、同步完成时间等信息取自最近一次成功同步时的日志。</li>
<li>请求次数/数据量取自最近七日的 HTTP 请求。</li>
</ul>
</div> <!-- end of status-table-footnote div -->
      </div> <!-- end of status-table div -->

<p>磁盘使用：<br/>
<?php
echo sprintf("总容量：%s&nbsp;&nbsp;已使用：%s&nbsp;&nbsp;剩余容量：%s&nbsp;&nbsp;使用比例：%s%%",
	$diskusage['total'], $diskusage['used'], $diskusage['free'], $diskusage['percent']);
?><br/>
<div id="diskusage" style="height:15px"></div>
</p>
</div> <!-- end of mirrors-stat div -->