<?php
require_once "includes/format_n_math.php";

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

$status = initialize_status(array(
    '/home/mirror/log/status.txt', 'http://mirror-nas.tuna.tsinghua.edu.cn/log/status.txt'));
?>
